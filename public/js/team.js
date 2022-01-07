/* PRIVATE */
(() => {

	// Add event 'click' for dynamic elements
	document.body.addEventListener('click', event => {
		// For dynamic
		// #event #function
		if (event.target && event.target.classList.contains('dynamic_class')) { }
	});

	// Open modal Team
<<<<<<< HEAD
	// #event #function #server
	document.querySelectorAll('.team_open_modal.view').forEach(element => element.addEventListener('click', () => {

		/* -- GET DATA FROM SERVER -- */
=======
	// #event #function
	document.querySelectorAll('.team_open_modal.view').forEach(element => element.addEventListener('click', (event) => {
		let modal = document.querySelector('.modal_team');
		let team_one = event.target.closest('.team_one');

		modal.querySelector('.img').setAttribute('src', team_one.getAttribute('data-teamImg'));
		modal.querySelector('.info p').innerHTML = team_one.getAttribute('data-teamInfo');
		modal.querySelector('.name').innerHTML = team_one.querySelector('.name').innerHTML;
		let facebook = team_one.querySelector('.facebook_link');
		if (facebook !== null) {
			modal.querySelector('.facebook_link').parentNode.classList.remove('d-none');
			modal.querySelector('.facebook_link').setAttribute('href', facebook);
		} else modal.querySelector('.facebook_link').parentNode.classList.add('d-none');
		let instagram = team_one.querySelector('.instagram_link');
		if (instagram !== null) {
			modal.querySelector('.instagram_link').parentNode.classList.remove('d-none');
			modal.querySelector('.instagram_link').setAttribute('href', instagram);
		} else modal.querySelector('.instagram_link').parentNode.classList.add('d-none');
>>>>>>> dev

		modalOpen('.modal_team');
	}));
})();