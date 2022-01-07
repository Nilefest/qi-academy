/* PRIVATE */
(() => {

    // View preview Banner
    // #event #function #filereader-event-function
    let preview_banner_img = event => document.querySelector('.block_banner .banner_image').style.backgroundImage = "url(" + event.target.result + ")";
    document.querySelector('.block_banner input').addEventListener('change', event => preview_input_img(event.target.files[0], preview_banner_img));

    // View preview Gallery. Photo 1
    // #event #function #filereader-event-function
    document.querySelectorAll('.gallery_block .photos input').forEach(element => {
        let preview_gallery_img = event => element.closest('label').style.backgroundImage = "url(" + event.target.result + ")";
        element.addEventListener('change', event => preview_input_img(event.target.files[0], preview_gallery_img))
    });

    // Remove Experience item
<<<<<<< HEAD
    // #function #server
    let remove_exp_item = (event) => {
        /* -- POST TO SERVER -- */

        event.target.closest('.exp_item').remove();
    };
=======
    // #function
    let remove_exp_item = (event) => event.target.closest('.exp_item').remove();
>>>>>>> dev

    // Remove Experience item
    // #event
    document.querySelectorAll('.experience_block .icon_remove').forEach(element => element.addEventListener('click', remove_exp_item));

    // Add Experience item
<<<<<<< HEAD
    document.querySelector('.exp_add').addEventListener('click', () => {
        /* -- POST-GET NEW ID FROM SERVER -- */

=======
    // #event #function
    document.querySelector('.exp_add').addEventListener('click', () => {
>>>>>>> dev
        let exp_item = document.getElementById('tpl_exp_item').content.cloneNode(true);
        exp_item.querySelector('.icon_remove').addEventListener('click', remove_exp_item);
        document.querySelector('.exp_list').append(exp_item);
    });

    // Open/Hide Lecture items
    // #function
    let toggle_lecture_item = (event) => event.target.closest('.lecture_item').classList.toggle('open');
    let open_lecture_item = (event) => event.target.closest('.lecture_item').classList.add('open');

    // Open/Hide Lecture items
    // #event
    document.querySelectorAll('.lectures_block .icon_down').forEach(element => element.addEventListener('click', toggle_lecture_item));
    document.querySelectorAll('.lectures_block .text').forEach(element => element.addEventListener('focus', open_lecture_item));

    // Remove Lecure item
<<<<<<< HEAD
    // #function #server
    let remove_lecture_item = (event) => {
        /* -- POST TO SERVER -- */

        event.target.closest('.lecture_item').remove();
    };
=======
    // #function
    let remove_lecture_item = (event) => event.target.closest('.lecture_item').remove();
>>>>>>> dev

    // Remove Lecture item
    // #event
    document.querySelectorAll('.lectures_block .icon_remove').forEach(element => element.addEventListener('click', remove_lecture_item));

    // Add Lecture item
<<<<<<< HEAD
    document.querySelector('.add_lecture').addEventListener('click', () => {
        /* -- POST-GET NEW ID FROM SERVER -- */

=======
    // #event #function
    document.querySelector('.add_lecture').addEventListener('click', () => {
>>>>>>> dev
        let lecture_item = document.getElementById('tpl_lecture_item').content.cloneNode(true);
        lecture_item.querySelector('.title .num').innerHTML = document.querySelectorAll('.lecture_item').length + 1;
        lecture_item.querySelector('.icon_remove').addEventListener('click', remove_lecture_item);
        lecture_item.querySelector('.icon_down').addEventListener('click', toggle_lecture_item);
        lecture_item.querySelectorAll('.text').forEach(element => element.addEventListener('focus', open_lecture_item));
<<<<<<< HEAD
        document.querySelector('.lectures_list').append(lecture_item);
    });

    // Open modal for edit Lecture
    // #event #function
    document.querySelectorAll('.edit_lecture').forEach(element => element.addEventListener('click', (event) => {
        modalOpen('.modal_lecture');
    }));

    // Save Lecture from modal
    // #event #function #server
    document.querySelector('.lecture_save').addEventListener('click', (event) => {
        /* -- POST TO SERVER -- */
    });
=======
        lecture_item.querySelector('.edit_lecture').addEventListener('click', open_modal_lecture);
        document.querySelector('.lectures_list').append(lecture_item);
    });

    // Change file to Lecture modal
    // #event #function
    document.querySelector('.modal_lecture #bonus_file').addEventListener('change', (event) => {
        let modal = document.querySelector('.modal_lecture');
        let lecture_file_block = event.target.closest('.lecture_file_block');

        if (event.target.files[0] !== null) {
            console.log(event.target.files[0]);
            modal.querySelector('.lecture_file_block a').setAttribute('href', '#uploaded_file');
            modal.querySelector('.lecture_file_block a span').innerHTML = event.target.files[0].name;
            modal.querySelector('.lecture_file_block a').classList.remove('d-none');
        } else {
            modal.querySelector('.lecture_file_block a').setAttribute('href', '#');
            modal.querySelector('.lecture_file_block a').classList.add('d-none');
        }
    });

    // Open modal for edit Lecture
    // #function
    let open_modal_lecture = (event) => {
        let modal = document.querySelector('.modal_lecture');
        let lecture_item = event.target.closest('.lecture_item');

        var index_node = Array.prototype.indexOf.call(lecture_item.parentNode.children, lecture_item);
        modal.setAttribute('data-lectureIndexNodes', index_node);

        modal.querySelector('.video').value = lecture_item.getAttribute('data-lectureVideo');
        modal.querySelector('.info_full').value = lecture_item.getAttribute('data-lectureInfoFull');
        modal.querySelector('.homework').value = lecture_item.getAttribute('data-lectureHomework');
        let file = lecture_item.getAttribute('data-lectureFile');
        if (file) {
            modal.querySelector('.lecture_file_block a').setAttribute('href', file);
            modal.querySelector('.lecture_file_block a span').innerHTML = 'Download';
            modal.querySelector('.lecture_file_block a').classList.remove('d-none');
        } else {
            modal.querySelector('.lecture_file_block a').classList.add('d-none');
        }

        modalOpen('.modal_lecture');
    }

    // Open modal for edit Lecture
    // #event
    document.querySelectorAll('.edit_lecture').forEach(element => element.addEventListener('click', open_modal_lecture));

    // Save Lecture from modal
    // #event #function
    document.querySelector('.lecture_save').addEventListener('click', () => {
        let modal = document.querySelector('.modal_lecture');
        let lecture_item = document.querySelectorAll('.lecture_item')[modal.getAttribute('data-lectureIndexNodes')];

        let lecture_file = modal.querySelector('.file').cloneNode(true);
        if (lecture_file.files[0] !== null) {
            lecture_file.setAttribute('id', '');
            lecture_file.setAttribute('class', 'd-none lecture_file');

            lecture_item.setAttribute('data-lectureFile', '');
            lecture_item.querySelector('.lecture_file').parentNode.replaceChild(lecture_file, lecture_item.querySelector('.lecture_file'));
        }


        lecture_item.setAttribute('data-lectureInfoFull', modal.querySelector('.info_full').value);
        lecture_item.setAttribute('data-lectureHomework', modal.querySelector('.homework').value);
        lecture_item.setAttribute('data-lectureVideo', modal.querySelector('.video').value);

    });

    // Save Course
    // #event #function #server
    document.querySelector('.course_save').addEventListener('click', () => {
        let course_one = document.querySelector('.course_form');
        let course_data = {
            main_course: course_one.querySelector('.course_main_course').checked * 1,
            free: course_one.querySelector('.course_free').checked * 1,
            free_for_client: course_one.querySelector('.course_free_for_client').checked * 1,
            only_paid: course_one.querySelector('.course_only_paid').checked * 1,
            name: course_one.querySelector('.course_name .text').value,
            banner_img: course_one.querySelector('.course_banner_img').files[0] || null,
            total_days: course_one.querySelector('.course_total_days').value * 1,
            total_hours: course_one.querySelector('.course_total_hours').value * 1,
            cost: course_one.querySelector('.course_cost .text').value * 1,
            video_preview: course_one.querySelector('.course_video_preview').value,
            description: course_one.querySelector('.course_description').value,
            description_for_1: course_one.querySelector('.course_description_for_1').value,
            description_for_2: course_one.querySelector('.course_description_for_2').value,
            team_id: course_one.querySelector('.course_team_id').value * 1,
            gallery_img_1: course_one.querySelector('.course_gallery_img_1').files[0] || null,
            gallery_img_2: course_one.querySelector('.course_gallery_img_2').files[0] || null,
            gallery_img_3: course_one.querySelector('.course_gallery_img_3').files[0] || null,
        };
        document.querySelectorAll('.exp_item').forEach((element, index) => course_data['course_exp[' + index + '][info]'] = element.querySelector('.course_exp_info').value);
        document.querySelectorAll('.faq_item').forEach((element, index) => {
            course_data['course_faq[' + index + '][title]'] = element.querySelector('.faq_title').value;
            course_data['course_faq[' + index + '][info]'] = element.querySelector('.faq_info').value;
        });
        document.querySelectorAll('.lecture_item').forEach((element, index) => {
            course_data['course_lecture[' + index + '][id]'] = element.getAttribute('data-lectureId');
            course_data['course_lecture[' + index + '][name]'] = element.querySelector('.lecture_name').value;
            course_data['course_lecture[' + index + '][info_short]'] = element.querySelector('.lecture_info_short').value;
            course_data['course_lecture[' + index + '][info_full]'] = element.getAttribute('data-lectureInfoFull');
            course_data['course_lecture[' + index + '][video]'] = element.getAttribute('data-lectureVideo');
            course_data['course_lecture[' + index + '][file]'] = '';
            course_data['course_lecture[' + index + '][homework]'] = element.getAttribute('data-lectureHomework');
            if (element.querySelector('.lecture_file').files[0] !== null) {
                course_data['course_lecture[' + index + '][file]'] = element.querySelector('.lecture_file').files[0];
            }
        });

        let url = course_one.getAttribute('data-formAction');
        course_data['type'] = 'save_course';
        let func_success = (data) => {
            console.log(data);
            if (!data['data']['id']) return view_modal_simple_info(data['message']);

            view_modal_simple_info('Success!');
            if (document.querySelector('.course_delete') === null) {
                setTimeout(() => document.location.href = url + '/' + data['data']['id'], 1000);
            }
        };
        requestWithFetch('post', url, course_data, func_success, func_default_fail);
    });

    // Delete Course
    // #event #function #server
    if (document.querySelector('.course_delete') !== null) {
        document.querySelector('.course_delete').addEventListener('click', () => {
            let course_one = document.querySelector('.course_form');
            let course_data = {
                id: course_one.getAttribute('data-courseId')
            };

            let url = course_one.getAttribute('data-formAction');
            course_data['type'] = 'delete_course';
            let func_success = (data) => {
                console.log(data);
                if (!data['data']['id']) return view_modal_simple_info(data['message']);

                view_modal_simple_info('Deleted!');
                setTimeout(() => document.location.href = document.querySelector('.back_link').getAttribute('href'), 1000);
            };
            requestWithFetch('post', url, course_data, func_success, func_default_fail);
        });
    }
>>>>>>> dev
})();