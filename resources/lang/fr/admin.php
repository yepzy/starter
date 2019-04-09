<?php

return [
    'title' => [
        'orphan' => [
            'index'  => ':entity > Gestion',
            'create' => ':entity > Ajout',
            'edit'   => ':entity > Édition > « :detail »',
        ],
        'parent' => [
            'index'  => ':parent > :entity > Gestion',
            'create' => ':parent > :entity > Ajout',
            'edit'   => ':parent > :entity > Édition > « :detail »',
        ],
    ],
    'section' => [
        'links'       => 'Liens',
        'profile'     => 'Mon profil',
        'list'        => 'Liste',
        'data'        => 'Données',
        'page'        => 'Page',
        'identity'    => 'Identité',
        'contact'     => 'Contact',
        'security'    => 'Sécurité',
        'seo'         => 'Référencement',
        'title'       => 'Titre',
        'active'      => 'Active',
        'publication' => 'Publication',
        'media'       => 'Media',
        'information' => 'Informations',
    ],
];
