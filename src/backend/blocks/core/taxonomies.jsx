/**
* Add a post type select to multiple core blocks
*/
const { addFilter } = wp.hooks;
const { createHigherOrderComponent, compose } = wp.compose;
const { PanelBody, SelectControl, Spinner } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { withSelect } = wp.data;

// Enable post type selector on these blocks
const enableTaxTypeSelector = [
	'core/post-terms',
];

const withTaxTypeSelector = createHigherOrderComponent( ( BlockEdit ) => {
	return (props) => {
		// Do nothing if it's another block than our defined ones.
		if (!enableTaxTypeSelector.includes(props.name)) {
			return (
				<BlockEdit {...props} />
			);
		}
		const {
			attributes,
			setAttributes,
			isSelected
		} = props;
		const { term } = attributes;

		const RenderSelect = ({ terms }) => {
			if (!terms) {
				return <Spinner />;
			}

			const options = terms.map((term) => {
				return { label: term.name, value: term.slug };
			});
			options.unshift({ label: '--' });

			return (
				<SelectControl
					label="Terms"
					value={term}
					options={options}
					onChange={(val) => setAttributes({ term: val })}
				/>
			);
		};
		const TermsSelect = compose(
			withSelect((select) => {
				const { getEntityRecord, getEntityRecords } = select('core');
				const post_type = select('core/editor').getCurrentPostType();
				return {
					terms: select('core').getTaxonomies({ 'type': post_type })
				};
			})
		)(RenderSelect);

		return (
			<>
				<BlockEdit {...props} />
				{(isSelected &&
					<InspectorControls>
						<PanelBody
							title="Choose Terms Type"
							initialOpen={true}
						>
							<TermsSelect/>
						</PanelBody>
					</InspectorControls>
				)}
			</>
		);
	};
}, 'withTaxTypeSelector');

addFilter( 'editor.BlockEdit', 'cmls/block-extentions/post-types', withTaxTypeSelector );
