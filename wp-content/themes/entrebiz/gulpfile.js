var gulp = require('gulp'),
    gutil = require('gulp-util'),
    minifycss = require('gulp-minify-css'),
    scss = require('gulp-sass'),
    notify = require('gulp-notify'),
    zip = require('gulp-zip'),
    autoprefixer = require('gulp-autoprefixer');

const { series } = require('gulp');
const { parallel } = require('gulp');


var plugins = require("gulp-load-plugins")({
    pattern: ['gulp-*', 'gulp.*'],
    replaceString: /\bgulp[\-.]/
});

var browserSync = require('browser-sync');
var reload = browserSync.reload;

var paths = {

    scripts: {
        src: 'src/js/',
        dest: 'assets/public/js/',
    },

    styles: {
        src: 'src/css/',
        dest: 'assets/public/css/',
    },

    scss: {
        src: 'src/scss/',
        dest: 'assets/public/css/',
    }

};

var appFiles = {
    scripts: [paths.scripts.src + 'vendor/*.js'],
    mainScript: paths.scripts.src + 'main.js',
    styles: [paths.styles.src + '*.css'],
    scss: paths.scss.src + "**",
    scssStyle: paths.scss.src + "main.scss",
    mainStyle: paths.styles.dest + "main.css"
};

function vendorScripts(cb){
    gulp.src(appFiles.scripts)
        .pipe(gulp.dest(paths.scripts.dest));
cb();
}
function mainScript(cb){
    gulp.src(appFiles.mainScript)
        .pipe(gulp.dest(paths.scripts.dest));
cb();
}
function minScripts(cb){
    var arr = appFiles.scripts;
    arr.push(appFiles.mainScript);

    gulp.src(arr)
        .pipe(plugins.concat('min.js'))
        .pipe(plugins.uglify())
        .pipe(gulp.dest(paths.scripts.dest));
cb();
}
function vendorStyles(cb){
    gulp.src(appFiles.styles)
        .pipe(gulp.dest(paths.styles.dest))
        .pipe(notify({
            message: 'Vendor Styles',
            onLast: true
        }));
cb();
}
function mainStyle(cb){
    gulp.src(appFiles.scssStyle)
        .pipe(scss())
        .pipe(plugins.concat('main.css'))
        .pipe(autoprefixer({
            remove: false,
            browsers: ['last 4 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4']
        }))
        .pipe(gulp.dest(paths.styles.dest));
cb();
}
function minStyles(mainStyle){
    setTimeout(function() {
        var arr = '';
        arr = appFiles.styles;
        arr.push(appFiles.mainStyle);



        gulp.src(arr)
            .pipe(plugins.concat('min.css'))
            .pipe(minifycss())
            .pipe(gulp.dest(paths.styles.dest))
            .pipe(reload({
                stream: true
            }));

    }, 1000);
    mainStyle();
}
function watch(){
    gulp.watch(appFiles.mainScript, series(mainScript, minScripts));
    gulp.watch(appFiles.scss, series(mainStyle, minStyles));
}
//exports.vendorScripts = vendorScripts;
exports.default = series( vendorScripts, mainScript, minScripts, vendorStyles, mainStyle, minStyles, watch);