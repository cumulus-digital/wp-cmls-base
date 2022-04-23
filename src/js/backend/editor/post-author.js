/**
 * Injects an alt display author field near the post author in gutenberg
 */
(() => {
	// Only operate in the editor
	if (!window?.wp?.blocks) {
		return;
	}

	const { registerPlugin } = wp.plugins;
	const { PluginPostStatusInfo } = wp.editPost;
	const { TextControl } = wp.components;
	const { useSelect, useDispatch } = wp.data;
	const { useCallback } = wp.element;

	const PluginPostStatusInfoTest = () => {
		const { postType } = useSelect((select) => {
			return { postType: select('core/editor').getCurrentPostType() };
		});
		if (postType === 'post') {
			const { acfMeta } = useSelect((select) => {
				return {
					acfMeta:
						select('core/editor').getEditedPostAttribute('acf'),
				};
			}, []);
			const { editPost } = useDispatch('core/editor', [
				acfMeta['cmls-alt_author'],
			]);
			const onChange = useCallback(
				wp.compose.useDebounce((val) => {
					// I think ACF's own metabox overwrites, so we'll do this there and in dispatch
					const field = document.getElementById(
						'acf-field_613a67efc94aa'
					);
					if (field) {
						field.value = val;
					}
					editPost({ acf: { 'cmls-alt_author': val } });
					wp.data.dispatch('core/editor').savePost();
				}, 600),
				[acfMeta['cmls-alt_author']]
			);

			return (
				<PluginPostStatusInfo>
					<TextControl
						label="Alt. Author Display Name"
						help="Set an alternate name for the author of this post to display publicaly instead of the real author, e.g. for guest blogs."
						value={acfMeta['cmls-alt_author']}
						onChange={onChange}
					/>
				</PluginPostStatusInfo>
			);
		} else {
			return null;
		}
	};

	registerPlugin('post-status-info-test', {
		render: PluginPostStatusInfoTest,
	});
})();
