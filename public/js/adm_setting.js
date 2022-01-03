/* PRIVATE */
(() => {
    // Save setting
    // #event #function #server
    document.getElementById('setting_save').addEventListener('click', () => {
        let setting_data = {
            save_setting: 1,
            fields: []
        };
        document.querySelectorAll('.setting_form .setting_field').forEach((element, index) => {
            setting_data['fields[' + index + '][type]'] = element.getAttribute('data-settingType');
            setting_data['fields[' + index + '][name]'] = element.getAttribute('data-settingName');
            setting_data['fields[' + index + '][value]'] = element.value;
        });

        /* -- POST NEW DATA TO SERVER -- */
        let url = document.querySelector('.setting_form').getAttribute('data-formAction');
        requestWithFetch('post', url, setting_data, func_default_success, func_default_fail);
    });
})();