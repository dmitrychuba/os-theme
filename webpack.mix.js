let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.webpackConfig({
    module    : {
        rules : [
            {
                test : /\.js$/,
                use  : 'webpack-import-glob-loader'
            },
            {
                test : /\.scss$/,
                use  : 'webpack-import-glob-loader'
            },
        ]
    },
    externals : {
        "jquery" : "jQuery"
    }
});

mix.setResourceRoot('../');
mix.setPublicPath('dist');

mix.copy('resources/assets/images', 'dist/images')

mix.js('resources/assets/scripts/app.js', 'scripts')
    .sass('resources/assets/styles/app.scss', 'styles')
    .sass('resources/assets/styles/editor-styles.scss', 'styles');
