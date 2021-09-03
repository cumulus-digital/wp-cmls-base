/**
* Add a post type select to multiple core blocks
*/
const { addFilter } = wp.hooks;
const { createHigherOrderComponent, compose } = wp.compose;
const { PanelBody, TextControl } = wp.components;
const { InspectorAdvancedControls } = wp.blockEditor;
const { withSelect, useSelect } = wp.data;

// Enable post type selector on these blocks
const enableTaxTypeSelector = [
	'core/post-terms',
];

const withTaxTypeSelector = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const {
			attributes,
			setAttributes,
			isSelected
		} = props;
		// Do nothing if it's another block than our defined ones.
		if (!enableTaxTypeSelector.includes(props.name)) {
			return (
				<BlockEdit {...props} />
			);
		}
		const { term } = attributes;

		return (
			<>
				<BlockEdit {...props} />
				{(isSelected &&
					<InspectorAdvancedControls>
						<TextControl
							label="Term Type"
							value={term}
							onChange={(t) => setAttributes({ term: t })}
							help={
								<>
									<strong>Value must be the <em>internal slug</em> of the term.</strong>
									Allows selecting term types other than the built-in tags and categories."
								</>
							}
						/>
					</InspectorAdvancedControls>
				)}
			</>
		);
	};
}, 'withTaxTypeSelector');

addFilter( 'editor.BlockEdit', 'cmls/block-extentions/post-types', withTaxTypeSelector );
