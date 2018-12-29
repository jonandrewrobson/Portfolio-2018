var gulp        = require('gulp');
var uglify      = require('gulp-uglify');
var sass        = require('gulp-sass');
var plumber     = require('gulp-plumber');
var browserSync = require('browser-sync').create();


// Scripts Task
gulp.task('scripts', function(cb){
  return gulp.src('js/*.js')
    .pipe(plumber())
    .pipe(uglify())
    .pipe(gulp.dest('build/minjs'))
    cb
});

// Compile sass into CSS & auto-inject into browsers

gulp.task('styles', function(cb){
  return gulp.src('scss/*.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(gulp.dest('build/css/'))
    .pipe(browserSync.stream());
    cb
});

// Static Server + watching scss/html files
gulp.task('serve', function(cb) {
    browserSync.init({
        server: "./journal"
    });
    cb
});

gulp.task('watch', function(cb) {
	gulp.watch("js/*.js", gulp.parallel('scripts'));
	gulp.watch("scss/*.scss", gulp.parallel('styles'));
    gulp.watch("journal/*.html").on('change', browserSync.reload);
    cb
});


// Gulp Default Task
gulp.task("default", gulp.parallel('scripts', 'styles' , 'watch' , 'serve'));
