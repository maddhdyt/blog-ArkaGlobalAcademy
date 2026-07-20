import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Karla', ...defaultTheme.fontFamily.sans],
                heading: ['Karla', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: {
                    primary: '#0f172a',
                    secondary: '#f8fafc',
                    accent: '#ea580c',
                },
            },
        },
    },

    plugins: [forms],
};
