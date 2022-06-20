const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Open Sans", ...defaultTheme.fontFamily.sans],
            },
            container: {
                center: true,
            },
        },
    },

    plugins: [require("@tailwindcss/forms")],
};
