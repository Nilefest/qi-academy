/* DEMO code */
// requestWithFetch('post', '/auth/check', [], (data) => console.log(data)); // Ayth check

/* PUBLIC */

// Validate Email
// #function
let validateEmail = (email) => {
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

// Close all modals. 
// #function
let modalClose = () => {
    document.querySelectorAll('.modal, .modal_win').forEach(element => element.classList.remove('modal_show'));
    document.body.classList.remove('stop_scrolling');

    // Stop all videos
    document.querySelectorAll('.modal_win video').forEach(element => element.pause());
    document.querySelectorAll('iframe.youtube_video').forEach(element => {
        element.setAttribute('src', '#youtube');
    });
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

// Create new Request with crossbrowser
// #function #ajax
let createRequest = () => {
    var Request = false;

    if (window.XMLHttpRequest) {
        //Gecko-совместимые браузеры, Safari, Konqueror
        Request = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        //Internet explorer
        try {
            Request = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (CatchException) {
            Request = new ActiveXObject("Msxml2.XMLHTTP");
        }
    }
    if (!Request) console.log("Can`t create object XMLHttpRequest");

    return Request;
}

// Make Request to Server
// #function #ajax
let makeRequest = (method, url, args_data, handler_success, handler_fail, handler_loading) => {

    let body_data = new FormData();
    let args_str = "";
    Object.keys(args_data).forEach(key => {
        body_data.append(key, args_data[key]);
        args_str += key + '=' + encodeURIComponent(args_data[key]) + '&';
    });

    let Request = createRequest();
    if (!Request) return Request;

    // Add event
    Request.onreadystatechange = () => {
        if (Request.readyState === 4) {
            if (typeof handler_success !== 'undefined' && Request.status === 200) handler_success(Request.response, Request);
            else if (typeof handler_fail !== 'undefined') handler_fail(Request.response, Request);
        } else {
            if (typeof handler_loading !== 'undefined' && handler_loading !== null) handler_loading();
        }
    }

    // Check for Get-request
    if (method.toLowerCase() === "get" && args_str.length > 0)
        url += "?" + args_str;

    //Init connect
    Request.open(method, url, true);
    if (method.toLowerCase() === "post") {
        if (document.querySelector('meta[name="csrf-token"]') !== null)
            Request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        Request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=utf-8");
        Request.send(body_data);
    } else Request.send(null);

    return Request;
}


// Make Request to Server with Fetch
// #function #fetch
let requestWithFetch = (method, url, args_data, handler_success, handler_fail) => {
    let body_data = new FormData();
    Object.keys(args_data).forEach(key => body_data.append(key, args_data[key]));

    fetch(url, {
        headers: {
            // "Content-Type": "application/json",
            // "Content-Type": "multipart/form-data; boundary=—-WebKitFormBoundaryfgtsKTYLsT7PNUVD",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        method: method,
        credentials: "same-origin",
        body: body_data
    }).then((response) => {
        if (response.ok) {
            response.text().then((data) => {
                // console.log(data);
                try { data = JSON.parse(data); } catch (e) {}
                if (typeof handler_success !== 'undefined' && handler_success !== null) handler_success(data);
            });
        } else {
            if (response.status === 500) response.text().then(data => console.log(JSON.parse(data)))
            if (typeof handler_fail !== 'undefined' && handler_fail !== null) handler_fail(error);
            return response.json();
        }
    }).catch(function(error) {
        //if (typeof handler_fail !== 'undefined' && handler_fail !== null) handler_fail(error);
        if (typeof error !== 'undefined' && error !== null) console.log(error);
    });
};

// View short info with modal
// #function
let view_modal_simple_info = (message) => {
    document.querySelector('.modal_simple_info .message').innerHTML = message;
    modalOpen('.modal_simple_info');
}

// Default function for ansver after AJAX for Success, Fail
// #function
let func_default_success = (data) => {
    view_modal_simple_info('Success!');
    console.log(data);
};
let func_default_fail = () => view_modal_simple_info('Something went wrong...<br>Try again later or contact your administrator ');

/* PRIVATE */
(() => {
    // Disable select text/..., context menu
    // #function #EVIL
    function noselect() {
        if (window.getSelection) window.getSelection().removeAllRanges();
        else document.selection.empty();
        return false;
    }
    // #event #EVIL
    document.ondragstart = noselect;
    document.onselectstart = noselect;
    document.oncontextmenu = noselect;

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
        if (cookiewin !== null) {
            cookiewin.classList.add('mess_show');

            // Close message about Cookie
            // #event #function
            document.querySelector(".cookie_success").addEventListener("click", () => {
                cookiewin.classList.remove('mess_show');
                setCookie('cookie_mess', 30);
            });
        }
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
    document.querySelectorAll('.open_sign_modal').forEach(element => element.addEventListener('click', event => {
        let button = event.target;
        document.querySelectorAll('.modal_sign_account .login_button.social').forEach(element => {
            let href = element.getAttribute('data-href');
            if (button.classList.contains('redirect_auth')) {
                href += '?target_url=' + button.getAttribute('data-href');
            }
            element.setAttribute('href', href);
        });
        document.querySelector('.modal_sign_account').classList.replace('signin_step', 'signup_step');
        modalOpen('.modal_sign_account');
    }));

    // View image fullscreen
    // #function
    let openFullImage = (event) => {
        let img_url = event.target.getAttribute('data-fullImg');
        document.querySelector('.modal_view_fullimg .full_image').setAttribute('src', img_url);
        modalOpen('.modal_view_fullimg');
    }

    // View image fullscreen
    // #event
    document.querySelectorAll('.view_full_img').forEach(element => element.addEventListener('click', openFullImage));

    // Subscribe
    // #function #server
    let subscribe_new = (event) => {
        let sub_mail = event.target.closest('.subscribe_field').querySelector('.subscribe_email').value;
        if (validateEmail(sub_mail)) {
            requestWithFetch('post', '/subscribe/add', { email: sub_mail }, (data) => console.log(data));

            document.querySelector('.modal_simple_info .message').innerHTML = 'Dziękujemy za subskrypcję!';
            modalOpen('.modal_simple_info');
            document.getElementById('subscribe_email').value = '';
        } else {
            document.querySelector('.modal_simple_info .message').innerHTML = 'Nieprawidłowy format wiadomości e-mail!';
            modalOpen('.modal_simple_info');
        }
    }

    // Subscribe
    // #event
    document.querySelectorAll('.subscribe_button').forEach(element => element.addEventListener('click', subscribe_new));

})();