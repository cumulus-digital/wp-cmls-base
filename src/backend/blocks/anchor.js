// Simple empty block to allow anchors
(function () {
	const { registerBlockType } = wp.blocks;
	const blockStyle = {
		backgroundColor: '#DDD',
		borderRadius: '3px',
		boxShadow: '0 1px 2px RGBA(0,0,0,0.3)',
		color: '#888',
		padding: '8px',
		textAlign: 'center',
		fontWeight: 300,
	};
	registerBlockType('cumulus-gutenberg/anchor', {
		title: 'Anchor',
		icon: {
			src: 'admin-links',
			foreground: '#3399cc',
		},
		category: 'layout',
		supports: { anchor: true },
		edit: (props) => {
			const { anchor } = props.attributes;
			return (
				<div style={blockStyle} title="Anchor">
					&#128279;&#xFE0E;
					{anchor && <em>{anchor}</em>}
				</div>
			);
		},
		save: () => {
			return <div class="cmls-anchor"></div>;
		},
	});
})();
