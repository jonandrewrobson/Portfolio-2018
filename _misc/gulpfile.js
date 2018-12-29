var gulp        = require('gulp');
var sass        = require('gulp-sass');
var plumber     = require('gulp-plumber');
var browserSync = require('browser-sync').create();


// Scripts Task
gulp.task('scripts', function(cb){
  return gulp.src('assets/js/*.js')
    .pipe(plumber())
    .pipe(gulp.dest('assets/minjs'))
    cb
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('styles', function(cb){
  return gulp.src('assets/scss/*.scss')
    .pipe(plumber())
    .pipe(sass())
    .pipe(gulp.dest('assets/css/'))
    .pipe(browserSync.stream());
    cb
});

// Static Server + watching scss/html files
gulp.task('serve', function(done) {
    browserSync.init({
        server: "journal"
    });
    done
});

gulp.task('watch', function(cb) {
	gulp.watch("assets.js/*.js", gulp.parallel('scripts'));
	gulp.watch("assets/scss/*.scss", gulp.parallel('styles'));
    gulp.watch("journal/*.html").on('change', browserSync.reload);
    cb
});


// Gulp Default Task
gulp.task("default", gulp.parallel('scripts', 'styles' , 'watch' , 'serve'));
