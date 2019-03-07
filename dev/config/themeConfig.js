'use strict';

module.exports = {
	theme: {
		slug: 'mlapetdeals',
		name: 'MLA Pet Deals',
		author: 'MLA Web Designs'
	},
	dev: {
		browserSync: {
			live: true,
			proxyURL: 'http://localhost:4567/petdeals',
			bypassPort: '8181'
		},
		browserslist: [ // See https://github.com/browserslist/browserslist
			'> 1%',
			'last 2 versions'
		],
		debug: {
			styles: false, // Render verbose CSS for debugging.
			scripts: false // Render verbose JS for debugging.
		}
	},
	export: {
		compress: true
	}
};
