import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php'
    ],
    safelist: [
        'bg-[#EC1A1A]',
        'bg-[#06BA66]',
        'bg-[#FFCD05]',
        'bg-opacity-40',
        'bg-[rgba(5,230,255,0.4)]',
        'text-white',
        'text-black',
    ],
    layers: {
        base: true,
        components: true,
        utilities: true,
    },
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
