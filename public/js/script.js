/* PUBLIC */

// Close all modals. 
// #function
let modalClose = () => {
	document.querySelectorAll('.modal, .modal_win').forEach(element => element.classList.remove('modal_show'));
	document.body.classList.remove('stop_scrolling');
	document.querySelectorAll('video').forEach(element => element.pause());
}

// Open modal 
// #function
let modalOpen = (modal_selector) => {
	document.querySelectorAll('.modal, ' + modal_selector).forEach(element => element.classList.add('modal_show'));
	document.body.classList.add('stop_scrolling');

}

// Set Cookie by name and live-days 
// #function
let setCookie = (name, days) => {
	let date = new Date;
	date.setDate(date.getDate() + days);
	document.cookie = name + "=no; path=/; expires=" + date.toUTCString();
	document.cookie.remove
};

// Get Cookie by name
// #function
let getCookie = (name) => {
	let matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));
	return matches ? decodeURIComponent(matches[1]) : undefined;
};

// Copy text to clipboard
// #function
let copyText = (text) => {
	if (text === null) return false;
	let input = document.createElement('input');
	input.value = text;
	input.focus();
	input.select();
	input.setSelectionRange(0, 99999);
	navigator.clipboard.writeText(input.value);
};

// Preview input images with sytle background
// #var #function
let freader_preview = new FileReader();
let preview_input_img = (file, preview_func) => {
	freader_preview.onload = preview_func;
	freader_preview.readAsDataURL(file);
};

/* PRIVATE */
(() => {
	// Open/Close main-navigation. 
	// #event
	document.querySelectorAll('.nav_button').forEach(element => element.addEventListener('click', () => document.body.classList.toggle('nav_button_active')));

	// Toggle head-navigation with scroll
	// #event #function
	let last_scroll = 0;
	window.addEventListener('scroll', () => {
		var scrolled = window.scrollY;
		if (scrolled > 100 && scrolled > last_scroll) {
			document.querySelector('header').classList.add('scroll_down');
		} else {
			document.querySelector('header').classList.remove('scroll_down');
		}
		last_scroll = scrolled;
	});

	// Close (button, click without win). 
	// #function
	document.querySelectorAll('.modal .close').forEach(element => element.addEventListener('click', () => modalClose()));
	document.querySelectorAll('.modal').forEach(element => element.addEventListener('click', event => {
		if (event.target.closest('*').closest('.modal_win') === null) modalClose();
	}));

	// Show video with modal. 
	// #event #function
	document.querySelectorAll('.video_open_modal').forEach(element => element.addEventListener('click', event => {
		let modal_video = document.querySelector('.modal_win.modal_view_video');
		modal_video.querySelector('video source').setAttribute('src', event.target.closest('.video_open_modal').getAttribute('data-videoSrc') + '');
		modal_video.querySelector('video').load();
		modalOpen('.modal_view_video');
	}));

	// FAQ item Open/hide. 
	// #event
	document.querySelectorAll('.faq_li').forEach(element => element.addEventListener('click', () => element.classList.toggle('active')));

	// Check Cookie and Show/Hide message
	// #code
	if (getCookie("cookie_mess") != "no") {
		let cookiewin = document.querySelector('.cookie_message');
		if (cookiewin === null) return false;
		cookiewin.classList.add('mess_show');

		// Close message about Cookie
		// #event #function
		document.querySelector(".cookie_success").addEventListener("click", () => {
			cookiewin.classList.remove('mess_show');
			setCookie('cookie_mess', 30);
		});
	}

	// Copy text
	// #event
	document.querySelectorAll('.button_copy').forEach(element => element.closest('.button_copy').addEventListener('click', () => copyText(element.getAttribute('data-textCopy'))));

	// Toggle modal-win SignIn <-> SignUp
	// #event #function
	document.querySelectorAll('.modal_sign_account .step_toggle').forEach(element => element.addEventListener('click', () => {
		document.querySelector('.modal_sign_account').classList.toggle('signin_step');
		document.querySelector('.modal_sign_account').classList.toggle('signup_step');
	}));

	// Open modal SignIn-SignUp
	// #event #function
	document.querySelectorAll('.open_sign_modal').forEach(element => element.addEventListener('click', () => {
		document.querySelector('.modal_sign_account').classList.replace('signin_step', 'signup_step');
		modalOpen('.modal_sign_account');
	}));
})();
