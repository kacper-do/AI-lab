let mix = require('laravel-mix');

mix.ts('index.ts', 'dist/script.js')
    .ts('script.ts', 'dist/alert.js')
    .setPublicPath('dist')
    .copyDirectory('style', 'dist/style');
