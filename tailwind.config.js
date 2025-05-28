import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
const plugin = require('tailwindcss/plugin')

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            textShadow: {
                sm: '0 1px 2px var(--tw-shadow-color)',
                DEFAULT: '0 2px 4px var(--tw-shadow-color)',
                lg: '0 8px 16px var(--tw-shadow-color)',
            },

            keyframes: {
                'gradient-animation': {
                    '0%': { backgroundPosition: '0% 50%' },
                    '50%': { backgroundPosition: '100% 50%' },
                    '100%': { backgroundPosition: '0% 50%' },
                },
                'line-animation': {
                    '0%': { backgroundPosition: '0 0' },
                    '100%': { backgroundPosition: '100% 100%' },
                },
            },
            animation: {
                'gradient-bg': 'gradient-animation 10s ease infinite',
                'moving-lines': 'line-animation 40s linear infinite',
            },
            backgroundSize: {
                '400%': '400% 400%',
                'lines': '450px 450px', // Tamaño del patrón de líneas
            },
            backgroundImage: {
                'diagonal-lines': 'linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent)',
            },
            // Fuentes Personalizadas
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                encode: ['EncodeSans', 'sans-serif'], // Fuente local
                burtons: ['Burtons'], // Fuente local
                burtonsscript: ['BurtonsScript'], // Fuente local
                brotherline: ['Brotherline'], // Fuente local
                ochitylla: ['Ochitylla'], // Fuente local
            },
            // paleta de colores personalizadas
            colors: {
                ocean: {
                    lightest: '#294D61',
                    lighter: '#6DA5C0',
                    light: '#0F969C',
                    main: '#0C7075', // Este será el color por defecto (sin sufijo)
                    dark: '#072E33',
                    darker: '#05161A',
                },
                kansai: {
                    meditation: '#AAD0E2',
                    foamysea: '#87B1C8',
                    chinasilk: '#7198AF', // Este será el color por defecto (sin sufijo)
                    lunarblue: '#5B8094',
                    sapphiremagic: '#153A50',
                },
                everest: {
                    lightest: '#0791B1',
                    lighter: '#CBE2E7',
                    light: '#E3F5F9',
                    main: '#E8E5E5', // Este será el color por defecto (sin sufijo)
                    dark: '#BFB7B5',
                    darker: '#908B92',
                },
            },
        },
    },

    plugins: [
        forms,
        plugin(function ({ matchUtilities, theme }) {
            matchUtilities(
                {
                    'text-shadow': (value) => ({
                        textShadow: value,
                    }),
                },
                { values: theme('textShadow') },
            )
        }),
    ],
};
