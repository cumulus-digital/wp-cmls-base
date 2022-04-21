/**
 * Add a post type select to multiple core blocks
 */
const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { Panel, PanelBody, SelectControl } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { useSelect } = wp.data;

// Enable post type selector on these blocks
const enableTaxTypeSelector = ['core/post-terms'];

const withTaxTypeSelector = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { attributes, setAttributes, context, isSelected } = props;
		// Do nothing if it's another block than our defined ones.
		if (!enableTaxTypeSelector.includes(props.name)) {
			return <BlockEdit {...props} />;
		}
		//const [availableTerms, setAvailableTerms] = useState([]);

		const { availableTerms } = useSelect((select) => {
			const postType = select('core/editor').getCurrentPostType();
			const terms = select('core').getTaxonomies({
				type: postType,
				context: 'view',
				per_page: -1,
			});
			if (terms && terms.length) {
				let hasTerm = false;
				const newTerms = terms.map((term) => {
					if (term.slug === attributes.term) {
						hasTerm = true;
					}
					return {
						label: term.name,
						value: term.slug,
					};
				});
				if (!hasTerm) {
					setAttributes({ term: newTerms[0].value });
				}
				return { availableTerms: newTerms };
			}
			return {
				availableTerms: [{ label: 'No terms available.' }],
			};
		});

		return (
			<>
				<BlockEdit {...props} />
				{isSelected && (
					<InspectorControls>
						<Panel>
							<PanelBody title="Taxonomy">
								<SelectControl
									label="Taxonomy Type"
									value={attributes.term}
									options={availableTerms}
									onChange={(val) =>
										setAttributes({ term: val })
									}
									help="Only taxonomies associated with the current post type are available."
								/>
							</PanelBody>
						</Panel>
					</InspectorControls>
				)}
			</>
		);
	};
}, 'withTaxTypeSelector');

addFilter(
	'editor.BlockEdit',
	'cmls/block-extentions/post-types',
	withTaxTypeSelector
);
