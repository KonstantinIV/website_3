//script paths
var gulp = require('gulp');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var babel = require('gulp-babel');


var jsFiles = '../content/js/**/*',
jsDumpdest = '../content/mainJS';
jsDest = '../content/mainJS';

gulp.task('watch', function() {
    gulp.watch('../content/js/**/*', gulp.series('scripts'));

});


gulp.task('scripts', function() {
    return gulp.src(jsFiles)
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest(jsDumpdest))
        .pipe(rename('scripts.min.js'))
        .pipe(babel({ presets: ['@babel/preset-env'] }))
        .pipe(uglify())
        .pipe(gulp.dest(jsDest));
});