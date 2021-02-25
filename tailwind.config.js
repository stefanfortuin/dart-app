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
          'gray': theme('colors.blue.200'),
          'blue': theme('colors.blue.600'),
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
