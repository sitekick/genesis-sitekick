module.exports = {
	delete: {
		dest: './assets/'
	},
	images: {
		src:  [
			'./src/img/*',
			'./src/img/**/*',
			'!./src/img/arch',
			'!./src/img/arch/**/*'
			],
		dest: './assets/img'
	},
	font: {
		src:  [
			'./src/font/*',
			'./src/font/**/*',
			],
		dest: './assets/font'
	},
	sass: {
		src:  './src/scss/**/*.scss',
		dest: './',
		options: {
			dev : {
				style: 'expanded'
  			},
  			prod : {
				style: 'compressed'
  			}
		}
	},
	autoprefixer: {
		browsers: [
			'last 2 versions',
			'Firefox >= 43',
			'Chrome >= 43',
			'Safari >= 8',
			'ie >= 9',
			'Edge >= 12',
			'Opera >= 12.1',
			'iOS 6',
			'Android 4'
		],
		cascade: true
	},
	scripts : {
		dest : './assets/js',
		src : './src/js/*.js'
	}
}

