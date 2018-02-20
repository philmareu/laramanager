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

mix.options({ processCssUrls: false });

mix.js('src/assets/js/scripts.js', 'src/assets/js/scripts.min.js');

mix.less('src/assets/less/styles.less', '../LaraManager/src/assets/css/styles.css');

if (mix.inProduction()) {
    mix.version();
}