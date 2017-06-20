var gulp 			= require('gulp'),
	runSequence		= require('run-sequence');
	

/**
 * Run all tasks needed for a build in defined order
 */

gulp.task('build', function() {
  runSequence(
  	'sass',
  	'watch',
  	'serve'
  	);
  });


 gulp.task('qa', function() {
  /* build with transpiling; no watching for changed files; bower js/css; vendor/custom scripts */
  
  runSequence(
  	'delete-D',
  	['data-D','images-D','libraries-D'],
  	['transpile-D','vendor-js-min'],
  	['scripts-transpiled','sass-D'],
  	'html-D',
  	'inject-D',
  	'serve-D'
  	);
  });
  
  gulp.task('publish', function() {
  /* build with transpiling; no watching for changed files; final js and css */
  
  runSequence(
  	'delete-P',
  	['data-P','images-P','libraries-P'],
  	['transpile-P','vendor-js-min'],
  	['scripts-transpiled-min','sass-P'],
  	'html-P',
  	'inject-P',
  	'serve-P'
  	);
  });
  
