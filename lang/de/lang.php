<?php return [
    'plugin'            => [
        'name'                       => 'TagWrapper',
        'description'                => 'Verpackt HTML-Tags in einen Wrapper.',
        'author'                     => 'OFFLINE GmbH',
        'manage_settings'            => 'Einstellungen für TagWrapper',
        'manage_settings_permission' => 'Kann TagWrapper-Einstellungen verwalten',
    ],

    'settings' => [

        'sections' => [
            'processing' => 'Wrapper definieren',
            'processing_comment' => 'Definiere die gewünschten Elemente, welche Du mit einem Wrapper versehen möchtest.',
        ],

        'tag-selector' => 'Tag, das verpackt werden soll',
        'tag-selector_comment' => 'Einzelnes HTML-Element als XPATH-Ausdruck.',

        'wrapper-type' => 'Art des Wrapper-Tag',
        'wrapper-type_comment' => 'Element-Typ des HTML-Tag, mit dem das ausgewählte Element verpackt werden soll.',

        'wrapper-class' => 'Optionales Klassen-Attribut für das Wrapper-Tag',
        'wrapper-class_comment' => 'Einzelnes Klassen-Attribut, welches dem Wrapper-Tag mitgegeben wird.',

        'wrapper-id' => 'Optionales Id-Attribut für das Wrapper-Tag',
        'wrapper-id_comment' => 'Einzelnes Id-Attribut, welches dem Wrapper-Tag mitgegeben wird.',
    ]
];
