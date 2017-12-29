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
    livereload  = require('gulp-livereload'),
    htmlmin     = require('gulp-htmlmin'),
    beep        = require('beepbeep'),
    del         = require('del'),
    merge = require('merge-stream');

function errorLog(error) {
    console.error(error.message);
    beep(3, 1000);
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
        'node_modules/animate.css/animate.css',
        'node_modules/owl.carousel/dist/assets/owl.carousel.css',
        'temp-folder/magnifier.css',
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
        'node_modules/animate.css/animate.css',
        'node_modules/owl.carousel/dist/assets/owl.carousel.css',
        'temp-folder/magnifier.css',
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
        'node_modules/owl.carousel/dist/owl.carousel.js',
        'node_modules/jquery-mousewheel/jquery.mousewheel.js',
        'node_modules/jquery-lazy/jquery.lazy.js',
        'node_modules/wowjs/dist/wow.js',
        'node_modules/pwstrength-bootstrap/dist/pwstrength-bootstrap.js',
        'node_modules/infinite-scroll/dist/infinite-scroll.pkgd.js',
        'temp-folder/Event.js',
        'temp-folder/Magnifier.js',
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
        'node_modules/popper.js/dist/umd/popper.js', 
        'node_modules/bootstrap/dist/js/bootstrap.js', 
        'node_modules/tether/dist/js/tether.js', 
        'node_modules/hammerjs/hammer.js', 
        'node_modules/owl.carousel/dist/owl.carousel.js',
        'node_modules/jquery-mousewheel/jquery.mousewheel.js',
        'node_modules/jquery-lazy/jquery.lazy.js',
        'node_modules/wowjs/dist/wow.js',
        'node_modules/pwstrength-bootstrap/dist/pwstrength-bootstrap.js',
        'node_modules/infinite-scroll/dist/infinite-scroll.pkgd.js',
        'temp-folder/Event.js',
        'temp-folder/Magnifier.js',
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

// ================================ HTML minified Assets ================================

/**
 * Command: gulp html-min
 * @description Find all php file in the project and minify
 * before go to dist.
 */
gulp.task('html-min', function(){
    var php_dir = gulp.src(['*.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            ignoreCustomFragments: [ /<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/ ]
        }))
    .pipe(gulp.dest('dist/'));

    var php_dir_account_customer = gulp.src(['customer/account/*.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            ignoreCustomFragments: [ /<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/ ]
        }))
    .pipe(gulp.dest('dist/customer/account'));

    var php_dir_account_forgot_password = gulp.src(['customer/password/*.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            ignoreCustomFragments: [ /<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/ ]
        }))
    .pipe(gulp.dest('dist/customer/password'));

    var php_dir_account_orders = gulp.src(['customer/orders/*.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            ignoreCustomFragments: [ /<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/ ]
        }))
    .pipe(gulp.dest('dist/customer/orders'));

    var php_dir_account = gulp.src(['customer/*.php'])
        .pipe(htmlmin({
            collapseWhitespace: true,
            ignoreCustomFragments: [ /<%[\s\S]*?%>/, /<\?[=|php]?[\s\S]*?\?>/ ]
        }))
    .pipe(gulp.dest('dist/customer'));

    return merge(php_dir, php_dir_account_customer, php_dir_account_forgot_password, php_dir_account_orders, php_dir_account);
});

// ================================ Watch Assets ================================

/**
 * Command: gulp watch
 * @description Compile first all styles and scripts
 * before starting the watcher.
 */
gulp.task('watch', ['styles', 'scripts'], function(){
    livereload.listen();
    gulp.watch(['node_modules/animate.css/animate.css', 'assets-dev/sass/**/*.scss', 'assets/css/'], ['styles']);
    gulp.watch(['assets-dev/js/*.js', 'assets/js'], ['scripts']);
    gulp.watch('*.php').on('change', function(file) {
        livereload.changed(file.path);
    });
    gulp.watch('customer/account/*.php').on('change', function(file) {
        livereload.changed(file.path);
    });
    gulp.watch('customer/password/*.php').on('change', function(file) {
        livereload.changed(file.path);
    });
    gulp.watch('customer/orders/*.php').on('change', function(file) {
        livereload.changed(file.path);
    });
    gulp.watch('customer/*.php').on('change', function(file) {
        livereload.changed(file.path);
    });
    gulp.watch('category/electronics/*.php').on('change', function(file) {
        livereload.changed(file.path);
    });
});

// ================================ Min Assets ================================

/**
 * Command: gulp min
 * @description Minified styles and scripts.
 */
gulp.task('min', ['styles-min', 'scripts-min'], function(){});

// ================================ Clear Distribution ================================

/**
 * Command: gulp clear-dist
 * @description Clear distribution folder
 */
gulp.task('clear-dist', function () {
    return del(['dist/**/*']);
});

// ================================ Clean Development ================================

/**
 * Command: gulp dist
 * @description Generates a clean theme for distribution
 */
gulp.task('dist', ['clear-dist', 'html-min'], function() {
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
        '!*.php',
        '!customer/account/*.php',
        '!customer/password/*.php',
        '!customer/orders/*.php',
        '!customer/*.php',
        '*'
    ])
    .pipe(gulp.dest('dist/'))
});