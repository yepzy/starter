<?php

$defaultTitle = env('APP_NAME', 'Laravel'); // todo : set default app name
$defaultDescription = 'App description'; // todo : set default app description
$defaultKeywords = ['app', 'base', 'keywords']; // todo : set default app keywords
// todo : replace the default favicon by your app favicon

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'       => $defaultTitle, // set false to total remove
            'description' => $defaultDescription, // set false to total remove
            'separator'   => ' - ',
            'keywords'    => $defaultKeywords,
            'canonical'   => null, // set null for using Url::current(), set false to total remove
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null, // https://support.google.com/webmasters/answer/35179?hl=fr
            'bing'      => null, // https://www.bing.com/webmaster/help/how-to-verify-ownership-of-your-site-afcfefc6
            'alexa'     => null, //
            'pinterest' => null, // https://help.pinterest.com/fr/articles/claim-your-website
            'yandex'    => null, // https://yandex.com/support/webmaster/adding-site/how-to-add-site.html
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => $defaultTitle, // set false to total remove
            'description' => $defaultDescription, // set false to total remove
            'url'         => null, // set null for using Url::current(), set false to total remove
            'type'        => 'article', // all possible types available here : https://developers.facebook.com/docs/reference/opengraph#object-type
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter'   => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'    => 'summary', // other possible values : summary_large_image / app / player
            'site'    => '@ArthurLorent', // todo : update twitter site
            'creator' => '@ArthurLorent', // todo : update twitter creator
        ],
    ],
];
