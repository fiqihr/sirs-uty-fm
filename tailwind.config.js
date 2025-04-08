import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                poppins: ["Poppins", "sans-serif"],
                inter: ["Inter", "sans-serif"],
            },
            colors: {
                primary: "#DAD2FF",
                secondary: "#9852F9"
            },
        },

        // colors: {
        //     primary: "#B1AFFF",
        // },
    },

    plugins: [forms],
};
