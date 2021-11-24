/* PRIVATE */
(() => {

	// Add event 'click' for dynamic elements
	document.body.addEventListener('click', event => {
		// For dynamic
		// #event #function
		if (event.target && event.target.classList.contains('dynamic_class')) { }
	});

	// Open modal Team
	// #event #function #server
	document.querySelectorAll('.team_open_modal.view').forEach(element => element.addEventListener('click', () => {

		/* -- GET DATA FROM SERVER -- */

		modalOpen('.modal_team');
	}));
})();