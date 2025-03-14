import gulp from "gulp";
import gulpSass from "gulp-sass";
import dartSass from "sass";
import autoprefixer from "autoprefixer";
import postcss from "gulp-postcss";
import sourcemaps from "gulp-sourcemaps";
import cssnano from "cssnano";
import concat from "gulp-concat";
import terser from "gulp-terser-js";
import rename from "gulp-rename";
import notify from "gulp-notify";
import cache from "gulp-cache";
import clean from "gulp-clean";
import webp from "gulp-webp";
import imagemin from "gulp-imagemin";
import webpackStream from "webpack-stream";




const sass = gulpSass(dartSass);

const paths = {

    scss: "src/scss/**/*.scss",
    js: "src/js/**/*.*js",
    imagenes: "src/img/**/*",
};

export function css() {
    return gulp
        .src(paths.scss)
        .pipe(sourcemaps.init())
        .pipe(sass())
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write("."))
        .pipe(gulp.dest("./public/build/css"))
}

export function javascript() {
    return gulp
        .src(paths.js)
        .pipe(webpackStream({
            mode:"production",
            entry:"./src/js/index.js"
        }))
        .pipe(sourcemaps.init())
        .pipe(concat("bundle.js"))
        .pipe(terser())
        .pipe(sourcemaps.write("."))
        .pipe(rename({ suffix: ".min" }))
        .pipe(gulp.dest("./public/build/js"))
}

export async function imagenes() {
    return gulp
        .src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(gulp.dest("./public/build/img"))
}

export function versionWebp() {
    return gulp
        .src(paths.imagenes)
        .pipe(webp())
        .pipe(gulp.dest("./public/build/img"))
}

export function watchArchivos() {
    gulp.watch(paths.scss, css);
    gulp.watch(paths.js, javascript);
    gulp.watch(paths.imagenes, imagenes);
    gulp.watch(paths.imagenes, versionWebp);
}


export default gulp.parallel(
    css,
    javascript,
    imagenes,
    versionWebp,
    watchArchivos
);
