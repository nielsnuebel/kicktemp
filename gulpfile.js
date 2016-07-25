var	gulp 			= require('gulp'),
	concat 			= require('gulp-concat'),
	clean 			= require('gulp-rimraf'),
	less 			= require('gulp-less'),
	cssnano	    	= require('gulp-cssnano'),
	csscomb 		= require('gulp-csscomb'),
	autoprefixer	= require('gulp-autoprefixer'),
	uglify			= require('gulp-uglify'),
	notify			= require('gulp-notify'),
	SourceMap		= require('gulp-sourcemaps'),
	rename  		= require('gulp-rename'),
	browserSync		= require('browser-sync'),
	reload 			= browserSync.reload;

/* dirs */
var	assetsDir       	= 'assets',
//lessDir         	= assetsDir + '/less';
//jsDir           	= assetsDir + '/js';
//targetCssFilename  	= 'kicktemp.css',
//targetJsFilename	= 'kicktemp.js',
	assetsDirBrotladen	= 'assets/brotladen',
	lessDir         	= assetsDirBrotladen + '/less';
jsDir           	= assetsDirBrotladen + '/js';
targetCssFilename  	= 'brotladen.css',
	targetJsFilename	= 'brotladen.js',
	targetCss       	= 'css',
	targetJs        	= 'js',
	targetFont      	= 'fonts',
	proxyname			= 'oldedeka.dev';

var scripts = [
	assetsDir + '/bower/jquery/dist/jquery.js',
	//assetsDir + '/bower/bootstrap/js/transition.js',
	//assetsDir + '/bower/bootstrap/js/alert.js',
	//assetsDir + '/bower/bootstrap/js/button.js',
	//assetsDir + '/bower/bootstrap/js/carousel.js',
	//assetsDir + '/bower/bootstrap/js/collapse.js',
	//assetsDir + '/bower/bootstrap/js/dropdown.js',
	//assetsDir + '/bower/bootstrap/js/modal.js',
	//assetsDir + '/bower/bootstrap/js/tooltip.js',
	//assetsDir + '/bower/bootstrap/js/popover.js',
	assetsDir + '/bower/bootstrap/js/scrollspy.js',
	//assetsDir + '/bower/bootstrap/js/tab.js',
	//assetsDir + '/bower/bootstrap/js/affix.js',
	//assetsDir + '/bower/modernizr/modernizr.js',
	assetsDir  + '/plugins/magnific-popup/jquery.magnific-popup.min.js',
	assetsDir  + '/plugins/owl-carousel/owl.carousel.js',
	assetsDir  + '/plugins/jquery.validate.js',
	jsDir + '/theme/jquery.slides.min.js',
	jsDir + '/jquery.easing.1.3.js',
	jsDir + '/jquery.scrollto.js',
	jsDir + '/waypoints.js',
	jsDir + '/plugins.js',
	jsDir + '/custom.js'
];

gulp.task('mergeScripts', function() {
	gulp.src(scripts)

		.pipe(concat(targetJsFilename))
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(targetJs));
});

gulp.task('mergeScriptsdev', function() {
	gulp.src(scripts)
		.pipe(concat(targetJsFilename))
		.pipe(gulp.dest(targetJs))
		.pipe(reload({stream:true}));
});

gulp.task('clean', function() {
	gulp.src([targetCss + '/*.css', targetJs + '/*.js', targetFont + '/*'], {read:false})
		.pipe(clean());
});

gulp.task('css', function(){
	return gulp.src(lessDir + '/kicktemp.less')
		.pipe(less())
		.pipe(autoprefixer('last 20 version'))
		.pipe(csscomb())
		.pipe(concat(targetCssFilename))
		.pipe(cssnano())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(targetCss))
});

gulp.task('cssdev', function(){
	return gulp.src(lessDir + '/kicktemp.less')
		.pipe(SourceMap.init())
		.pipe(less())
		.on('error',function (err) {
			console.log(err.toString());
		})
		.pipe(autoprefixer('last 20 version'))
		.pipe(csscomb())
		.pipe(concat(targetCssFilename))
		.pipe(SourceMap.write('.'))
		.pipe(notify('cssdev done'))
		.pipe(gulp.dest(targetCss))
		.pipe(reload({stream:true}));
});

gulp.task('watch', ['connect'], function() {
	gulp.watch(lessDir + '/**/*.less', ['cssdev']);
	gulp.watch(jsDir + '/**/*.js', ['mergeScriptsdev']);
});

gulp.task('connect', function() {
	browserSync({
		proxy: proxyname,
		port: 3000,
		open: false
	});
});

gulp.task('default', ['clean'], function(){
	gulp.start(['css', 'mergeScripts']);
});