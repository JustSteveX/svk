import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import'tailwindcss.Config} */
module.exports = {
	content: [
		'./resources/**/*.blade.php',
		'./resources/**/*.js',
		'./node_modules/flowbite/**/*.js',
	],

	theme: {
		extend: {
			fontFamily: {
				sans: ['Nunito', ...defaultTheme.fontFamily.sans],
			},
			backgroundImage: {
				schuetzenhaus: "url('../images/schuetzenhaus.jpg')",
			},
			gap: {
				6: '1.4rem',
			},
			colors: {
				'custom-green': {
					900: '#283d27',
				},
			},
		},
	},
	variants: {
		extend: {
			visibility: ['group-hover'],
		},
	},

	plugins: [
		forms,
		require('@tailwindcss/typography'),
		require('flowbite/plugin'),
	],
};
