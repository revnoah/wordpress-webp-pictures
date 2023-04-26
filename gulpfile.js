/*
  This is a gulp workflow that compiles using the folder
  structure shown below. The source and destination are set to the
  specific plugin name.

  To make it work, you make to install:

  $ npm install
  
  To install the gulp requirements individually:

  $ npm install gulp gulp-zip gulp-notify

  To execute, change to project root:

  $ gulp
*/

var gulp = require('gulp');
var zip = require('gulp-zip');
var notify = require('gulp-notify');

var testPath = '../wptest/wp-content/plugins';
var sourcePath = 'source';
var buildPath = 'build';
var fileName = 'webp-pictures';
var publishPath = '../publish-' + fileName;

/**
 * create zip file based on source
 */
gulp.task('zippy', async function() {
  gulp.src(sourcePath + '/**')
    .pipe(zip(fileName + '.zip', {
      createSubFolders: true
    }))
    .pipe(gulp.dest(buildPath))
    .pipe(notify({ title: "Gulp - Zip", message: "WordPress plugin zipped" }));
});

/**
 * copy all source files and license
 */
gulp.task('copy', async function () {
  gulp.src(sourcePath + '/**')
    .pipe(gulp.dest(buildPath + '/' + fileName + '/'))
    .pipe(notify({ title: "Gulp - Copy", message: "WordPress plugin copied" }));
  gulp.src('license.txt')
    .pipe(gulp.dest(buildPath + '/' + fileName + '/'))
});

/**
 * copy all of source over to test path in subfolder
 */
gulp.task('test', async function () {
  gulp.src(sourcePath + '/**')
    .pipe(gulp.dest(testPath + '/' + fileName + '/'))
    .pipe(notify({ title: "Gulp - Test", message: "WordPress test site updated" }));
});

/**
 * publish task to output to WordPress plugin SVN repository
 */
gulp.task('publish', async function () {
  gulp.src(sourcePath + '/readme.txt')
    .pipe(gulp.dest(publishPath + '/trunk/'));
  gulp.src(sourcePath + '/assets/**')
    .pipe(gulp.dest(publishPath + '/assets/'));
  gulp.src(sourcePath + '/includes/**')
    .pipe(gulp.dest(publishPath + '/trunk/includes/'));
  gulp.src(sourcePath + '/*.php')
    .pipe(gulp.dest(publishPath + '/trunk/'))
    .pipe(notify({ title: "Gulp - Publish", message: "WordPress plugin SVN directory updated" }));
});

gulp.task('default', gulp.series('test', 'copy', 'zippy'));

gulp.task('watch', async function() {
  gulp.watch(sourcePath + '/**/*.php', gulp.series('test'));
});
