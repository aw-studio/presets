const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const path = require('path');

// Admin-App
mix.ts('resources/app/js/app.ts', 'public/js').vue();
mix.postCss('resources/app/css/app.css', 'public/css/app', [
    tailwindcss('./tailwind.config.js'),
]);
mix.alias({
    '@app': path.join(__dirname, 'resources/app/js'),
});

// Admin-App
mix.ts('resources/admin/js/app.ts', 'public/js/admin').vue();
mix.postCss('resources/admin/css/app.css', 'public/css/admin', [
    tailwindcss('./admin.tailwind.config.js'),
]);
mix.alias({
    '@admin': path.join(__dirname, 'resources/admin/js'),
});