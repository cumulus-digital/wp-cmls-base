/**
 * Add a post type select to multiple core blocks
 */
const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { Panel, PanelBody, SelectControl } = wp.components;
const { InspectorControls } = wp.blockEditor;
const { useSelect } = wp.data;
const { useState, useEffect } = wp.element;

// Enable post type selector on these blocks
const enableTaxTypeSelector = ['core/post-terms'];

const withTaxTypeSelector = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		// Do nothing if it's another block than our defined ones.
		if (!enableTaxTypeSelector.includes(props.name)) {
			return <BlockEdit {...props} />;
		}

		const { attributes, setAttributes, isSelected } = props;

		/*
		useEffect(() => {
			if (!attributes.postType) {
				setAttributes({
					postType: wp.data
						.select('core/editor')
						.getCurrentPostType(),
				});
			}
		});
		*/

		// Fill our taxonomies
		const { availableTaxonomies } = useSelect((select) => {
			const query = {
				type:
					attributes?.postType ||
					select('core/editor').getCurrentPostType(),
				context: 'view',
				per_page: -1,
			};
			const rawTaxes = select('core').getTaxonomies(query);
			if (
				select('core/data').isResolving('core', 'getTaxonomies', query)
			) {
				return { availableTaxonomies: [{ label: 'Loading...' }] };
			}
			if (rawTaxes && rawTaxes.length) {
				let hasTax = false;
				const newTaxes = rawTaxes
					.filter((tax) => tax.visibility.show_ui)
					.map((tax) => {
						if (tax.slug === attributes.term) {
							hasTax = true;
						}
						return {
							label: tax.name,
							value: tax.slug,
						};
					});
				if (!hasTax) {
					setAttributes({ term: newTaxes[0].value });
				}
				return { availableTaxonomies: newTaxes };
			}
			return { availableTaxonomies: [{ label: 'None found.' }] };
		}, []);

		/**
		 * One day maybe this block will support changing post type...
		 */
		/*
		const { availablePostTypes } = useSelect((select) => {
			const types = select('core').getPostTypes();
			if (types && types.length) {
				const postTypes = types.filter((pt) => pt.viewable);
				if (postTypes && postTypes.length) {
					let hasType = false;
					const postTypeOptions = postTypes.map((pt) => {
						if (attributes.postType === pt.slug) {
							hasType = true;
						}
						return {
							label: pt.name,
							value: pt.slug,
						};
					});
					return {
						availablePostTypes: postTypeOptions,
					};
				}
			}
			return {
				availablePostTypes: [{ label: 'None available.' }],
			};
		}, []);
		*/

		return (
			<>
				{isSelected && (
					<InspectorControls>
						<Panel>
							<PanelBody title="Taxonomy" initialOpen={false}>
								<SelectControl
									label="Taxonomy Type"
									value={attributes.term}
									options={availableTaxonomies}
									onChange={(val) =>
										setAttributes({ term: val })
									}
									help="Only taxonomies associated with the current post type are available."
								/>
							</PanelBody>
						</Panel>
					</InspectorControls>
				)}
				<BlockEdit {...props} />
			</>
		);
	};
}, 'withTaxTypeSelector');

addFilter(
	'editor.BlockEdit',
	'cmls/block-extentions/post-types',
	withTaxTypeSelector
);
