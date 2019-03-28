const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix.version()

mix
    .js('resources/js/apps/welcome.js', 'public/js')
    .js('resources/js/apps/mailing-list-index.js', 'public/js')
    .js('resources/js/apps/topic-index.js', 'public/js')
    .js('resources/js/apps/topic-show.js', 'public/js')


    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.js') ],
    })
