var gulp = require('gulp');
var pkg = require('./package.json');

var banner = ['/*',
  'Theme Name: <%= pkg.themeName %>',
  'Theme URI: <%= pkg.homepage %>',
  'Author: <%= pkg.author %>',
  'Author URI: <%= pkg.authorURI %>',
  'Description: <%= pkg.description %>',
  'Version: <%= pkg.version %>',
  'License: <%= pkg.license %>',
  'License URI: <%= pkg.licenseURI %>',
  'Text Domain: <%= pkg.textDomain %>',
  'Tags: education, theme-options',
  '',
  '@version v<%= pkg.version %>',
  '@author Brandon Fuller <bjcfuller@uri.edu>',
  '@author John Pennypacker <jpennypacker@uri.edu>',
  '',
  '*/',
  ''].join('\n');

var bannerStatic = ['/*',
  '===================================',
  '==      STATIC HTML VERSION      ==',
  '===================================',
  '*/',
  '',
  ''].join('\n');

// include plug-ins
var eslint = require('gulp-eslint');
var changed = require('gulp-changed');
var imagemin = require('gulp-imagemin');
var rename = require('gulp-rename');
var concat = require('gulp-concat');
var stripDebug = require('gulp-strip-debug');
var terser = require('gulp-terser');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('autoprefixer');
var postcss = require('gulp-postcss');
var header = require('gulp-header');
var shell = require('gulp-shell');


// options
var sassOptions = {
  errLogToConsole: true,
  outputStyle: 'compressed' //expanded, nested, compact, compressed
};

// JS concat, strip debugging and minify
gulp.task('scripts', scripts);

function scripts(done) {

  gulp.src('./js/**/*.js')
    .pipe(eslint(done))
    .pipe(eslint.format());

  gulp.src('./src/js/**/*.js')
    .pipe(eslint(done))
    .pipe(eslint.format());

  // Process top-level js (front side)
  gulp.src('./src/js/*.js')
    .pipe(concat('script.min.js'))
    //.pipe(stripDebug())
    .pipe(terser())
    .pipe(header(banner, { pkg : pkg } ))
    .pipe(gulp.dest('./js/')) // Pipe to main
    .pipe(rename('script.static.min.js'))
    .pipe(header(bannerStatic))
    .pipe(gulp.dest('./static/')); // Pipe to static

  // Process block editor js (admin side)
  gulp.src('./src/js/block-editor/*.js')
    .pipe(concat('block-editor.min.js'))
    .pipe(terser())
    .pipe(gulp.dest('./js/')); // Pipe to main

  done();
  // console.log('scripts ran');
}

// CSS concat, auto-prefix and minify
gulp.task('styles', styles);

function styles(done) {

  // Theme styles
  gulp.src('./src/sass/main.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(concat('style.css'))
    .pipe(postcss([ autoprefixer() ]))
    .pipe(header(banner, { pkg : pkg } ))
    .pipe(sourcemaps.write('./map'))
    .pipe(gulp.dest('.'));

  // Static styles
  gulp.src('./src/sass/static.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(concat('style.static.css'))
    .pipe(postcss([ autoprefixer() ]))
    .pipe(header(banner, { pkg : pkg } ))
    .pipe(header(bannerStatic))
    .pipe(sourcemaps.write('./map'))
    .pipe(gulp.dest('./static'));

  // Block editor and admin-side styles
  gulp.src('./src/sass/admin.scss')
    .pipe(sourcemaps.init())
    .pipe(sass(sassOptions).on('error', sass.logError))
    .pipe(concat('style.admin.css'))
    .pipe(postcss([ autoprefixer() ]))
    .pipe(sourcemaps.write('./map'))
    .pipe(gulp.dest('.'));

  done();
  //console.log('styles ran');
}

// Copy minified images to static dir
gulp.task('images', images);

function images(done) {

  // Pipe to main
  gulp.src('./src/images/**/*')
    .pipe(changed('./images'))
    .pipe(imagemin())
    .pipe(gulp.dest('./images'));

  // Pipe to static
  gulp.src('./src/images/**/*')
    .pipe(changed('./static/images'))
    .pipe(imagemin())
    .pipe(gulp.dest('./static/images'));

  done();
  //console.log('images ran');
}

// run codesniffer
gulp.task('sniffs', sniffs);

function sniffs(done) {
    return gulp.src('.', {read:false})
        .pipe(shell(['./.sniff']));
}

// watch
gulp.task('watcher', watcher);

function watcher(done) {
  // watch for JS changes
  gulp.watch('./src/js/*.js', scripts);
  gulp.watch('./src/js/block-editor/*.js', scripts);

  // watch for CSS changes
  gulp.watch('./src/sass/**/*', styles);

  // watch for image changes
  gulp.watch('./src/images/**/*', images);

  // watch for PHP change
  gulp.watch('./**/*.php', sniffs);

	done();
}

gulp.task( 'default',
	gulp.parallel('images', 'scripts', 'styles', 'sniffs', 'watcher', function(done){
		done();
	})
);


function done() {
	console.log('done');
}
