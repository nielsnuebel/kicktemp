var	gulp 			= require('gulp'),
	concat 			= require('gulp-concat'),
	clean 			= require('gulp-rimraf'),
	less 			= require('gulp-less'),
	cssnano			= require('gulp-cssnano'),
	csscomb 		= require('gulp-csscomb'),
	autoprefixer	= require('gulp-autoprefixer'),
	uglify			= require('gulp-uglify'),
	notify			= require('gulp-notify'),
	SourceMap		= require('gulp-sourcemaps'),
	rename  		= require('gulp-rename'),
	browserSync		= require('browser-sync'),
	reload 			= browserSync.reload;

/* dirs */
var	assetsDir			= 'assets',
	lessDir				= assetsDir + '/less';
	jsDir				= assetsDir + '/js';
	targetCssFilename  	= 'kicktemp.css',
	targetJsFilename	= 'kicktemp.js',
	targetCss			= 'css',
	targetJs			= 'js',
	targetFont			= 'fonts',
	proxyname			= 'localhost'; // MAMP Hosts Server-Name

var scripts = [
	assetsDir	+ '/bower/jquery/dist/jquery.js',
	assetsDir	+ '/bower/bootstrap/js/transition.js',
	assetsDir	+ '/bower/bootstrap/js/alert.js',
	assetsDir	+ '/bower/bootstrap/js/button.js',
	assetsDir	+ '/bower/bootstrap/js/carousel.js',
	assetsDir	+ '/bower/bootstrap/js/collapse.js',
	assetsDir	+ '/bower/bootstrap/js/dropdown.js',
	assetsDir	+ '/bower/bootstrap/js/modal.js',
	assetsDir	+ '/bower/bootstrap/js/tooltip.js',
	assetsDir	+ '/bower/bootstrap/js/popover.js',
	assetsDir	+ '/bower/bootstrap/js/scrollspy.js',
	assetsDir	+ '/bower/bootstrap/js/tab.js',
	assetsDir	+ '/bower/bootstrap/js/affix.js',
	assetsDir	+ '/bower/modernizr/modernizr.js',
	jsDir 		+ '/custom.js'
];

// Delete all Files in the Folder targetCss, targetJS, targetFont
gulp.task('clean', function() {
	gulp.src([targetCss + '/*', targetJs + '/*.js', targetFont + '/*'], {read:false})
		.pipe(clean());
});

// Copy Bootstrap and Fontawesome Fontfiles to targetFont Folder and copy the bootstrap variables.less for customizing
gulp.task('init', function() {
	gulp.src(assetsDir + '/bower/font-awesome/fonts/**/*.{otf,eot,svg,ttf,woff,woff2}')
		.pipe(gulp.dest(targetFont));
	gulp.src(assetsDir + '/bower/bootstrap/fonts/**/*.{otf,eot,svg,ttf,woff,woff2}')
		.pipe(gulp.dest(targetFont));
	gulp.src(assetsDir + '/bower/html5shiv/dist/html5shiv.min.js')
		.pipe(gulp.dest(targetJs));
	gulp.src(assetsDir + '/bower/respond/dest/respond.min.js')
		.pipe(gulp.dest(targetJs));
});

// Concat Javascript Files from the variable scripts and saves it to the targetJsFilename
gulp.task('mergeScriptsdev', function() {
	gulp.src(scripts)
		.pipe(concat(targetJsFilename))
		.pipe(gulp.dest(targetJs))
		.pipe(reload({stream:true}));
});

// Concat Javascript Files from the variable scripts, minified and store it to the targetJsFilename
gulp.task('mergeScripts', function() {
	gulp.src(scripts)
		.pipe(concat(targetJsFilename))
		.pipe(uglify())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(targetJs));
});

//
gulp.task('cssdev', function(){
	return gulp.src(lessDir + '/import.less')
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

gulp.task('css', function(){
	return gulp.src(lessDir + '/import.less')
		.pipe(less())
		.pipe(autoprefixer('last 20 version'))
		.pipe(csscomb())
		.pipe(concat(targetCssFilename))
		.pipe(cssnano())
		.pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest(targetCss))
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

gulp.task('default', function(){
	gulp.start(['css', 'mergeScripts']);
});