<?php

return [
    'title'    => [
        //
    ],
    'label'    => [
        //
    ],
    'sentence' => [
        'dashboardWelcome' => 'Bienvenue sur votre tableau de bord.',
    ],
    'action'   => [
        'back'        => 'Retour',
        'backHome'    => 'Retour à l\'accueil',
        'confirm'     => 'Confirmer',
        'cancel'      => 'Annuler',
        'moreInfo'    => 'En savoir plus',
        'socialShare' => 'Partager sur :social',
    ],
    'legend'   => [
        'password'    => [
            'forgotten'  => 'Renseignez votre e-mail pour y recevoir les instructions de réinitialisation de votre mot de passe.',
            'update'     => 'Ne saisir que si vous souhaitez modifier le mot de passe actuel.',
            'constraint' => [
                'min'    => '6 caractères minimum.',
                'string' => 'Doit contenir au moins une lettre.',
            ],
        ],
        'media'       => [
            'constraint' => [
                'dimensions' => 'Largeur minimale : :width pixels / Hauteur minimale : :height pixels.',
                'mimetypes'  => 'Type(s) MIME accepté(s) : :mimetypes.',
            ],
        ],
        'phoneNumber' => [
            'foreign' => 'En cas de numéro non français, merci de saisir le numéro de téléphone avec son indicatif pays (exemple : +49 pour l\'Allemagne).',
        ],
    ],
];
