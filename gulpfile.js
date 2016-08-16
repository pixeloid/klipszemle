var gulp = require('gulp');
var mainBowerFiles = require('main-bower-files');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var gulpFilter = require('gulp-filter');
var browserSync = require('browser-sync').create();
var sass        = require("gulp-sass");
var sourcemaps = require('gulp-sourcemaps');
var image = require('gulp-image');

var config = {
     sassPath: './resources/sass',
     bowerDir: './app/Resources/public/vendor/'
}


gulp.task('image', function () {
  gulp.src('./app/Resources/public/images/*')
    .pipe(image())
    .pipe(gulp.dest('./web/images'));
});


gulp.task('main-bower-files', function() {
    
    var filterJS = gulpFilter('**/*.js', { restore: true });
    
    return gulp.src(mainBowerFiles({
            paths: {
                bowerDirectory: config.bowerDir
            }
        }))
        .pipe(filterJS)
        .pipe(concat('vendor.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./web/libs'));

});


gulp.task('sass', ['sass-admin'], function () {
 return gulp.src('./app/Resources/public/scss/styles.scss')
  .pipe(sourcemaps.init())
  .pipe(sass({
             includePaths: [
                 'app/Resources/public/scss/',
                 'app/Resources/public/vendor'
             ]

    }).on('error', sass.logError))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./web/styles'))
  .pipe(browserSync.stream())

});

gulp.task('sass-admin',  function () {
 return gulp.src('./app/Resources/public/scss/admin.scss')
  .pipe(sourcemaps.init())
  .pipe(sass({
             includePaths: [
                 'app/Resources/public/scss/',
                 'app/Resources/public/vendor'
             ]

    }).on('error', sass.logError))
  .pipe(sourcemaps.write())
  .pipe(gulp.dest('./web/styles'))
  .pipe(browserSync.stream())

});

gulp.task('scripts', function() {
  return gulp.src('./app/Resources/public/scripts/*.js')
    .pipe(concat('app.js'))
    .pipe(uglify())
    .pipe(gulp.dest('./web/scripts/'));
});


gulp.task('serve', ['main-bower-files', 'sass', 'scripts', 'image'], function() {
    browserSync.init({
        proxy: "localhost:8000"
    });

    gulp.watch("app/Resources/public/scripts/**/*.js", ['scripts']);
    gulp.watch("app/Resources/public/scss/**/*.scss", ['sass']);
    gulp.watch("app/Resources/public/images/**/*", ['image']);
    gulp.watch("**/*.twig").on('change', browserSync.reload);

});
