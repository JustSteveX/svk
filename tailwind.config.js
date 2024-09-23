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
				sedansc: ['sedansc', ...defaultTheme.fontFamily.serif],
				'ubuntu-sans': ['UbuntuSans', ...defaultTheme.fontFamily.sans],
			},
			backgroundImage: {
				schuetzenhaus: "url('/images/schuetzenhaus.jpg')",
			},
			gap: {
				6: '1.4rem',
			},
			colors: {
				'custom-green': {
					900: '#283d27', // startseite willkommen box
					// 700: '#357960',
					// 500: '#418e3f',
				},
				primary: {
					// DEFAULT: '#2c943e',
					DEFAULT: '#286027', // leicht abgeändert von #418e3f
					// 50: '#ffffff',
					// 100: '#ffffff',
					// 200: '#ffffff',
					// 300: '#ffffff',
					// 400: '#ffffff',
					500: '#2c943e',
					// 600: '#ffffff',
					// 700: '#ffffff',
					// 800: '#ffffff',
					900: '#357960',
				},
				accent: {
					DEFAULT: '#155993',
					50: '#e9e9df', // sehr helles blau
					//100: '#ffffff',
					200: '#6ca7d2',
					//300: '#ffffff',
					//400: '#ffffff',
					500: '#155993', // blauton
					//600: '#ffffff',
					700: '#c6a937', // gelb
					//800: '#ffffff',
					900: '#002c00',
					//900: '#1d1d35', // blaugrau
				},
				warning: {
					DEFAULT: '#cc2424',
					//50: '#ffffff',
					//100: '#ffffff',
					//200: '#ffffff',
					//300: '#ffffff',
					//400: '#ffffff',
					500: '#f59e0b',
					//600: '#ffffff',
					//700: '#ffffff',
					//800: '#ffffff',
					//900: '#ffffff',
				},
				blackish: {
					DEFAULT: 'rgba(0, 0, 0, 0.7)',
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
