/* PRIVATE */
(() => {
	// Open modal Team
	// #function #server
	let open_team_modal = () => {

		/* -- GET DATA FROM SERVER -- */

		document.querySelectorAll('.modal, .modal_team').forEach(element => element.classList.add('modal_show'));
	}

	// Add event 'click' for dynamic elements
	document.body.addEventListener('click', event => {
		// For dynamic
		// #event #function
		if (event.target && event.target.classList.contains('dynamic_class')) {}
	});

	// Open modal Team
	// #event
	document.querySelectorAll('.team_open_modal.view').forEach(element => element.addEventListener('click', open_team_modal));
})();