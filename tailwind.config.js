const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sky: colors.sky,
                teal: colors.teal,
                rose: colors.rose,
            },
            animation: {
                'spin-slow' : 'spin 4s linear infinite',
                'spin-slower' : 'spin 6s linear infinite',
                'spin-reverse-slower' : 'spin-reverse 6s linear infinite'
            },
            keyframes: {
                'spin-reverse': {
                    to: {
                        transform: 'rotate(-360deg)',
                    },
                },
            },
        },
    },
    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};