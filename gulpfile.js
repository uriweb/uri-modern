var gulp = require('gulp');

// include plug-ins
var jshint = require('gulp-jshint');
var changed = require('gulp-changed');
var imagemin = require('gulp-imagemin');
var concat = require('gulp-concat');
var stripDebug = require('gulp-strip-debug');
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('autoprefixer');
var postcss = require('gulp-postcss');
var rename = require('gulp-rename');
var header = require('gulp-header');


// options
var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'compressed' //expanded, nested, compact, compressed
};

// JS concat, strip debugging and minify
gulp.task('scripts', scripts);

function scripts(done) {
  gulp.src('./src/js/*.js')
    .pipe(jshint(done))
    .pipe(jshint.reporter('default'));
	gulp.src('./src/js/*.js')
    .pipe(concat('script.min.js'))
    //.pipe(stripDebug())
    //.pipe(uglify())
    .pipe(gulp.dest('./js/'));
    
	done();
 // console.log('scripts ran');
}

// CSS concat, auto-prefix and minify
gulp.task('styles', styles);

function styles(done) {

	var pkg = require('./package.json');
	var banner = ['/*',
  'Theme Name: <%= pkg.name %>',
  'Theme URI: <%= pkg.homepage %>',
  'Author: <%= pkg.author %>',
  'Author URI: <%= pkg.homepage %>',
  'Description: <%= pkg.description %>',
  'Version: <%= pkg.version %>',
  'License: <%= pkg.license %>',
  'License URI: <%= pkg.licenseURI %>',
  'Text Domain: <%= pkg.name %>',
  'Tags:',
  '',
  '@version v<%= pkg.version %>',
  '@author <%= pkg.authorHuman %>',
  '',
  '*/',
  ''].join('\n')


	gulp.src('./src/sass/*.scss')
		.pipe(sourcemaps.init())
		.pipe(sass(sassOptions).on('error', sass.logError))
		.pipe(concat('style.css'))
		.pipe(postcss([ autoprefixer() ]))
		.pipe(header(banner, { pkg : pkg } ))
		.pipe(sourcemaps.write('./map'))
		.pipe(gulp.dest('.'));

  done();
  //console.log('styles ran');
}

// minify new images
gulp.task('images', images);

function images(done) {
  var imgSrc = './src/images/**/*',
      imgDst = './images';

  gulp.src(imgSrc)
    .pipe(changed(imgDst))
    .pipe(imagemin())
    .pipe(gulp.dest(imgDst));
	done();
  //console.log('images ran');
}

// watch
gulp.task('watcher', watcher);

function watcher(done) {
	// watch for JS changes
	gulp.watch('./src/js/*.js', scripts);

	// watch for CSS changes
	gulp.watch('./src/sass/**/*', styles);

	// watch for image changes
	gulp.watch('./src/images/**/*', images);

	done();
}

gulp.task( 'default',
	gulp.parallel('images', 'scripts', 'styles', 'watcher', function(done){
		done();
	})
);


function done() {
	console.log('done');
}