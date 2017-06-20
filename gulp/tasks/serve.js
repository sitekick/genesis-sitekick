var gulp = require('gulp'),
	bs = require('browser-sync').create(),
	config 	= require('../config');
	
gulp.task('serve', function () {
    
    bs.init({
		proxy: 'sitekick.imac',
		ui : false
	});
	
	//var path = './build' + config.server.build.dev;
	
	bs.watch('./style.css').on('change', bs.reload);
	
	
});


gulp.task('serve-P', function () {
    
    bs.init({
		proxy: config.server.url + config.server.build.prod,
		ui : false
	});

});