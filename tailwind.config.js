module.exports = {
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {},
        stroke: theme => ({
          'blue': theme('colors.blue.600'),
          'lightblue': theme('colors.blue.200'),
        })
    },
    variants: {
        extend: {
            borderColor: ["active"],
            backgroundColor: ["active"],
            textColor: ["active"],
        },
    },
    plugins: [],
};
