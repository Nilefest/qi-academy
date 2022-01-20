/* PRIVATE */
(() => {
    // Banner-video. Play/pause. 
    // #event #function
    document.querySelector('.main_banner_media video').addEventListener('click', event => {
        let video_element = event.target;
        if (video_element.paused) {
            video_element.muted = false;
            video_element.currentTime = 0;
            return video_element.play();
        }
        //video_element.pause();
    });

    // Full-video. Play
    // #event #function
    document.querySelectorAll('.block_full_video_button').forEach(element => element.addEventListener('click', event => {
        let video_container = event.target.closest('.block_full_video');
        let video_element = video_container.querySelector('video');

        setTimeout(function() {
            if (video_element.paused || video_element.muted) {
                if (video_element.muted) {
                    video_element.muted = false;
                    video_element.currentTime = 0;
                }
                video_element.play();
                video_container.classList.add('video_play');
                video_container.addEventListener('click', event => full_video_play_toggle(event));
            } else {
                video_element.pause();
                video_container.classList.remove('video_play');
            }
        }, 0);
    }));

    // Full-video. Pause
    // #function-event
    function full_video_play_toggle(event) {
        let video_container = event.target.closest('.block_full_video.video_play');
        if (video_container === null) return false;
        let video_element = video_container.querySelector('video');

        setTimeout(() => {
            if (!video_element.paused) {
                video_element.pause();
                video_container.classList.remove('video_play');
            }
        }, 0);
    }

    // Education-info Open/hide
    // #event #function
    document.querySelectorAll('.block_educations_li').forEach(element => element.addEventListener('click', () => element.classList.toggle('active')));

    // Cursers. Get and add more items
    // #event #function  #server
    document.querySelectorAll('.cursers_more').forEach(element => element.addEventListener('click', event => {
        let cursers_list = document.querySelector('.cursers_list_ul');

        // Append demo items
        for (let n_type = 1; n_type <= 4; n_type++) {
            let curs_item = document.querySelector('.tpl_cursers_item.type_' + n_type).content.cloneNode(true);
            cursers_list.append(curs_item);
        }
    }));

    // Booking to offline courses
    // #event #function #server
    document.querySelector('.book_success').addEventListener('click', event => {
        /* --- POST DATA TO SERVER --- */

        document.querySelector('.modal_book_offline').classList.add('success_step');
    });

    // Offline courses
    // #event #function
    document.querySelectorAll('.block_events .row').forEach(element => element.addEventListener('click', event => {
        let modal = document.querySelector('.modal_book_offline');
        let course_one = event.target.closest('.course_item');

        let place = course_one.querySelector('.place').innerHTML;
        let date = course_one.querySelector('.date').innerHTML;
        let video_code = course_one.getAttribute('data-courseVideo');

        modal.setAttribute('data-courseId', course_one.getAttribute('data-courseId'));
        modal.querySelector('.course_info').innerHTML = place + ' ' + date;
        if (video_code === '') modal.classList.add('without_media');
        else {
            modal.classList.remove('without_media');
            modal.querySelector('.video_from_vimeo').innerHTML = video_code;
        }
        modal.classList.remove('success_step');
        modalOpen('.modal_book_offline');
    }));

    // Show video with Reviews from Youtube. 
    // #event #function
    document.querySelectorAll('.youtube_open_modal').forEach(element => element.addEventListener('click', event => {
        let modal_video = document.querySelector('.modal_view_youtube');
        let video_code = event.target.closest('.youtube_open_modal').getAttribute('data-videoCode');
        let video_src = "https://www.youtube-nocookie.com/embed/" + video_code;
        modal_video.querySelector('iframe.youtube_video').setAttribute('src', video_src);
        setTimeout(() => modalOpen('.modal_view_youtube'), 500);
    }));

})();