/* PRIVATE */
(() => {

    // Finish this lecture
    // #function #server
    let finish_lecture = () => {
        document.querySelectorAll('.lesson_list_li.active .icon').forEach(element => {
            element.classList.replace('fa-circle', 'fa-check-circle')
        });

        let lecture_one = document.querySelector('.lecture_one');

        /* -- POST DATA TO SERVER --  */
        let url = lecture_one.getAttribute('data-formAction');
        let lecture_data = {
            type: 'lecture_finish',
            lecture_id: lecture_one.getAttribute('data-lectureId'),
            user_id: lecture_one.getAttribute('data-userId')
        };
        let func_success = (data) => {
            let last = data['data']['last'];
            let current_completed = data['data']['current_completed'];

            console.log(data);

            // Finish full course
            document.querySelectorAll('.finished_lesson_block .current').forEach(element => element.innerHTML = current_completed);
            document.querySelectorAll('.finished_lesson_block').forEach(element => element.classList.add('finished'));
            if (last * 1 === 0) {
                document.querySelectorAll('.finished_lesson_block').forEach(element => element.classList.remove('unfinished'));
            }
        };
        requestWithFetch('post', url, lecture_data, func_success, func_default_fail);
    };

    // Finish lecture
    // #event
    document.querySelectorAll('.finish_lesson').forEach(element => element.closest('.finish_lesson').addEventListener('click', finish_lecture));

    // Get sertificate
    // #event #function
    document.querySelectorAll('.get_sertificate').forEach(element => element.closest('.get_sertificate').addEventListener('click', () => modalOpen('.modal_get_sertificate')));

    // Open modal for send review
    // #event #function
    document.querySelectorAll('.open_send_review').forEach(element => element.closest('.open_send_review').addEventListener('click', () => {
        document.querySelector('.modal_send_review').classList.remove('step_success');
        modalOpen('.modal_send_review');
    }));

    // Send review
    // #event #function #server
    document.querySelector('.send_review').addEventListener('click', () => {
        let modal = document.querySelector('.modal_send_review');
        let url = modal.querySelector('.form').getAttribute('data-formAction');
        let data = {
            send_review: 1,
            review_text: modal.querySelector('.review_text').value
        }
        if (modal.querySelector('.upload_video_review').files[0] !== null) {
            $file = document.querySelector('.upload_video_review').files[0];
            // Max filesize 25MB
            if ($file['size'] <= 25 * 1024 * 1024) {
                data['video_review'] = $file;
            } else {
                modalClose();
                view_modal_simple_info('Plik jest za duży!');
                return;
            }
        }

        let func_success = (data) => {
            console.log(data);

            document.querySelector('.modal_send_review').classList.add('step_success');
        }

        requestWithFetch('post', url, data, func_success, func_default_fail);
    });

    // Open lecures list
    // #event #function
    if (document.querySelector('.lesson_list').classList.contains('mobile_toggle_list')) {
        document.querySelector('.lesson_list .icon_open').parentElement.addEventListener('click', () => {
            document.querySelector('.lesson_list').classList.toggle('open_list');
        });
    }

    // Click to body
    // #event #function
    document.body.addEventListener('click', (event) => {

        // Close lesson`s list_menu for mobile of click overflow list_menu
        // #event #function
        if (event.target !== document.getElementById('list_menu_check') && event.target.closest('.list_menu_button') === null) {
            document.querySelector('.list_menu_check').checked = false;
        }
    });
})();