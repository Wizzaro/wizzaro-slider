var gulp = require('gulp');
var gulpSass = require('gulp-sass');
var gulpCssMin = require('gulp-cssmin');
var gulpStripCssComments = require('gulp-strip-css-comments');
var gulpRename = require('gulp-rename');
var gulpConcat = require('gulp-concat');
var gulpUglify = require('gulp-uglify');

gulp.task('style-front', function() {
    gulp.src('./assets-dev/front/sass/slider/slider.scss')
        .pipe(gulpSass().on('error', gulpSass.logError))
        .pipe(gulpStripCssComments())
        .pipe(gulpCssMin())
        .pipe(gulp.dest('./assets/css/'));
});

gulp.task('js-front', function() {
    gulp.src(['./assets-dev/front/js/slider/slider.js', './assets-dev/front/js/slider/libs/**/*.js'])
        .pipe(gulpConcat('slider.js'))
        .pipe(gulpUglify().on('error', function(err) {
            console.error(err.toString());
        }))
        .pipe(gulp.dest('./assets/js/'));
});

gulp.task('style-admin', function() {
    gulp.src('./assets-dev/admin/sass/metabox-slides/metabox-slides.scss')
        .pipe(gulpSass().on('error', gulpSass.logError))
        .pipe(gulpStripCssComments())
        .pipe(gulpCssMin())
        .pipe(gulp.dest('./assets/css/admin'));

    gulp.src('./assets-dev/admin/sass/tinymce/plugin/wizzaro-slider.scss')
        .pipe(gulpSass().on('error', gulpSass.logError))
        .pipe(gulpStripCssComments())
        .pipe(gulpCssMin())
        .pipe(gulp.dest('./assets/css/admin/tinymce/plugin'));
});

gulp.task('js-admin', function() {
    gulp.src([
        './assets-dev/admin/js/metabox-slides/main.js',
        './assets-dev/admin/js/metabox-slides/config/*.js',
        './assets-dev/admin/js/metabox-slides/entity/*.js',
        './assets-dev/admin/js/metabox-slides/collections/*.js',
        './assets-dev/admin/js/metabox-slides/view/*.js'
    ])
        .pipe(gulpConcat('metabox-slides.js'))
        .pipe(gulpUglify().on('error', function(err) {
            console.error(err.toString());
        }))
        .pipe(gulp.dest('./assets/js/admin'));

    gulp.src('./assets-dev/admin/js/tinymce/plugin/*.js')
        .pipe(gulpUglify().on('error', function(err) {
            console.error(err.toString());
        }))
        .pipe(gulp.dest('./assets/js/admin/tinymce/plugin/'));
});

gulp.task('default', ['style-front', 'style-admin', 'js-front', 'js-admin']);
