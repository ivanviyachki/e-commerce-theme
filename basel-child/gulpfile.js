var gulp = require('gulp');
var sass = require('gulp-sass');
var cssnano = require('cssnano');
var autoprefixer = require('autoprefixer');
var concat = require('gulp-concat');
var rename = require('gulp-rename');
var uglify = require('gulp-uglify');
var notify = require('gulp-notify');
var flatten = require('gulp-flatten');
var merge = require('merge-stream');
var sourcemaps = require('gulp-sourcemaps');
var browserSync = require('browser-sync').create();
var svgo = require('gulp-svgo');
var svgsprite = require('gulp-svg-sprite');

gulp.task('copy-resources', function() {
    var jsResources = gulp.src([
        'resources/vendors/**/*.js'
    ])
        .pipe(flatten())
        .pipe(gulp.dest('assets/js'));

    var cssResources = gulp.src([
        'resources/vendors/**/*.css'
    ])
        .pipe(flatten())
        .pipe(gulp.dest('assets/css'));

    return merge(jsResources, cssResources);
});

gulp.task('styles', () => {
    var plugins = [
        autoprefixer(),
        cssnano()
    ];

    var scssStream = gulp.src([
        'resources/scss/**/*.scss',
    ])
        // Process SCSS to CSS
        .pipe(sass().on('error', notify.onError((error) => {
            return 'Error:' + error.message;
        })))

        .pipe(concat('scss-files.css'));

    return merge(scssStream)
        .pipe(concat('theme.css'))

        // Save unminified file
        .pipe(gulp.dest('assets/css/'))

        // Rename minified file
        .pipe(rename({suffix: '.min'}))

        // Save minified file
        .pipe(gulp.dest('assets/css/'))

        // Stream CSS changes to the opened browsers
        .pipe(browserSync.stream());
});

gulp.task('scripts', () => {
    return gulp.src([
        'resources/js/components/**.js',
        'resources/js/theme.js',
    ])
        .pipe(concat('theme.js'))

        // Save unminified file
        .pipe(gulp.dest('assets/js'))

        // Minify scripts
        .pipe(uglify())

        // Rename minified file
        .pipe(rename({suffix: '.min'}))

        // Save minified file
        .pipe(gulp.dest('assets/js'));
});

gulp.task('svg-sprite', () => {
    var config = {
        svg: {
            transform: [
                /**
                 * Remove fill and stroke attributes so it can be styled with CSS
                 * @param svg
                 */
                function(svg) {
                    svg = svg.replace(/fill=".*?"/g, '');
                    svg = svg.replace(/stroke=".*?"/g, '');

                    return svg;
                }
            ]
        },
        mode: {
            shape: {
                dimension: {
                    maxWidth: 18,
                    maxHeight: 18,
                },
            },
            symbol: {
                dest: '.',
                sprite: 'icons-sprite.svg',
            }
        }
    };

    return gulp.src('resources/svg/**/*.svg')
        .pipe(svgo())
        .pipe(svgsprite(config))
        .pipe(gulp.dest('assets'));
});

gulp.task('watch', () => {

    // Init BrowserSync server
    browserSync.init({
        proxy: "local.arreda.bg",
    });

    // Run clean and styles tasks on SCSS changes
    gulp.watch([
        'resources/scss/**/*.scss',
        'resources/css/**/*.css',
        'resources/js/**/*.js',
    ], (done) => {
        gulp.series(['styles', 'scripts'])(done);
    });
});

gulp.task('default', gulp.series(['copy-resources', 'styles', 'scripts', 'svg-sprite']));