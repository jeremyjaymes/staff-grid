var gulp = require('gulp');
    cleanCSS = require('gulp-clean-css');
    uglify = require('gulp-uglify');
    rename = require('gulp-rename');

var config ={
    cssDir: 'css/',
    jsDir: 'js/'
};

gulp.task('css', function() {
  return gulp.src([config.cssDir + '*.css', '!css/*.min.css'])
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(rename({
        suffix: '.min'
    }))
    .pipe(gulp.dest(config.cssDir));
});

gulp.task('compress', function() {
    var options = {
        preserveComments: 'license'
    };
    return gulp.src([config.jsDir + '*.js', '!js/*.min.js'])
        .pipe(uglify(options))
        .pipe(rename({
            suffix: '.min'
        }))
        .pipe(gulp.dest(config.jsDir));
});

gulp.task('watch', function() {
    gulp.watch(config.cssDir + '*.css', ['css']),
    gulp.watch(config.jsDir + '*.js', ['compress'])
});

gulp.task('default', ['watch']);