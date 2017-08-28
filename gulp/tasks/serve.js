var gulp = require('gulp'),
	bs = require('browser-sync').create(),
	config 	= require('../config');
	
gulp.task('serve', function () {
    
    bs.init({
		proxy: 'sitekick.imac',
		ui : false
	});
	
	bs.watch('./style.css').on('change', bs.reload);
	bs.watch('./assets/js/scripts.js').on('change', bs.reload);
	bs.watch('./assets/img/**/*.{gif,png,svg,jpg}').on('change', bs.reload);
});


gulp.task('serve-publish', function () {
    
    bs.init({
		proxy: 'sitekick.imac',
		ui : false
	});

});