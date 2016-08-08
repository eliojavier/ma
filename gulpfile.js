var elixir = require('laravel-elixir');
require('laravel-elixir-imagemin');
require('laravel-elixir-vueify');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir.config.images = {
    folder: 'img',
    outputFolder: 'img'
};

var paths = {
    'jquery': './vendor/bower_components/jquery/',
    'materialize': './vendor/bower_components/Materialize/',
    'fontAwesome': './vendor/bower_components/font-awesome/',
    'circliul': './vendor/bower_components/circliful/',
    'slick': './vendor/bower_components/slick-carousel/slick/',
    'cropit':'./vendor/bower_components/cropit/dist/'
}

elixir(function(mix) {
    mix.sass("app.scss", 'public/css/', {
        includePaths: [
            paths.materialize + 'sass/',
            paths.fontAwesome + 'scss/',
            paths.slick
        ]})
        .sass('dropzone.scss', 'public/css/')
        .imagemin()
        .copy(paths.fontAwesome+'fonts', 'public/fonts')
        .copy(paths.slick+'fonts', 'public/fonts')
        .copy('./resources/assets/fonts', 'public/fonts')
        .copy('./resources/assets/js/dropzone.js','public/js')
        .copy(paths.cropit+'jquery.cropit.js','public/js')
        //.copy('./vendor/bower_components/pusher-websocket-iso/dist/web/pusher.js','public/js')
        .browserify('main.js')
        .scripts([
            paths.jquery + "dist/jquery.js",
            paths.materialize + "dist/js/materialize.js",
            paths.slick + "slick.js",
            "./resources/assets/js/plugins.js"
        ], 'public/js/plugins.js','./')
        .scripts([
            paths.materialize + "dist/js/materialize.js",
            paths.circliul + "js/circliful.js",
            "./resources/assets/js/profile.js"
        ], 'public/js/profile.js','./');
});
