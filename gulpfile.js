/*
 |--------------------------------------------------------------------------
 | Modules
 |--------------------------------------------------------------------------
 */

var gulp = require('gulp'),
    bower = require('gulp-bower'),
    rename = require('gulp-rename'),
    elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Config
 |--------------------------------------------------------------------------
 */

var config = {
    bower: {
        path: './bower_components',
        fonts: {
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
            './resources/assets/sass',
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
                '../../bower_components/bootstrap-sass-official/assets/javascripts/bootstrap.min.js',
                '../../bower_components/moment/min/moment.min.js',
                '../../bower_components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js'
            ],
            output: './public/js/lib.js'
        },
        app: {
            files: [
                'app.js',
            ],
            output: './public/js/app.js'
        }
    },
    dtp: {
        file: './bower_components/eonasdan-bootstrap-datetimepicker/build/css/*.min.css',
        output: './resources/assets/sass/vendor/'
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

elixir.extend('dtp', function(src, output) {

    gulp.task('dtp', function() {
        gulp.src(src)
            .pipe(rename('_datetimepicker-build.scss')) // test for now
            .pipe(gulp.dest(output));
    });

    return this.queueTask('dtp');

});

elixir(function(mix) {
    mix.bower(config.bower.path)
        .icons(config.bower.fonts.files, config.bower.fonts.output)
        .dtp(config.dtp.file, config.dtp.output)
        .sass(config.sass.output, null, {includePaths: config.sass.loadPath})
        .scripts(config.js.lib.files, config.js.lib.output)
        .scripts(config.js.app.files, config.js.app.output);
});