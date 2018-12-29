var gulp = require('gulp');
var uglify = require('gulp-uglify');
// var less = require('gulp-scss');
// var minifyCSS = require('gulp-csso');
// var concat = require('gulp-concat');
// var sourcemaps = require('gulp-sourcemaps');

// gulp.task('styles', function(cb){
//   return gulp.src('css/*.css')
//     .pipe(uglify())
//     .pipe(gulp.dest('build/mincss'))
//     cb
// });

// Scripts Task
gulp.task('scripts', function(cb){
  return gulp.src('js/*.js')
    .pipe(uglify())
    .pipe(gulp.dest('build/minjs'))
    cb
});

// Watch Task
// Watches js
function watchFiles() {
  gulp.watch("js/*.js", gulp.parallel('scripts'));
}

// watch
gulp.task("watch", gulp.parallel(watchFiles));

gulp.task("default", gulp.parallel('scripts', 'watch'));
