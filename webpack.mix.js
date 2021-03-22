const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
	.vue({runtimeOnly: true})
	.postCss('resources/css/app.css', 'public/css', [
		require('@tailwindcss/jit'),
	])
	.webpackConfig({
		devServer: {
			host: '0.0.0.0',
			port: 8080,
		},
	})
	.options({
		hmrOptions: {
			host: 'localhost',
			port: 8080,
		},
	})
