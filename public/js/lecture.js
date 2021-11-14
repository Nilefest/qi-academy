/* PRIVATE */
(() => {

	// Finish this lecture
	// #function #server
	let finish_lecture = () => {
		document.querySelectorAll('.lesson_list_li.active .icon').forEach(element => {
			element.classList.replace('fa-circle', 'fa-check-circle')
		});

		/* -- POST DATA TO SERVER --  */

		// Finish full course
		document.querySelectorAll('.finished_lesson_block').forEach(element => element.classList.add('finished'));
		document.querySelectorAll('.finished_lesson_block').forEach(element => element.classList.remove('unfinished'));
	};

	// Finish lecture
	// #event
	document.querySelectorAll('.finish_lesson').forEach(element => element.closest('.finish_lesson').addEventListener('click', finish_lecture));

	// Get sertificate
	// #event #function
	document.querySelectorAll('.get_sertificate').forEach(element => element.closest('.get_sertificate').addEventListener('click', () => modalOpen('.modal_get_sertificate')));

	// Open modal for send review
	// #event #function
	document.querySelectorAll('.send_review').forEach(element => element.closest('.send_review').addEventListener('click', () => {
		document.querySelector('.modal_send_review').classList.remove('step_success');
		modalOpen('.modal_send_review');
	}));

	// Send review
	// #event #function #server
	document.querySelector('.send_review').addEventListener('click', () => {
		/* -- POST DATA TO SERVER -- */

		document.querySelector('.modal_send_review').classList.add('step_success');
	});

	// Open lecures list
	// #event #function
	document.querySelector('.lesson_list .icon_open').parentElement.addEventListener('click', () => {
		document.querySelector('.lesson_list').classList.toggle('open_list');
	});

})();