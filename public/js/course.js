/* PRIVATE */
(() => {
	// Program-Llist item Open/hide
	// #event #function
	document.querySelectorAll('.program_list_li').forEach(element => element.addEventListener('click', () => element.classList.toggle('active')));
})()
