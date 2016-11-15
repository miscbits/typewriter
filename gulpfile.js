var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.sass([
        'app.scss',
        'fonts.scss'
    ]);
});

elixir(function(mix) {
    mix.copy('resources/assets/fonts', 'public/fonts');
});

elixir(function(mix) {
    mix

    .scripts([
        'jquery/dist/jquery.min.js',
    ],
    'public/js/vendor.js',
    'node_modules')

    .scripts([
        'app.js'
    ], 'public/js/app.js')

    .version([
        'js/vendor.js',
        'js/app.js'
    ]);

});
