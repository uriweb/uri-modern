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

// include plug-ins
var jshint = require('gulp-jshint');
var jscs = require('gulp-jscs');
var changed = require('gulp-changed');
var imagemin = require('gulp-imagemin');
var concat = require('gulp-concat');
var stripDebug = require('gulp-strip-debug');
var uglify = require('gulp-uglify');
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

// Generate build number
function getBuild() {
    
    var d, start, day, seconds, build;
    
    d = new Date();
    start = new Date(d.getUTCFullYear(), 0, 0);
    day = Math.floor( (d - start) / 86400000);
    seconds = (d.getUTCHours() * 3600) + (d.getUTCMinutes() * 60) + d.getUTCSeconds();
    
    build = d.getUTCFullYear().toString().slice(2) + ("00" + (day)).slice(-3) + '.' + seconds;

    return build;
    
}

// JS concat, strip debugging and minify
gulp.task('scripts', scripts);

function scripts(done) {
    
  gulp.src('./src/js/*.js')
    .pipe(jshint(done))
    .pipe(jshint.reporter('default'));
    
  gulp.src('./src/js/*.js')
    .pipe(jscs(done))
    .pipe(jscs.reporter());

  gulp.src('./src/js/*.js')
    .pipe(concat('script.min.js'))
    //.pipe(stripDebug())
    .pipe(uglify())
    .pipe(header(banner, { pkg : pkg } ))
    .pipe(gulp.dest('./js/'));
    
	done();
 // console.log('scripts ran');
}

// CSS concat, auto-prefix and minify
gulp.task('styles', styles);

function styles(done) {

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