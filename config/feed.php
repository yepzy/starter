<?php

return [

    'feeds' => [

        'news' => [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * 'App\Model@getAllFeedItems'
             *
             * You can also pass an argument to that method:
             * ['App\Model@getAllFeedItems', 'argument']
             */
            'items' => 'App\Models\News\NewsArticle@getFeedItems',

            /*
             * The feed will be available on this url.
             */
            'url' => '',

            'title' => 'News RSS feed',

            'description' => 'Subscribe to our news RSS feed and automatically receive our latest articles.',

            'language' => 'en-gb',

            /*
             * The view that will render the feed.
             */
            'view' => 'feed::atom',

            /*
             * The type to be used in the <link> tag
             */
            'type' => 'application/atom+xml',
        ],

    ],

];
