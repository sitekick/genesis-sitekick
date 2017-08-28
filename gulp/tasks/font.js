var gulp 	= require('gulp'),
	cache = require('gulp-cached'),
	config 	= require('../config');


gulp.task('fonts', function() {
  /* Copy fonts to asset folder */
  return gulp.src(config.font.src)
    .pipe(cache('fonts'))
    .pipe(gulp.dest(config.font.dest));
});

