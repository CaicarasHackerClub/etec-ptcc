'use strict';

var gulp    = require('gulp'),
    phpcs   = require('gulp-phpcs'),
    jshint  = require('gulp-jshint'),
    csslint = require('gulp-csslint');

gulp.task('js', function() {
    return gulp.src(['js/*.js', '!js/*.min.js'])
        .pipe(jshint())
        .pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('css', function() {
    return gulp.src('css/*.css')
        .pipe(csslint())
        .pipe(csslint.formatter(require('csslint-stylish')));
});

gulp.task('php', function() {
    return gulp.src(['index.php', 'backend/*.php'])
        .pipe(phpcs({
            bin: '/usr/bin/phpcs',
            encoding: 'utf-8',
            standard: 'PSR2',
            phpVerion: '70',
            colors: 1,
            warningSeverity: 1,
            errorSeverity: 1,
            tabWidth: 4
        }))
        .pipe(phpcs.reporter('log'));
});

gulp.task('front', [ 'js', 'css' ]);
gulp.task('back', [ 'php' ]);

