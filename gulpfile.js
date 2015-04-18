/*
 |--------------------------------------------------------------------------
 | Modules
 |--------------------------------------------------------------------------
 */

var gulp = require('gulp'),
    bower = require('gulp-bower'),
    elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Config
 |--------------------------------------------------------------------------
 */

var config = {
    bower: {
        path: './bower_components',
        fontawesome: {
            files: [
                './bower_components/fontawesome/fonts/**.*',
                './bower_components/bootstrap-sass-official/assets/fonts/bootstrap/**.*'
            ],
            output: './public/fonts'
        }
    },
    sass: {
        output: 'style.scss',
        loadPath: [
            './resources/sass',
            './bower_components/bootstrap-sass-official/assets/stylesheets',
            './bower_components/fontawesome/scss'
        ]
    },
    js: {
        // TODO: Combine lib and app to one file?
        lib: {
            files: [
                '../../bower_components/jquery/dist/jquery.min.js',
                '../../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap-sprockets.js',
                '../../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.min.js'
                // '../../bower_components/angular/angular.js',
                // '../../bower_components/angular-route/angular-route.js'
            ],
            output: './public/js/lib.js'
        },
        app: {
            files: [
                'app.js',
            ],
            output: './public/js/app.js'
        }
    }
};

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management and Elixir Tasks
 |--------------------------------------------------------------------------
 */

elixir.extend('bower', function(src, output) {

    gulp.task('bower', function() {
        return bower().pipe(gulp.dest(src));
    });

    return this.queueTask('bower');

});

elixir.extend('icons', function(src, output) {

    gulp.task('icons', function() {
        return gulp.src(src)
            .pipe(gulp.dest(output));
    });

    return this.queueTask('icons');

});

elixir(function(mix) {
    mix.bower(config.bower.path)
        .icons(config.bower.fontawesome.files, config.bower.fontawesome.output)
        .sass(config.sass.output, null, {includePaths: config.sass.loadPath})
        .scripts(config.js.lib.files, config.js.lib.output)
        .scripts(config.js.app.files, config.js.app.output);
});