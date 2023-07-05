/**
 * Injects an alt display author field near the post author in gutenberg
 */
( () => {
	const acfFieldId = 'field_613a67efc94aa';

	// Only operate in the editor
	if (
		! window?.wp?.blocks ||
		! window.acf ||
		! window?.acf?.getField( acfFieldId )
	) {
		return;
	}

	const { registerPlugin } = wp.plugins;
	const { PluginPostStatusInfo } = wp.editPost;
	const { TextControl } = wp.components;
	const { useSelect, useDispatch } = wp.data;
	const { useCallback, useState } = wp.element;
	const { debounce } = wp.compose;

	const altAuthorField = () => {
		const { postType } = useSelect( ( select ) => {
			return { postType: select( 'core/editor' ).getCurrentPostType() };
		} );

		// Only operate on posts
		if ( postType !== 'post' ) {
			return null;
		}

		// Fetch the initial value from ACF data
		const [ altAuthor, setAltAuthor ] = useState(
			useSelect( ( select ) => {
				const acfMeta =
					select( 'core/editor' ).getEditedPostAttribute( 'acf' );
				return acfMeta[ 'cmls-alt_author' ];
			} )
		);
		const [ updatingACF, setUpdatingACF ] = useState( false );

		const { editPost } = useDispatch( 'core/editor', [ altAuthor ] );

		// Update the ACF field and trigger an editPost
		// so the editor knows we've changed data
		const updateAltAuthor = debounce(
			( val ) => {
				setAltAuthor( val );
				if ( window.acf ) {
					const field = window.acf.getField( acfFieldId );
					if ( field.val() !== val ) {
						setUpdatingACF( true );
						field.val( val );
					}
				}
				setUpdatingACF( false );
				editPost( { acf: { 'cmls-alt_author': val } } );
			},
			150,
			{ trailing: true }
		);

		const onChange = useCallback( updateAltAuthor, [ altAuthor ] );

		// Watch the original ACF field for changes and reflect it in our state
		if ( window.acf ) {
			const acf = window.acf;
			const acfField = acf.getField( acfFieldId );
			if ( acfField && ! acfField.get( 'watching_alt_author' ) ) {
				[ 'change', 'keyup' ].forEach( ( ev ) => {
					acfField.on(
						ev,
						debounce(
							() => {
								if (
									updatingACF ||
									acfField.val() === altAuthor
								) {
									return;
								}
								updateAltAuthor( acfField.val() );
							},
							150,
							{ trailing: true }
						)
					);
				} );
				acfField.set( 'watching_alt_author', true );
			}
		}

		return (
			<PluginPostStatusInfo>
				<TextControl
					label="Alt. Author Display Name"
					help="Set an alternate name for the author of this post to display publicaly instead of the real author, e.g. for guest blogs."
					value={ altAuthor }
					onChange={ onChange }
				/>
			</PluginPostStatusInfo>
		);
	};

	if ( window.acf && window.acf.getField( acfFieldId ) ) {
		const field = window.acf.getField( acfFieldId );
		if ( ! field.get( 'alt_author_registered' ) ) {
			registerPlugin( 'post-status-info-test', {
				render: altAuthorField,
			} );
			field.set( 'alt_author_registered', true );
		}
	}
} )();
