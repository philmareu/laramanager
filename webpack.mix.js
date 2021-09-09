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

mix.options({ processCssUrls: false });
mix.js(
    'src/js/scripts.js',
    'src/assets/js/scripts.min.js'
).vue({ version: 3});
// mix.less(
//     'src/less/styles.less',
//     'src/assets/css/styles.css'
// );
// mix.copy(
//     'node_modules/datatables.net/js/jquery.dataTables.js',
//     'src/assets/js/datatables.js'
// );
// mix.copy(
//     'node_modules/datatables.net-dt/images/*',
//     'src/assets/images/'
// );
