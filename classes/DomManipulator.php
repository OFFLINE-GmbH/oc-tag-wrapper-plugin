<?php

namespace OFFLINE\TagWrapper\Classes;

use Config;
use DOMDocument;
use DOMElement;
use DOMXPath;
use OFFLINE\TagWrapper\Models\Settings;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Throwable;

/**
 * Manipulates Tags in a DOMDocument.
 *
 * @package OFFLINE\TagWrapper\Classes
 */
class DomManipulator
{
    /**
     * @var \DOMNodeLists
     */
    protected $wrappersWithNodeList;
    /**
     * @var string
     */
    protected $html;
    /**
     * @var DOMDocument
     */
    protected $dom;
    /**
     * @var DOMXPath
     */
    protected $DOMXPath;

    /**
     * Loads the html.
     *
     * @param                      $html
     * @param null|LoggerInterface $logger
     * @param DOMDocument|null     $dom
     */
    public function __construct($html, ?LoggerInterface $logger = null, ?DOMDocument $dom = null)
    {
        // suppress errors in case of invalid html
        libxml_use_internal_errors(true);

        if ($dom === null) {
            $this->dom = new DOMDocument;
        }

        $this->dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        $this->DOMXPath = new DOMXPath($this->dom);

        $this->wrappersWithNodeList = $this->getWrapperWithNodeList();
        $this->logger               = $logger ?? new NullLogger();
    }

    /**
     * Add wrapper to elements.
     *
     * @return string
     */
    public function process(): string
    {
        foreach ($this->wrappersWithNodeList as $wrapperWithNodeList) {
            $wrapper = $this->createTagWrapper($wrapperWithNodeList['wrapper']);

            foreach ($wrapperWithNodeList['nodeList'] as $node) {
                try {
                    $wrapperCopy = $wrapper->cloneNode(false);
                    $nodeCopy    = $node->cloneNode(true);

                    $wrapperCopy->appendChild($nodeCopy);
                    $node->parentNode->replaceChild($wrapperCopy, $node);
                } catch (Throwable $e) {
                    $this->log(
                        sprintf('Could not process element %s', $node),
                        $e
                    );
                    continue;
                }
            }
        }

        return $this->addWrappedElementsToDom();
    }

    /**
     * Creates array with wrapper-information and list of node elements.
     *
     * @return array
     */
    private function getWrapperWithNodeList(): array
    {
        return array_map(function ($wrapperSetting) {
            return [
                'nodeList' => $this->DOMXPath->query($wrapperSetting['target_tag']),
                'wrapper'  => $wrapperSetting,
            ];
        }, Settings::get('wrappers', []));
    }

    /**
     * Create tag for wrapping the element.
     *
     * @param $tagWrapper
     *
     * @return DOMElement
     */
    private function createTagWrapper($tagWrapper): DOMElement
    {
        $wrapper = $this->dom->createElement($tagWrapper['tag_wrapper_type']);

        if ($tagWrapper['tag_wrapper_class'] && $tagWrapper['tag_wrapper_class'] !== '') {
            $wrapper->setAttribute('class', $tagWrapper['tag_wrapper_class']);
        }

        if ($tagWrapper['tag_wrapper_id'] && $tagWrapper['tag_wrapper_id'] !== '') {
            $wrapper->setAttribute('id', $tagWrapper['tag_wrapper_id']);
        }

        return $wrapper;
    }

    /**
     * Replace the original DOM with the updated version.
     *
     * @return string
     */
    public function addWrappedElementsToDom(): string
    {
        return $this->dom->saveHTML($this->dom);
    }

    /**
     * Logs a message.
     *
     * @param      $message
     * @param      $exception
     * @param bool $forceLogEntry
     */
    private function log($message, $exception)
    {
        $this->logger->warning(
            sprintf('[OFFLINE.TagWrapper] %s', $message),
            compact('exception')
        );
    }
}
