module.exports = {
    mode: "jit",
    purge: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        extend: {
			borderWidth: {
				'3': '3px',
			},
			minHeight: {
				'32': '8rem',
				'40': '10rem',
			},
			flex: {
				'100': '1 1 100%',
			},
            screens: {
                'xsm': '375px',
                'xs': '425px'
            },
            boxShadow: {
                'up': '0px 10px 15px 11px rgba(0, 0, 0, 0.1), 0 4px 6px 8px rgba(0, 0, 0, 0.05)'
            }
		},
        stroke: theme => ({
			'graphaxis': theme('colors.blue.100'),
          	'white': theme('colors.white'),
         	'lightblue': theme('colors.blue.400'),
			'darkblue': theme('colors.blue.900')
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
