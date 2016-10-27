//
// Gulp config file
//

/**
 * Vars
 */
// Initialize Gulp
var gulp = require('gulp');
// Initialize Gutil
var gutil = require('gulp-util');
// Exec object for running shell scripts
var exec = require('child_process').exec;
// Automatically parse and load plugins
var gulpLoadPlugins = require('gulp-load-plugins');
// Plugins object holder
var plugins = gulpLoadPlugins({
    DEBUG: false,
    pattern: '*',
    replaceString: /^gulp(-|\.)/,
    camelize: true
});
var themeInfo = require('./theme.json');

/**
 *  Error handler
 */
var onError = function (err) {
    plugins.notify.onError({
        title: 'Gulp error in ' + err.plugin,
        message: err.toString()
    })(err);
    gutil.beep();
    console.log(err.toString());
    this.emit('end');
};

/**
 * Paths
 */
var paths = {
    css: {
        src: 'resources/scss/app.scss',
        dest: 'assets/css/'
    },
    js: {
        src: 'resources/js/**/*.js',
        dest: 'assets/js/'
    },
    plugins: {
        src: 'resources/vendor/**',
        css: 'assets/css/',
        js: 'assets/js/'
    },
    img: {
        src : 'resources/img/**/*.{png,jpg,svg,gif,swf}',
        dest : 'assets/img/'
    },
	fonts: {
		vendors : 'resources/vendor/bootstrap/fonts/**',
		src : 'resources/fonts/**',
		dest : 'assets/fonts/',
	}
};

/**
 * Clean project
 */
gulp.task('clean', function() {
    var toClean = [
        './.DS_Store',
        './**/.DS_Store',
        paths.css.dest,
		paths.fonts.dest,
        paths.js.dest,
		paths.img.dest,
		paths.files.dest,
		paths.html.dest
    ];

    return plugins.del(toClean);
});


/**
 * Node
 */
// Install components
gulp.task('npm:install', function(cb) {
    exec('npm install && npm update && npm prune', function (err, stdout, stderr) {
        console.log(stderr);
        cb(err);
    });
});


/**
 * Bower
 */
// Install components
gulp.task('bower:install', function() {
    return gulp.src('./', {read:false})
        .pipe(plugins.exec('bower install && bower prune'))
        .pipe(plugins.exec.reporter());
});

// Parse and compile components to bower.css / bower.js
gulp.task('bower:compile', function() {
    var jsFiles = plugins.filter('**/*.js', {restore: true}),
        cssFiles = plugins.filter('**/*.css', {restore: true});

    return gulp.src(plugins.mainBowerFiles({
            includeDev: true,
            includeSelf: true,
            debugging: false
        }))
        .pipe(plugins.plumber({errorHandler: onError}))
		.pipe(plugins.newer(paths.plugins.js,paths.plugins.css))
        .pipe(plugins.sourcemaps.init())
        .pipe(cssFiles)
        .pipe(plugins.groupConcat({'vendors.css': '**/*.css'}))
        .pipe(plugins.sourcemaps.write('.'))
		.pipe(plugins.uglifycss())
        .pipe(gulp.dest(paths.plugins.css))
        .pipe(cssFiles.restore)
        .pipe(plugins.sourcemaps.init())
        .pipe(jsFiles)
        .pipe(plugins.groupConcat({'vendors.js': '**/*.js'}))
		.pipe(plugins.uglify())
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(paths.plugins.js));
});


/**
 * Styles
 */
gulp.task('build:styles', function () {
    var processors = [
        plugins.autoprefixer({browsers:['last 2 versions']}),
        plugins.combineMq,
        plugins.postcssQuantityQueries
    ];

  return gulp.src(paths.css.src)
  	.pipe(plugins.plumber({errorHandler: onError}))
  	.pipe(plugins.newer(paths.css.dest))
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass({outputStyle: 'compressed'}))
  	.pipe(plugins.postcss(processors))
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest(paths.css.dest));
});


/**
 * Javascript
 */
//concatenate and compile js to app.min.js
gulp.task('build:js', function() {
  return gulp.src(paths.js.src)
   	.pipe(plugins.plumber({errorHandler: onError}))
  	.pipe(plugins.newer(paths.js.dest))
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.groupConcat({'app.js': '**/*.js'}))
    .pipe(plugins.uglify())
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest(paths.js.dest));
});


/**
 * Images
 */
// Compress images for development
gulp.task('build:images:development', function() {
    var config = {
        optimizationLevel: 0,
        progressive: false,
        interlaced: false
    };

    return gulp.src(paths.img.src)
        .pipe(plugins.plumber({errorHandler: onError}))
		.pipe(plugins.newer(paths.img.dest))
        .pipe(plugins.imagemin(config))
        .pipe(gulp.dest(paths.img.dest));
});

// Copy favicon to /img
gulp.task('copy:img', function() {
    return gulp.src('resources/favicon.ico')
        .pipe(gulp.dest('assets'));
});


// Compress images for production (Heavy CPU!)
gulp.task('build:images:production', function() {
    var config = {
        optimizationLevel: 7,
        progressive: true,
        interlaced: true,
        svgoPlugins: [{removeViewBox: false}],
        use: [plugins.imageminPngquant({ quality: '80', speed: 1 }), plugins.imageminMozjpeg({quality: '80'})]
    };

    return gulp.src(paths.img.src)
        .pipe(plugins.plumber({errorHandler: onError}))
		.pipe(plugins.newer(paths.img.dest))
        .pipe(plugins.imagemin(config))
        .pipe(gulp.dest(paths.img.dest));
});


/**
 * Fonts
 */
gulp.task('copy:fonts', function () {
  return gulp.src([paths.fonts.src, paths.fonts.vendors])
  	.pipe(plugins.newer(paths.fonts.dest))
    .pipe(gulp.dest(paths.fonts.dest));
});

/**
 * Connect
 */
gulp.task('publish', function() {
	gulp.src("").pipe(plugins.shell("php ../../artisan stylist:publish "+themeInfo.name));
});

/**
 * Sequences
 */
// Development build
gulp.task('developmentSequence', ['bower:compile', 'build:styles', 'build:js', 'build:images:development', 'copy:img', 'copy:fonts']);

// Production build
gulp.task('productionSequence', ['bower:compile', 'build:styles', 'build:js', 'build:images:production', 'copy:img', 'copy:fonts']);

/**
 * Notices
 */
// Build complete
gulp.task('notice:built', function() {
    return gulp.src('./', {read:false})
        .pipe(plugins.notify('Successfully built your project!'));
});

/**
 * Watch
 */
gulp.task('watch', ['developmentSequence'], function () {
	var queue = plugins.watchSequence(300);

	gulp.watch(paths.plugins.src, queue.getHandler('bower:compile', 'publish'));
	gulp.watch(paths.css.src, queue.getHandler('build:styles', 'publish'));
	gulp.watch(paths.js.src, queue.getHandler('build:js', 'publish'));
	gulp.watch(paths.img.src, queue.getHandler('build:images:development', 'publish'));
	gulp.watch(paths.fonts.src, queue.getHandler('copy:fonts', 'publish'));
	gulp.watch('./gulpfile.js', { interval: 500 }, ['default']);
});

/**
 * Main tasks
 */
// Production build
gulp.task('prod', function (cb) {
	plugins.sequence('clean','productionSequence', 'publish', 'notice:built', cb);
});

//The default task (called when you run `gulp` from cli)
gulp.task('default', function (cb) {
	plugins.sequence('developmentSequence', 'watch', 'publish', 'notice:built', cb);
});
