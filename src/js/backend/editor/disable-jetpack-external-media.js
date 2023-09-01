import { subscribe } from '@wordpress/data';

import { dispatch, select } from '@wordpress/data';
export const waitFor = async ( selector ) =>
	new Promise( ( resolve ) => {
		const unsubscribe = subscribe( () => {
			if ( selector() ) {
				unsubscribe();
				resolve();
			}
		} );
	} );
const isInserterOpened = () =>
	select( 'core/edit-post' )?.isInserterOpened() ||
	select( 'core/edit-site' )?.isInserterOpened() ||
	select( 'core/edit-widgets' )?.isInserterOpened?.();

const registerInInserter = ( mediaCategoryProvider ) =>
	dispatch( 'core/block-editor' )?.registerInserterMediaCategory?.(
		mediaCategoryProvider()
	);

document.addEventListener( 'DOMContentLoaded', () => {
	waitFor( isInserterOpened ).then( () => {
		registerInInserter( {
			name: 'google_photos',
		} );
		registerInInserter( {
			name: 'pexels_id',
		} );
	} );
} );
