class ExtraScrollMargin {
	margins = {};
	setMargin() {
		const newMargins = [...Object.values(this.margins)];
		if (newMargins.length) {
			window.document.documentElement.style.setProperty(
				'--cmls_base-extra-scroll-margin-top', `calc(${newMargins.join(' + ')})`
			)
		} else {
			window.document.documentElement.style.removeProperty(
				'--cmls_base-extra-scroll-margin-top'
			)
		}
	}
	add(uid, addition) {
		this.margins[uid] = addition;
		this.setMargin();
	}
	remove(uid) {
		delete this.margins[uid];
		this.setMargin();
	}
}
window.cmlsExtraScrollMargin = new ExtraScrollMargin();