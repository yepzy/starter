const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/fonts/fontawesome')
    .copy('resources/images/', 'public/images/')
    // js **************************************************************************************************************
    .js('resources/js/scripts/admin/base.js', 'public/js/admin.js')
    .js('resources/js/scripts/front/base.js', 'public/js/front.js')
    // admin
    //
    // front
    //
    // sass ************************************************************************************************************
    .sass('resources/sass/styles/admin/_base.scss', 'public/css/admin.css')
    .sass('resources/sass/styles/front/_base.scss', 'public/css/front.css')
    // admin
    //
    // front
    .sass('resources/sass/front/home.scss', 'public/css')
    .sass('resources/sass/front/news.scss', 'public/css')
    .sass('resources/sass/front/news-show.scss', 'public/css')
    .sass('resources/sass/front/simple-pages.scss', 'public/css')
    // config **********************************************************************************************************
    .options({processCssUrls: false})
    .autoload({
        lodash: ['_'],
        axios: ['axios'],
        jquery: ['$', 'jQuery', 'window.jQuery'],
        'popper.js': ['Popper'],
        'sweetalert2': ['swal'],
        cookieconsent: ['cookieconsent', 'window.cookieconsent'],
        lozad: ['lozad']
    })
    .extract(['bootstrap', 'lodash', 'axios', 'jquery', 'popper.js', 'sweetalert2', 'cookieconsent', 'lozad']);

if (mix.inProduction()) {
    mix.disableNotifications();
    mix.version();
}