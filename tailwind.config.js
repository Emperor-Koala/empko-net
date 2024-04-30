import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    darkMode: 'class',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            transitionProperty: {
                'menu-toggle': 'opacity, transform',
                'menu': 'opacity, top',
            },
            colors: {
                primary: {
                    50: '#e2f2f8',
                    100: '#b7dfec',
                    200: '#88cae0',
                    300: '#58b5d4',
                    400: '#34a5ca',
                    500: '#1095c1',
                    600: '#0e8dbb',
                    700: '#0c82b3',
                    800: '#0978ab',
                    900: '#05679e',
                    DEFAULT: '#1095c1',
                },
                github: {
                    400: '#5e5e5e',
                    500: '#4e4e4e',
                    600: '#3e3e3e',
                    DEFAULT: '#4e4e4e',
                },
                neutral: {
                    350: '#b9b9b9',
                },
                gray: {
                    750: "#2b3545",
                }
            },
            flex: {
                '2': '2 2 0%',
            },
        },
    },

    plugins: [forms],
};
