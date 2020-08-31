const defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config.js' );
const path = require( 'path' );

module.exports = {
	...defaultConfig,
	resolve: { alias: { vue: 'vue/dist/vue.esm.js' } },
	/*
	externals: {
		...defaultConfig.externals,
		$: 'jQuery',
		jquery: 'jQuery'
	},
	*/
	entry: {
		default_variables: path.resolve( process.cwd(), 'src', 'default_variables.scss' ),
		global: path.resolve( process.cwd(), 'src', 'global.js' ),
		backend: path.resolve( process.cwd(), 'src', 'backend.js' ),
		frontend: path.resolve( process.cwd(), 'src', 'frontend.js' ),
	},
};