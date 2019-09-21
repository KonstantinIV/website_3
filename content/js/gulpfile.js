var gulp = require('gulp'),
    gp_concat = require('gulp-concat'),
    gp_rename = require('gulp-rename'),
    gp_uglify = require('gulp-uglify'),
    gp_sourcemaps = require('gulp-sourcemaps');

gulp.task('js-fef', function(){
    return gulp.src("/Users/Konstantin/Desktop/website_3/content/*.js")
        .pipe(gp_sourcemaps.init())
        .pipe(gp_concat('concat.js'))
        .pipe(gulp.dest('dist'))
        .pipe(gp_rename('uglify.js'))
        .pipe(gp_uglify())
        .pipe(gp_sourcemaps.write('./'))
        .pipe(gulp.dest('dist'));
});

gulp.task('default', ['js-fef'], function(){});