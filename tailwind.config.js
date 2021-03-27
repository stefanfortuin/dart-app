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
          'white': theme('colors.gray.100'),
          'lightblue': theme('colors.blue.400'),
        })
    },
    variants: {
        extend: {
            borderColor: ["active"],
            backgroundColor: ["active"],
            textColor: ["active"],
			borderRadius: ['first','last']
        },
    },
    plugins: [],
};
