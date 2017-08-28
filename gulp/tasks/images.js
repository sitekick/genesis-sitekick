var gulp 	= require('gulp'),
	cache = require('gulp-cached'),
	config 	= require('../config');


gulp.task('images', function() {
   /* Copy images to asset folder */
  return gulp.src(config.images.src)
    .pipe(cache('images'))
    .pipe(gulp.dest(config.images.dest));
});

