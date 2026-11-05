import './menu.js';

class General {
	constructor() {
		this.testVariable = 'script working';
		this.init();
	}

	init() {
		// for tests purposes only
		console.log(this.testVariable);
	}
}

document.addEventListener('DOMContentLoaded', () => {
	new General();
});
