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
        darkMode: false,
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                poppins: ["Poppins", "sans-serif"],
                inter: ["Inter", "sans-serif"],
                montserrat: ["Montserrat", "sans-serif"],
            },
            colors: {
                // primary: "#DAD2FF",
                yellow_1: "#febe01",
                red_1: "#a70808",
                red_2: "#d00302",
                red_3: "#ffa3a3",
                red_4: "#ff7c7c",
                grd1: "#FFAD60",
                grd2: "#D74B76",
                grd3: "#96CEB4",
            },
        },

        // colors: {
        //     primary: "#B1AFFF",
        // },
    },

    plugins: [forms],
};
