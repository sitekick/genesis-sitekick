var gulp 			= require('gulp'),
	plumber      	= require('gulp-plumber'),
	sass    		= require('gulp-ruby-sass'),
	sourcemaps  	= require('gulp-sourcemaps'),
	autoprefixer	= require('gulp-autoprefixer'),
	cache 			= require('gulp-cached'),
	config 			= require('../config');


gulp.task('sass', function() {
  
  var sassConfig = config.sass.options.dev;

  // Don’t write sourcemaps of sourcemaps
  
  return sass(config.sass.src, sassConfig)
  	.pipe(cache('sass'))
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(sourcemaps.write('.', { includeContent: false, sourceRoot: 'src/scss' }))
    .pipe(gulp.dest(config.sass.dest));
});

gulp.task('sass-publish', function() {
  
  var sassConfig = config.sass.options.prod;

  return sass(config.sass.src, sassConfig)
  	.pipe(cache('sass'))
    .pipe(plumber())
    .pipe(autoprefixer(config.autoprefixer))
    .pipe(gulp.dest(config.sass.dest));
});