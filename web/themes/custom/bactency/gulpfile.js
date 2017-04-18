/*global -$ */
'use strict';
var gulp = require('gulp');
var sass = require('gulp-sass');
var $ = require('gulp-load-plugins')();
var access = require('gulp-accessibility');
var urlAdjuster = require('gulp-css-url-adjuster');

// Error notifications
var reportError = function(error) {
  $.notify({
    title: 'Gulp Task Error',
    message: 'Check the console.'
  }).write(error);
  console.log(error.toString());
  this.emit('end');
};

// Sass processing
gulp.task('sass', function() {
  return gulp.src('sass/**/*.scss')
    .pipe($.sourcemaps.init())
    // Convert sass into css
    .pipe(sass())
    // Show errors
    .on('error', reportError)
    // Autoprefix properties
    .pipe($.autoprefixer({
      browsers: ['last 2 versions']
    }))
    // Write sourcemaps
    .pipe($.sourcemaps.write())
    // Save css
    .pipe(gulp.dest('css'))
    // Adjust urls
    .pipe(urlAdjuster({
      prepend: '../images/'
    }))
    .pipe(gulp.dest('css'));
});

// Sass fast processing
gulp.task('sass-fast', function() {
  return gulp.src('sass/**/*.scss')
    // Convert sass into css
    .pipe(sass())
    // Show errors
    .on('error', reportError)
    // Autoprefix properties
    .pipe($.autoprefixer({
      browsers: ['last 2 versions']
    }))
    // Save css
    .pipe(gulp.dest('css'))
});

// process JS files and return the stream.
gulp.task('js', function () {
  return gulp.src('js/**/*.js')
    .pipe(gulp.dest('js'));
});

// Optimize Images
gulp.task('images', function() {
  return gulp.src('images/**/*')
    .pipe($.imagemin({
      progressive: true,
      interlaced: true,
      svgoPlugins: [{
        cleanupIDs: false
      }]
    }))
    .pipe(gulp.dest('images'));
});

// JS hint
gulp.task('jshint', function() {
  return gulp.src('js/*.js')
    .pipe($.jshint())
    .pipe($.jshint.reporter('jshint-stylish'))
    .pipe($.notify({
      title: "JS Hint",
      message: "JS Hint says all is good.",
      onLast: true
    }));
});

// Beautify JS
gulp.task('beautify', function() {
  gulp.src('js/*.js')
    .pipe($.beautify({indentSize: 2}))
    .pipe(gulp.dest('scripts'))
    .pipe($.notify({
      title: "JS Beautified",
      message: "JS files in the theme have been beautified.",
      onLast: true
    }));
});

// Compress JS
gulp.task('compress', function() {
  return gulp.src('js/*.js')
    .pipe($.uglify())
    .pipe(gulp.dest('js'))
    .pipe($.notify({
      title: "JS Minified",
      message: "JS files in the theme have been minified.",
      onLast: true
    }));
});

// Compress CSS
gulp.task('minify', function() {
  return gulp.src('css/*.css')
    .pipe($.csso())
    .pipe(gulp.dest('css'))
});

// Run drush to clear the theme registry
gulp.task('drush', function() {
  return gulp.src('', {
    read: false
  })
  .pipe($.shell([
    'drush cc css-js',
  ]))
  .pipe($.notify({
    title: "Caches cleared",
    message: "Drupal CSS/JS caches cleared.",
    onLast: true
  }));
});

gulp.task('jsvalidate', function () {
  return gulp.src('js/script.js')
    .pipe($.jsvalidate());
});

/**
 * Accessibility validation task.
 */
gulp.task('validate-accessibility', function() {
  // Set defaults.
  var urls = Array();
  var accessibilityLevel = 'WCAG2AAA';
  var reportLevels = {
    notice: true,
    warning: true,
    error: true
  };
  var reportType = 'txt';
  var quiet = false;

  // Retrieve parameters.
  for(var i=0; i < process.argv.length; i++) {
    // Urls.
    var j = process.argv[i].indexOf('--urls');
    if(j>-1) {
      urls = process.argv[i].split('=');
      urls = urls[1].split(',');
    }

    // AccessibilityLevel
    var j = process.argv[i].indexOf('--accessibilityLevel');
    if(j>-1) {
      accessibilityLevel = process.argv[i].split('=');
      accessibilityLevel = accessibilityLevel[1];
    }

    // ReportLevels.
    var j = process.argv[i].indexOf('--reportLevels');
    if(j>-1) {
      reportLevels = process.argv[i].split('=');
      reportLevels = reportLevels[1].split(',');
      // Convert retrieved array to object.
      var obj = {};
      for (var x = 0; x < reportLevels.length; ++x) {
        var cells = reportLevels[x].split(':');
        obj[cells[0].trim()] = JSON.parse(cells[1]);
      }
      reportLevels = obj;
    }

    // ReportType.
    var j = process.argv[i].indexOf('--reportType');
    if(j>-1) {
      reportType = process.argv[i].split('=');
      reportType = reportType[1];
    }

    // Quiet.
    var j = process.argv[i].indexOf('--quiet');
    if(j>-1) {
      quiet = true;
    }
  }
  console.log('Accessibility validation:');
  console.log('Urls:', urls);
  console.log('Level:', accessibilityLevel);
  console.log('Reports:', reportLevels);
  console.log('Report type:', reportType);

  return access({
    urls: urls,
    force: true,
    accessibilityLevel: accessibilityLevel,
    reportLevels: reportLevels,
    reportType: reportType,
    reportLocation: 'reports/accessibility',
    accessibilityrc: true,
    verbose: !quiet
  });
});


// Default task to be run with `gulp`
gulp.task('default', ['sass'], function() {
  gulp.watch("sass/**/*.scss", ['sass']);
  gulp.watch("js/**/*.js", ['js']);
});

gulp.task('prod', ['sass-fast', 'images',  'beautify', 'compress', 'minify']);

gulp.task('watch', function(){
  gulp.watch('sass/**/*.scss', ['sass-fast']);
  // Other watchers
});
