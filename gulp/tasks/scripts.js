var gulp 	= require('gulp'),
	concat 	= require('gulp-concat'),
	uglify	= require('gulp-uglify'),
	config 	= require('../config');


gulp.task('scripts', function() {
	/* copies custom scripts and non-bower vendor to scripts.js */
	gulp.src(config.scripts.src)
	.pipe(concat('scripts.js'))
	.pipe(gulp.dest(config.scripts.dest));
});


/*-----Production Tasks------*/

gulp.task('scripts-publish', function() {
	/* copies custom and bower scripts to scripts.js with minification*/
	gulp.src(config.scripts.src)
	.pipe(uglify())
	.pipe(concat('scripts.js'))
	.pipe(gulp.dest(config.scripts.dest));
});

