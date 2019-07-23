let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app2.js', 'public/js')
mix.js('resources/assets/js/emplo.js', 'public/js')
mix.js('resources/assets/js/chat.js', 'public/js')
mix.js('resources/assets/js/profil.js', 'public/js')
mix.js('resources/assets/js/article.js', 'public/js')
mix.js('resources/assets/js/message.js', 'public/js')
mix.js('resources/assets/js/todo.js', 'public/js')
mix.js('resources/assets/js/trace.js', 'public/js')






   .sass('resources/assets/sass/app.scss', 'public/css');
