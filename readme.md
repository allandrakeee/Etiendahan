// test code in gulpfile

// gulp.task('default', function(){
// 	console.log("asd");
// });

// gulp.task('default', function(){
// 	return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 'node_modules/jquery/dist/jquery.min.js', 'node_modules/tether/dist/js/tether.min.js'])
// 		.on('error', errorLog)
// 		.pipe(uglify())
// 		.pipe(gulp.dest("src/js"))
// 		.pipe(browserSync.stream());
// });

// --------------------

// // Compile sass into CSS & auto-inject into browsers
// gulp.task('sass', function() {
// 	return gulp.src(['node_modules/bootstrap/scss/bootstrap.scss', 'src/sass/*.scss'])
// 		.pipe(sass())
// 		.on('error', errorLog)
// 		.pipe(gulp.dest("src/css"))
// 		.pipe(browserSync.stream());
// });

// // Move the javascript files into out /src/js folder
// gulp.task('js', function(){
// 	return gulp.src(['node_modules/bootstrap/dist/js/bootstrap.min.js', 'node_modules/jquery/dist/jquery.min.js', 'node_modules/tether/dist/js/tether.min.js'])
// 		.pipe(plumber())
// 		.pipe(gulp.dest("src/js"))
// 		.pipe(browserSync.stream());
// });

// // Static Server + watching scss/html files
// gulp.task('serve', ['sass'], function() {
// 	browserSync.init({
// 		server: "./src",
// 		browser: "chrome"
// 	});

// 	gulp.watch(['node_modules/bootstrap/scss/bootstrap.scss', 'src/sass/*.scss'], ['sass']);
// 	gulp.watch("src/*.html").on('change', browserSync.reload);
// });

// gulp.task('default', ['js', 'serve']);