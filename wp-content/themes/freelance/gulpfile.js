var gulp = require('gulp');
var imagemin = require('gulp-imagemin');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var plumberErrorHandler = { errorHandler: notify.onError({

    title: 'Gulp',
    message: 'Error: <%= error.message %>'

  })

};

var sass = require('gulp-sass');
var bs = require('browser-sync').create(); // create a browser sync instance.

gulp.task('img', function() {

  gulp.src('img/src/*.{png,jpg,gif}')

    .pipe(imagemin({

      optimizationLevel: 7,
      progressive: true

    }))

    .pipe(gulp.dest('img'))

});



gulp.task('sass', function () {
    return gulp.src('./_build/css/style.scss')
    .pipe(gulp.dest('./'))
    .pipe(bs.stream());
});

gulp.task('serve', ['sass'], function(){
    bs.init({
        proxy: "http://blog.staging"
    });

    gulp.watch('./_build/css/style.scss', ['sass']);
    gulp.watch('./**/*.php').on('change', bs.reload);
});

gulp.task('default', ['serve']);
