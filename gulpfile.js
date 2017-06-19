/* desktop/MariamFaso
 *
 * /gulfile.js - Gulp Tasks
 *
 * coded by maxime@flatLand !
 * started at 07/04/2017
 */
var gulp = require("gulp"),
    image = require("gulp-image"),
    sass = require("gulp-sass"),
    autoprefixer = require("gulp-autoprefixer"),
    csso = require("gulp-csso"),
    babel = require("gulp-babel"),
    sourcemaps = require("gulp-sourcemaps"),
    browserSync = require('browser-sync').create();

// --- Task for images
gulp.task("images", function() {
    gulp.src("src/images/**")
        .pipe(image())
        .pipe(gulp.dest("assets/images"));
});

// --- Task for styles 
gulp.task("css", function() {
    gulp.src("src/sass/**/*.scss")
        .pipe(sass().on("error", sass.logError))
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(csso())
        .pipe(gulp.dest("assets/css"))
        .pipe(browserSync.stream());
});

// --- Task for fonts
gulp.task("fonts", function() {
    gulp.src("src/fonts/**/*.ttf")
        .pipe(gulp.dest("assets/fonts"));
});

// --- Task for js
gulp.task("js", function() {
    gulp.src("src/js/**/*.js")
        .pipe(sourcemaps.init())
        .pipe(babel())
        .on("error", function(oError) {
            console.error(oError);
            this.emit("end");
        })
        .pipe(sourcemaps.write())
        .pipe(gulp.dest("assets/js"));
});


// --- Task for browser-sync
gulp.task('serve', ['css'], function() {

    browserSync.init({
        server: "./assets"
    });

});

// --- Watch tasks
gulp.task("watch", function() {
    //gulp.watch("src/images/**", ["images"]);
    gulp.watch("src/sass/**/*.scss", ["css"]);
    gulp.watch("src/fonts/**/*.ttf", ["fonts"]);
    gulp.watch("src/js/**/*.js", ["js"]);
});

// --- Aliases
gulp.task("default", [ "css", "js", "fonts", "serve"]);
gulp.task("work", ["default", "watch"]);