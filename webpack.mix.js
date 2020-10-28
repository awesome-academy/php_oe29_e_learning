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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .styles('resources/css/style.css', 'public/css/style.css')
    .styles('resources/css/footer.css', 'public/css/footer.css')
    .styles('resources/css/auth.css', 'public/css/auth.css')
    .styles('resources/css/profile.css', 'public/css/profile.css')
    .js('resources/js/script.js', 'public/js/script.js')
    .js('resources/js/self-script.js', 'public/js/self-script.js');
