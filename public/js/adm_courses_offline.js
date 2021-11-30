/* PRIVATE */
(() => {

    // Remove offline course
    // #function #server
    let remove_offline_course = (event) => {
        let course_item = event.target.closest('.course_item');
        let course_data = {
            id: course_item.getAttribute('data-courseId')
        };

        /* -- POST NEW DATA TO SERVER -- */
        let url = document.querySelector('.courses_offline').getAttribute('data-formAction');
        course_data['type'] = 'delete_course_offline';
        let func_success = (data) => {
            console.log(data);

            // Remove old data
            course_item.nextElementSibling.remove();
            course_item.remove();

            view_modal_simple_info('Deleted!');
        };
        requestWithFetch('post', url, course_data, func_success, func_default_fail);
    }

    // Remove offline course
    // #event
    document.querySelectorAll('.remove_course').forEach(element => element.addEventListener('click', remove_offline_course));

    // Add new offline course
    // #event #function #server
    document.querySelectorAll('.add_course').forEach(element => element.addEventListener('click', () => {
        let course_data = {};

        /* -- POST NEW DATA TO SERVER -- */
        let url = document.querySelector('.courses_offline').getAttribute('data-formAction');
        course_data['type'] = 'save_course_offline';
        let func_success = (data) => {
            if (!data['data']['id']) return view_modal_simple_info(data['message']);

            // Add new data
            let course_item = document.getElementById('tpl_course_item').content.cloneNode(true);
            course_item.addEventListener('click', remove_offline_course);
            course_item.querySelectorAll('.course_item').forEach(element => element.setAttribute('data-courseId', data['data']['id']));
            document.querySelector('.courses_offline tbody').append(course_item);

            // view_modal_simple_info('Success!');
        };
        requestWithFetch('post', url, course_data, func_success, func_default_fail);
    }));
    // Save offline courses
    // #event #function #server
    document.querySelectorAll('.save_courses').forEach(element => element.addEventListener('click', () => {
        document.querySelectorAll('.course_item.info').forEach(element => {
            let course_data = {
                id: element.getAttribute('data-courseId'),
                name: element.querySelector('.course_name').value,
                place: element.querySelector('.course_place').value,
                date_of: element.querySelector('.course_date_of').value,
                period: element.querySelector('.course_period').value,
                video: element.nextElementSibling.querySelector('.course_video').value,
            };

            /* -- POST NEW DATA TO SERVER -- */
            let url = document.querySelector('.courses_offline').getAttribute('data-formAction');
            course_data['type'] = 'save_course_offline';
            let func_success = (data) => {
                if (!data['data']['id']) return view_modal_simple_info(data['message']);

                // view_modal_simple_info('Success!');
            };
            requestWithFetch('post', url, course_data, func_success, func_default_fail);
        });

        document.querySelector('.modal_simple_info .message').innerHTML = 'Сохранено!';
        modalOpen('.modal_simple_info');
    }));
})();