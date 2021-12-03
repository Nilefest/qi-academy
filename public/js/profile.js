/* PRIVATE */
(() => {
    // Save profile data
    // #function #server
    let saveProfileData = () => {
        let url = document.querySelector('.form').getAttribute('data-formAction');
        let data = {};
        data['type'] = 'save_profile';
        data['name'] = document.querySelector('.profile_name').value;
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
})();