var gulp 	= require('gulp'),
	watch 	= require('gulp-watch'),
	config 	= require('../config');

gulp.task('watch', function() {
	gulp.watch(config.sass.src, ['sass']);
});