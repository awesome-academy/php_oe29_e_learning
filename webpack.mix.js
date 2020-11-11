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
    .styles('resources/css/custom.css', 'public/css/custom.css')
    .styles('resources/css/footer.css', 'public/css/footer.css')
    .styles('resources/css/auth.css', 'public/css/auth.css')
    .styles('resources/css/profile.css', 'public/css/profile.css')
    .styles('resources/css/dropdown.css', 'public/css/dropdown.css')
    .styles('resources/css/lesson.css', 'public/css/lesson.css')
    .styles('resources/css/detail.css', 'public/css/detail.css')
    .styles('resources/css/mentor.css', 'public/css/mentor.css')
    .styles('resources/css/scrollbar.css', 'public/css/scrollbar.css')
    .js('resources/js/script.js', 'public/js/script.js')
    .js('resources/js/backgroundscript.js', 'public/js/backgroundscript.js')
    .js('resources/js/dropdown.js', 'public/js/dropdown.js')
    .js('resources/js/self-script.js', 'public/js/self-script.js')
    .js('resources/js/mentorscript.js', 'public/js/mentorscript.js')
    .js('resources/js/preview.js', 'public/js/preview.js');
