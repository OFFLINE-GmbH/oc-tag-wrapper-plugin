<?php return [
    'plugin'            => [
        'name'                       => 'TagWrapper',
        'description'                => 'Wraps a selected tag into a defined wrapper.',
        'author'                     => 'OFFLINE LLC',
        'manage_settings'            => 'Settings for tag-wrapper',
        'manage_settings_permission' => 'Can access TagWrapper settings',
    ],

    'settings' => [

        'sections' => [
            'processing' => 'Define wrapper',
            'processing_comment' => 'Define tags, that should be wrapped with a wrapper tag.',
        ],

        'tag-selector' => 'Tag that should be wrapped',
        'tag-selector_comment' => 'Select tags via an XPath expression.',

        'wrapper-type' => 'Type of wrapper tag',
        'wrapper-type_comment' => 'Element type of the wrapper tag.',

        'wrapper-class' => 'Optional class for wrapper tag.',
        'wrapper-class_comment' => 'This class will be added to the wrapper tag.',

        'wrapper-id' => 'Optional id for wrapper tag.',
        'wrapper-id_comment' => 'This id will be added to the wrapper tag',
    ]
];
