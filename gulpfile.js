var gulp = require('gulp'),
  connect = require('gulp-connect-php'),
  browserSync = require('browser-sync'),
  sass = require('gulp-sass');
 
function css() {
  return gulp.src('./private/assets/scss/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./public/css'))
    .pipe(browserSync.stream());
}

function connect_sync() {
  connect.server({}, function (){
    browserSync({
      proxy: '127.0.0.1:8000'
    });
  });
 
  gulp.watch('./private/**/*.php').on('change', function () {
    browserSync.reload();
  });
  gulp.watch('./private/assets/scss/*.scss').on('change', css);
};

// Allows us to type 'gulp' in console and create
// a php server with running browserSync, that ensures
// that every time scss files are updated, css file regenerates
// and browser refreshes.
exports.default = connect_sync;