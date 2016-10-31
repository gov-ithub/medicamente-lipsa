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
        src: 'resources/scss/main.scss',
        dest: 'assets/css/'
    },
    js: {
        src: 'resources/js/**/*.js',
        dest: 'assets/js/',
        modules: 'assets/js/modules/*.js'
    },
    plugins: {
        src: 'bower_components/**',
        css: 'assets/css/',
        js: 'assets/js/'
    },
    img: {
        src : 'resources/img/**/*.{png,jpg,svg,gif}',
        dest : 'assets/img/'
    },
	fonts: {
		src : 'resources/fonts/**',
		dest : 'assets/fonts/',
	},
    files: {
		src : 'resources/files/**',
		dest : 'assets/files/',
	},
    html: {
        watch : 'resources/**/*.html',
		src : ['resources/**/*.html','!resources/content/**'],
		dest : 'assets/',
	},
    iconfont: {
        src: 'resources/iconfont/*.svg',
        dest: 'assets/fonts/',
    },
	php_cli: '/c/wamp/bin/php/php5.5.29/php'
};


/**
 * Clean project
 */
gulp.task('clean', function() {
    var toClean = [
        './.DS_Store',
        './**/.DS_Store',
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
        .pipe(plugins.groupConcat({'vendors.css': 'bower_components/**/*.css'}))
        .pipe(plugins.sourcemaps.write('.'))
		.pipe(plugins.uglifycss())
        .pipe(gulp.dest(paths.plugins.css))
        .pipe(cssFiles.restore)
        .pipe(plugins.sourcemaps.init())
        .pipe(jsFiles)
        .pipe(plugins.groupConcat({'vendors.js': 'bower_components/**/*.js'}))
		.pipe(plugins.uglify())
        .pipe(plugins.sourcemaps.write('.'))
        .pipe(gulp.dest(paths.plugins.js));
});


/**
 * Styles
 */
gulp.task('build:styles', function () {
    var processors = [
        plugins.autoprefixer({browsers:['> 1%']}),
        plugins.combineMq,
        plugins.postcssQuantityQueries
    ];

  return gulp.src(paths.css.src)
  	.pipe(plugins.plumber({errorHandler: onError}))
  	.pipe(plugins.newer(paths.css.dest))
    .pipe(plugins.sourcemaps.init())
    .pipe(plugins.sass({outputStyle: 'compressed'}))
  	.pipe(plugins.postcss(processors))
  	.pipe(plugins.rename('app.min.css'))
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest(paths.css.dest))
    .pipe(plugins.connect.reload());
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
    .pipe(plugins.groupConcat({'app.min.js': '**/*.js'}))
    .pipe(plugins.uglify())
    .pipe(plugins.sourcemaps.write('.'))
    .pipe(gulp.dest(paths.js.dest))
  	.pipe(plugins.connect.reload());
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
        .pipe(gulp.dest(paths.img.dest))
        .pipe(plugins.connect.reload());
});

// Copy favicon to /img
gulp.task('copy:img', function() {
    return gulp.src('resources/img/favicon.ico')
		.pipe(plugins.newer(paths.img.dest))
        .pipe(gulp.dest(paths.img.dest));
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
        .pipe(gulp.dest(paths.img.dest))
        .pipe(plugins.connect.reload());
});


/**
 * HTML
 */
gulp.task('build:html', function () {
  return gulp.src(paths.html.src)
  	.pipe(plugins.plumber({errorHandler: onError}))
    .pipe(plugins.fileInclude({
		filters: {
			markdown: plugins.markdown.parse
		}
    }))
    .pipe(gulp.dest(paths.html.dest))
    .pipe(plugins.connect.reload());
});

gulp.task('build:html:newer', function () {
  return gulp.src(paths.html.src)
  	.pipe(plugins.plumber({errorHandler: onError}))
    .pipe(plugins.newer(paths.html.dest))
    .pipe(plugins.fileInclude({
		filters: {
			markdown: plugins.markdown.parse
		}
    }))
    .pipe(gulp.dest(paths.html.dest))
    .pipe(plugins.connect.reload());
});


/**
 * Fonts
 */
gulp.task('copy:fonts', function () {
  return gulp.src(paths.fonts.src)
  	.pipe(plugins.newer(paths.fonts.dest))
    .pipe(gulp.dest(paths.fonts.dest));
});


gulp.task('build:iconfont', function(){
    return gulp.src(paths.iconfont.src, {base: 'resources/'})
    .pipe(plugins.newer(paths.iconfont.dest))
    .pipe(plugins.iconfontCss({
        fontName: 'iconfont',
        path: 'resources/scss/_template.scss',
        targetPath: '../../resources/scss/_iconfont.scss',
        fontPath: '../fonts/'
    }))
    .pipe(plugins.iconfont({
        fontName: 'iconfont',
        prependUnicode: true,
        fontHeight: 1024,
        formats: ['ttf', 'eot', 'woff', 'svg'],
        normalize: true,
        timestamp: Math.round(Date.now()/1000)
    }))
    .pipe(gulp.dest(paths.iconfont.dest));
});


/**
 * Files
 */
gulp.task('copy:files', function () {
return gulp.src(paths.files.src)
	.pipe(plugins.newer(paths.files.dest))
    .pipe(gulp.dest(paths.files.dest));
});


/**
 * Publish
 */
/*gulp.task('publish', function (cb) {
  exec('_art.sh 2>&1', function (err, stdout, stderr) {
    console.log(stdout);
    console.log(stderr);
    cb(err);
  });
});*/
gulp.task('publish', function() {
	gulp.src("").pipe(plugins.shell("php ../../artisan stylist:publish "+themeInfo.name));
});

/**
 * Connect
 */
gulp.task('connect', function() {
  plugins.connect.server({
    root: 'dist',
    livereload: true
  });
});


/**
 * Sequences
 */
// Development build
gulp.task('developmentSequence', ['bower:compile', 'build:styles', 'build:js', 'build:images:development', 'copy:img', 'copy:fonts', 'build:iconfont', 'copy:files']);

// Production build
gulp.task('productionSequence', ['bower:compile', 'build:styles', 'build:js', 'build:images:production', 'copy:img', 'copy:fonts', 'copy:files']);

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
gulp.task('watch', function () {
    var queue = plugins.watchSequence(300);

	gulp.watch(paths.plugins.src, queue.getHandler('bower:compile', 'publish'));
	gulp.watch(paths.css.src, queue.getHandler('build:styles', 'publish'));
	gulp.watch(paths.js.src, queue.getHandler('build:js', 'publish'));
	gulp.watch(paths.img.src, queue.getHandler('build:images:development', 'publish'));
	gulp.watch(paths.fonts.src, queue.getHandler('copy:fonts', 'publish'));
    gulp.watch(paths.iconfont.src, queue.getHandler('build:iconfont', 'publish'));
	gulp.watch(paths.files.src, queue.getHandler('copy:files', 'publish'));
	gulp.watch('gulpfile.js', { interval: 500 }, ['developmentSequence']);
});

//watch for minimal tasks
gulp.task('watch-min', function () {
    var queue = plugins.watchSequence(300);

	gulp.watch(paths.css.src, queue.getHandler('build:styles', 'publish'));
	gulp.watch(paths.js.src, queue.getHandler('build:js', 'publish'));
	gulp.watch(paths.img.src, queue.getHandler('build:images:development', 'publish'));
	gulp.watch(paths.files.src, queue.getHandler('copy:files', 'publish'));
});

/**
 * Main tasks
 */
// Production build
gulp.task('pub', function (cb) {
	plugins.sequence('publish', 'notice:built', cb);
});

// Production build
gulp.task('prod', function (cb) {
	plugins.sequence('clean','build:iconfont','productionSequence', 'publish', 'notice:built', cb);
});

//The default task (called when you run `gulp` from cli)
gulp.task('default', function (cb) {
	plugins.sequence('build:iconfont','developmentSequence', 'watch', 'publish', 'notice:built', cb);
});
