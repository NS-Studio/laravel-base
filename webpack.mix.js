let mix = require( 'laravel-mix' );

mix.webpackConfig( {
    node:   {
        fs: 'empty'
    },
    module: {
        rules: [
            {
                // Matches all PHP or JSON files in `resources/lang` directory.
                test:   /resources(\\|\/)lang.+\.(php|json)$/,
                loader: 'laravel-localization-loader',
            }
        ]
    }
} );

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
mix.js( 'resources/assets/js/app.js', 'public/assets/js' )
   .js( 'resources/assets/js/home.js', 'public/assets/js' )
   .extract( [ 'vue' ] )
   .sass( 'resources/assets/sass/app.scss', 'public/assets/css' );
