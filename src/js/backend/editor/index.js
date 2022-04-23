require('./post-author.js');
require('./acf-title.js');

(() => {
	// Only operate in the editor
	if (!window?.wp?.blocks) {
		return;
	}

	// Determine if we're in the main window or gutenberg's mobile iframe is active
	function getContext(BOTH) {
		const iframe = document.querySelector('iframe[name="editor-canvas"]');
		const iframeContent =
			iframe.contentDocument || iframe.contentWindow.document;
		if (iframeContent && iframeCoontent.body) {
			return iframeContent.bodu;
		}
		return document.body;
	}

	// Hide the sticky option, force it false
	const styles = document.createElement('style');
	styles.innerHTML = '#sticky-span { display: none !important; }';
	document.body.appendChild(styles);
	let isSticky = null;
	const { select, subscribe } = wp.data;
	const waitForEditor = subscribe(() => {
		if (!select('core/editor').__unstableIsEditorReady()) {
			return;
		}
		isSticky = select('core/editor').getEditedPostAttribute('sticky');
		if (isSticky === undefined || isSticky === null) {
			return;
		}
		const stickyControl = Array.from(
			document.querySelectorAll(
				'.edit-post-post-status .components-panel__row'
			)
		).find((el) => el.innerText === 'Stick to the top of the blog');
		if (!stickyControl) {
			return;
		}
		waitForEditor();
		stickyControl.style.display = 'none';
		if (isSticky) {
			wp.data.dispatch('core/editor').editPost({ sticky: false });
		}
	});
})();
