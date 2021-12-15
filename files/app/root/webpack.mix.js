const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const path = require('path');

// App
mix.ts('resources/app/js/app.ts', 'public/js').vue();
mix.postCss('resources/app/css/app.css', 'public/css/app', [
    tailwindcss('./tailwind.config.js'),
]);
mix.alias({
    '@app': path.join(__dirname, 'resources/app/js'),
});
