import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

    
/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // './vendor/wireui/wireui/resources/**/*.blade.php',
        // './vendor/wireui/wireui/ts/**/*.ts',
        // './vendor/wireui/wireui/src/View/**/*.php',
        // './app/Livewire/**/*Table.php',
        // './vendor/power-componen0ts/livewire-powergrid/resources/views/**/*.php',
        // './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    corePlugins: {
        transitionProperty: true,
        transitionDuration: true,
        transform: true // ¡Agrega esto si usas rotaciones!
    },

    plugins: [forms, typography],
};

