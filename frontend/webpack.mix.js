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

mix.webpackConfig({
  resolve: {
    extensions: ['.js', '.vue'],
    alias: {
      '@': __dirname + ''
    },
  }
});

mix.browserSync('localhost:8000')
mix.disableNotifications()

mix.version()
    .js('./app.js', '../backend/public/js/app.js')
    .sass('./assets/sass/app.scss', '../backend/public/css/app.css')
    .setPublicPath('../backend/public/');
