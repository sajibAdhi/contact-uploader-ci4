var gulp = require('gulp');

gulp.task('copy-adminlte', function () {
    return gulp.src(['node_modules/admin-lte/dist/**']) // source of the files
        .pipe(gulp.dest('public/assets/admin-lte')); // destination of the files
});

gulp.task('default', gulp.series('copy-adminlte'));