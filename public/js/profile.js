/* PRIVATE */
<<<<<<< HEAD
(() => { })();
=======
(() => {
    // Save profile data
    // #function #server
    let saveProfileData = () => {
        let url = document.querySelector('.form').getAttribute('data-formAction');
        let data = {};
        data['type'] = 'save_profile';
        data['name'] = document.querySelector('.profile_name').value;
        data['lastname'] = document.querySelector('.profile_lastname').value;
        data['phone'] = document.querySelector('.profile_phone').value;
        data['email'] = document.querySelector('.profile_email').value;
        if (document.querySelector('.profile_avatar').files[0] !== null) {
            data['avatar'] = document.querySelector('.profile_avatar').files[0];
        }
        requestWithFetch('post', url, data, func_default_success, func_default_fail);
    }

    // Save profile data
    // #event
    document.querySelector('.profile_save').addEventListener('click', saveProfileData);

    // Delete profile data
    // #function #server
    let deleteProfileData = () => {
        let url = document.querySelector('.form').getAttribute('data-formAction');
        let func_success = (data) => { document.location = document.referrer; };
        requestWithFetch('post', url, { type: 'delete_profile' }, func_success, func_default_fail);
    }

    // Delete profile data
    // #event
    document.querySelector('.profile_delete').addEventListener('click', deleteProfileData);

    // Send Email for confirm email address
    // #code #function #event #server
    if (document.querySelector('.send_for_configm') !== null) {
        document.querySelector('.send_for_configm').addEventListener('click', (event) => {
            let func_success = () => view_modal_simple_info('A fresh verification link has been sent to your email address.');
            let url = event.target.getAttribute('data-action');
            makeRequest('POST', url, [], func_success, func_default_fail);
        });
    }

    // View preview Avatar-img
    // #event #function #filereader-event-function
    let preview_avatar_img = event => document.querySelector('.avatar .avatar_photo').style.backgroundImage = "url(" + event.target.result + ")";
    document.querySelector('.profile_avatar').addEventListener('change', event => preview_input_img(event.target.files[0], preview_avatar_img));

    // Delete user-course
    // #function
    let delete_profile_course = (event) => {
        let user_course_row = event.target.closest('.user_course_one');
        let user_course_id = user_course_row.getAttribute('data-userCourseId');
        if (user_course_id === '-1') return false;

        let url = document.querySelector('.form').getAttribute('data-formAction');
        let data = {
            type: 'delete_profile_course',
            user_course_id: user_course_id
        };
        let func_success = (data) => {
            console.log(data);
            user_course_row.remove();
        }
        requestWithFetch('post', url, data, func_success, func_default_fail);
    }

    // Delete user-course
    // #event
    document.querySelectorAll('.user_course_delete').forEach(element => element.addEventListener('click', delete_profile_course));

    // Add course for user
    // #function
    let add_profile_course = (event) => {
        let course_id = document.querySelector('#courses_select').value;
        if (course_id === '-1') return false;

        let url = document.querySelector('.form').getAttribute('data-formAction');
        let data = {
            type: 'add_profile_course',
            course_id: course_id
        };
        let func_success = (data) => {
            console.log(data);

            let user_course_id = data['data']['user_course_id'];
            let user_course_one = document.querySelector('.user_course_one[data-userCourseId="' + user_course_id + '"]');

            if (user_course_one === null) {
                // Set new data
                let user_course_one = document.getElementById('tpl_user_course_one').content.cloneNode(true);

                user_course_one.childNodes[1].setAttribute('data-courseId', data['data']['course_id']);
                user_course_one.childNodes[1].setAttribute('data-userCourseId', user_course_id);
                user_course_one.querySelector('.name').innerHTML = data['data']['name'];
                user_course_one.querySelector('.date_of_begin').innerHTML = data['data']['date_of_begin'];
                user_course_one.querySelector('.last_days .value').innerHTML = data['data']['days_last'];
                user_course_one.querySelector('.user_course_delete').addEventListener('click', delete_profile_course)

                document.querySelector('.profile_courses_table tbody').append(user_course_one);
            } else {
                console.log(user_course_one);
                user_course_one.querySelector('.last_days .value').innerHTML = data['data']['days_last'];
            }
            // view_modal_simple_info('Success!');
        }
        requestWithFetch('post', url, data, func_success, func_default_fail);
    }

    // Add course
    // #event
    document.querySelector('#profile_course_add').addEventListener('click', add_profile_course);
})();
>>>>>>> dev
