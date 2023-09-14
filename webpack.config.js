const { CleanWebpackPlugin } = require( 'clean-webpack-plugin' );
let defaultConfig = require( './node_modules/@wordpress/scripts/config/webpack.config.js' );
const path = require( 'path' );

// Ensure CleanWebpackPlugin doesn't remove composer build dir from php-scoper
let plugins = defaultConfig.plugins;
for ( let i in plugins ) {
	if ( plugins[ i ] instanceof CleanWebpackPlugin ) {
		plugins[ i ] = new CleanWebpackPlugin( {
			cleanAfterEveryBuildPatterns: [
				'!fonts/**',
				'!images/**',
				'!composer/**',
			],
			cleanOnceBeforeBuildPatterns: [ '**/*', '!composer/**' ],
		} );
	}
}
defaultConfig.plugins = plugins;

// Fix issue with svgs in CSS url()'s throwing url.replace error
let rules = defaultConfig.module.rules;
for ( let i in rules ) {
	if (
		rules[ i ].test.toString().includes( '.svg' ) &&
		( ! rules[ i ].issuer ||
			! rules[ i ].issuer.toString().includes( 'jsx' ) )
	) {
		rules[ i ].issuer = /\.jsx?$/;
	}
	// Don't inline svg
	if (
		rules[ i ].test.toString().includes( '.svg' ) &&
		rules[ i ].type == 'asset/inline'
	) {
		rules[ i ] = {};
	}
}
// Refer svgs to build path
rules.push(
	{
		test: /\.svg$/,
		issuer: /\.(sc|sa|c)ss$/,
		type: 'asset/resource',
		generator: {
			filename: 'images/[name].[hash:8][ext]',
		},
	},
	// allow importing css as strings
	{
		resourceQuery: /raw/,
		type: 'asset/source',
	}
);
rules.map( ( rule ) => {
	if ( rule?.test?.toString()?.includes( 'css' ) ) {
		rule.resourceQuery = { not: [ /raw/ ] };
	}
} );
defaultConfig.module.rules = rules;

module.exports = {
	...defaultConfig,
	entry: {
		default_variables: path.resolve(
			process.cwd(),
			'src',
			'default_variables.scss'
		),
		//global: path.resolve(process.cwd(), 'src', 'global.js'),
		backend: path.resolve( process.cwd(), 'src', 'backend.js' ),
		frontend: path.resolve( process.cwd(), 'src', 'frontend.js' ),
	},
};
