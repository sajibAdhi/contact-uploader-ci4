var gulp = require('gulp');
var copy = require('gulp-copy');

gulp.task('copyAdminLTE', function () {
    return gulp.src('./node_modules/admin-lte/dist/**/*')
        .pipe(copy('./public/assets/admin-lte', {prefix: 4}));
});

gulp.task('default', gulp.series('copyAdminLTE'));