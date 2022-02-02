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

mix.js('resources/assets/js/app.js', 'public/vue/js')
    .js('resources/assets/js/backend-app.js', 'public/js')
    .sass('resources/assets/scss/front-app.scss', 'css')
    .sass('resources/assets/scss/front-rtl.scss', 'css')
    .sass('resources/assets/scss/app.scss', 'public/css')
    .options({
        processCssUrls: false
    });
