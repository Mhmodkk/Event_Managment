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

            colors: {
                primary: {
                    light: '#355872',
                    DEFAULT: '#355872',
                    dark: '#DFD0B8',
                },
                secondary: {
                    light: '#7AAACE',
                    DEFAULT: '#7AAACE',
                    dark: '#948979',
                },
                accent: {
                    light: '#9CD5FF',
                    DEFAULT: '#9CD5FF',
                    dark: '#393E46',
                },
                background: {
                    light: '#F7F8F0',
                    DEFAULT: '#F7F8F0',
                    dark: '#222831',
                },
            }
        },
    },

    plugins: [forms],
};
