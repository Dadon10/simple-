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
                sans: ['Inter', 'Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                sanlam: {
                    primary: '#0076BE', // Lochmara Blue
                    secondary: '#2C3E50', // Kuroi Black
                    accent: '#F9DCB8', // Mikado Yellow
                    bigstone: '#4A4A4A',
                    silt: '#D1D1D1',
                },
            },
            boxShadow: {
                card: '0 2px 8px rgba(0, 0, 0, 0.08)',
            },
        },
    },

    plugins: [forms],
};
