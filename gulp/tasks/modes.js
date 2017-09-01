var gulp 			= require('gulp'),
	runSequence		= require('run-sequence');
	

/**
 * Run all tasks needed for a build in defined order
 */

gulp.task('build', function() {
  runSequence(
  	'delete',
  	['sass','scripts'],
  	['fonts','images'],
  	'watch',
  	'serve'
  	);
  });
  
  
  gulp.task('publish', function() {
  /* build with transpiling; no watching for changed files; final js and css */
  
  runSequence(
	'delete',
  	['sass-publish','scripts-publish'],
  	['fonts','images'],
  	'serve-publish'
  	);
  });
  
