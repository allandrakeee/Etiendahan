/**
 * Tasks for gulpfile
 * 
 * @author Allan Drake
 */

var gulp        = require('gulp'),
    sass        = require('gulp-sass'),
    sassGlob    = require('gulp-sass-glob'),
    uglify      = require('gulp-uglify'),
    uglifycss   = require('gulp-uglifycss');
    prefix      = require('gulp-autoprefixer'),
    concat      = require('gulp-concat'),
    sourcemaps  = require('gulp-sourcemaps'),
    livereload  = require('gulp-livereload'),
    gutil       = require('gulp-util'),
    del         = require('del'),
    browserSync = require('browser-sync').create();

function errorLog(error) {
    console.error(error.message);
}﻿

// ================================ Styles Development ================================

/**
 * Development in styles
 *
 * Command: gulp styles
 * @description Compile the styles in normal compile
 */
gulp.task('styles', function(){
    return gulp.src([
        'node_modules/bootstrap/scss/bootstrap.scss', 
        'node_modules/font-awesome/scss/font-awesome.scss', 
        'assets-dev/sass/*.scss'
    ])
    .pipe(sassGlob())
    .pipe(sass())
    .on('error', errorLog)
    .pipe(concat('theme.css'))
    .pipe(prefix('last 2 versions'))
    .pipe(gulp.dest("assets/css"))
    .pipe(livereload());
});

// ================================ Styles Production ================================

/**
 * Production in styles
 *
 * Command: gulp styles-min
 * @description Compile the styles in uglifycss compile
 */
gulp.task('styles-min', function(){
 return gulp.src([
     'node_modules/bootstrap/scss/bootstrap.scss', 
     'node_modules/font-awesome/scss/font-awesome.scss', 
     'assets-dev/sass/*.scss'
    ])
    .pipe(sassGlob())
    .pipe(sass())
    .on('error', errorLog)
    .pipe(concat('theme.min.css'))
    .pipe(prefix('last 2 versions'))
    .pipe(uglifycss({
     "maxLineLen": 100,
     "uglyComments": true
    }))
    .pipe(gulp.dest("assets/css"))
});

// ================================ Scripts Development ================================

/**
 * Development in scripts
 *
 * Command: gulp scripts
 * @description Compile the scripts in normal compile
 */
gulp.task('scripts', function(){
    return gulp.src([
        'node_modules/jquery/dist/jquery.js', 
        'node_modules/popper.js/dist/umd/popper.js', 
        'node_modules/bootstrap/dist/js/bootstrap.js', 
        'node_modules/tether/dist/js/tether.js', 
        'node_modules/hammerjs/hammer.js', 
        'assets-dev/js/*.js'
    ])
    .on('error', errorLog)
    .pipe(concat('theme.js'))
    .pipe(gulp.dest("assets/js"))
    .pipe(livereload());
});

// ================================ Scripts Production ================================

/**
 * Production in scripts
 *
 * Command: gulp scripts-min
 * @description Compile the scripts in uglify compile
 */
gulp.task('scripts-min', function(){
    return gulp.src([
        'node_modules/jquery/dist/jquery.js', 
        'node_modules/popper/dist/umd/popper.js', 
        'node_modules/bootstrap/dist/js/bootstrap.js', 
        'node_modules/tether/dist/js/tether.js', 
        'assets-dev/js/*.js'
    ])
    .on('error', errorLog)
    .pipe(concat('theme.min.js'))
    .pipe(uglify())
    .pipe(gulp.dest("assets/js"));
});

// ================================ Fonts Assets ================================

/**
 * Command: gulp fonts
 * @description Clear distribution folder
 */
gulp.task('fonts', function () {
    return gulp.src([
        'node_modules/font-awesome/fonts/**/*.{ttf,woff,woff2,eof,svg}', 
    ])
    .pipe(gulp.dest("assets/fonts"));
});

// ================================ Watch Assets ================================

/**
 * Command: gulp watch
 * @description Compile first all styles and scripts
 * before starting the watcher.
 */
gulp.task('watch', ['styles', 'scripts'], function(){
    livereload.listen();
    gulp.watch(['assets-dev/sass/**/*.scss', 'assets/css/'], ['styles']);
    gulp.watch(['assets-dev/js/*.js', 'assets/js'], ['scripts']);
    gulp.watch('*.php').on('change', function(file) {
        livereload.changed(file.path);
    });
});

// ================================ Clear Distribution ================================

/**
 * Command: gulp clear-dist
 * @description Clear distribution folder
 */
gulp.task('clear-dist', function () {
    return del(['dist/**/*',]);
});

// ================================ Clean Development ================================

/**
 * Command: gulp dist
 * @description Generates a clean theme for distribution
 */
gulp.task('dist', ['clear-dist'], function() {
    gulp.src([
        '**/*',
        '!assets-dev/',
        '!assets-dev/**',
        '!bower_components',
        '!bower_components/**',
        '!node_modules',
        '!node_modules/**',
        '!src',
        '!src/**',
        '!dist',
        '!dist/**',
        '!dist-product',
        '!dist-product/**',
        '!gulp',
        '!gulp/**',
        '!sass',
        '!sass/**',
        '!readme.txt',
        '!readme.md',
        '!package.json',
        '!package-lock.json',
        '!gulpfile.js',
        '!CHANGELOG.md',
        '!.travis.yml',
        '!jshintignore',
        '!codesniffer.ruleset.xml',
        '*'
    ])
    .pipe(gulp.dest('dist/'))
});