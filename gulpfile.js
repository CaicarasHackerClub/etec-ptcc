var gulp    = require('gulp'),
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
        .pipe(csslint.formatter(require('csslint-stylish')))
});

gulp.task('front', [ 'js', 'css' ]);

