/* PRIVATE */
(() => {
<<<<<<< HEAD
    // Open modal Team
    //#function #server
    let team_adm_modal_open = () => {

        /* -- GET DATA FROM SERVER -- */

=======

    // Open modal Team
    //#function
    let team_adm_modal_open = (event) => {
        // Get current data
        let team_one = event.target.closest('.team_one');
        let team_data = {
            id: team_one.getAttribute('data-teamId'),
            img: team_one.querySelector('.team_img').getAttribute('style'),
            name: team_one.querySelector('.name').innerHTML,
            info: team_one.getAttribute('data-teamInfo'),
            instagram: team_one.querySelector('.soc_instagram').getAttribute('href'),
            facebook: team_one.querySelector('.soc_facebook').getAttribute('href')
        };

        // Set current data
        let modal = document.querySelector('.modal_team_adm');
        modal.setAttribute('data-teamId', team_data['id']);
        modal.querySelector('.team_img').setAttribute('style', team_data['img']);
        modal.querySelector('.team_img_file').value = '';
        modal.querySelector('.team_name').value = team_data['name'];
        modal.querySelector('textarea.team_info').value = team_data['info'];
        modal.querySelector('.soc_instagram').value = team_data['instagram']
        modal.querySelector('.soc_facebook').value = team_data['facebook'];
        modal.querySelector('.delete').classList.remove('d-none');
>>>>>>> dev
        modalOpen('.modal_team_adm');
    };

    // Open modal Team
    // #event
    document.querySelectorAll('.team_adm_modal.view').forEach(element => element.parentElement.addEventListener('click', team_adm_modal_open));

    // Open modal Team ADM for Add
<<<<<<< HEAD
    // #event #function #server
    document.querySelectorAll('.team_add').forEach(element => element.addEventListener('click', () => {

        // Clear old data
        document.querySelector('.modal_team_adm').setAttribute('data-teamId', '0');
        document.querySelector('.modal_team_adm .team_img').style.backgroundImage = "";
        document.querySelectorAll('.modal_team_adm input[type="text"], .modal_team_adm textarea').forEach(element => element.value = "");

=======
    // #event #function
    document.querySelectorAll('.team_add').forEach(element => element.addEventListener('click', () => {
        // Clear old data
        let modal = document.querySelector('.modal_team_adm');
        modal.setAttribute('data-teamId', '');
        modal.querySelector('.team_img').setAttribute('style', '');
        modal.querySelector('.team_img_file').value = '';
        modal.querySelector('.team_name').value = '';
        modal.querySelector('textarea.team_info').value = '';
        modal.querySelector('.soc_instagram').value = ''
        modal.querySelector('.soc_facebook').value = '';
        modal.querySelector('.delete').classList.add('d-none');
>>>>>>> dev
        modalOpen('.modal_team_adm');
    }));

    // View preview Team-img
    // #event #function #filereader-event-function
    let preview_team_img = event => document.querySelector('.modal_team_adm .team_img').style.backgroundImage = "url(" + event.target.result + ")";
    document.querySelector('.modal_team_adm .team_img input').addEventListener('change', event => preview_input_img(event.target.files[0], preview_team_img));

    // Save data from modal Team ADM
    // #event #function #server
    document.querySelector('.modal_team_adm .save').addEventListener('click', () => {
<<<<<<< HEAD
        let modal = document.querySelector('.modal_team_adm');

        let item_id = modal.getAttribute('data-teamId');
        let team_name = modal.querySelector('.team_name').value;
        let team_info = modal.querySelector('.team_info').value;
        let soc_instagram = modal.querySelector('.soc_instaram').value;
        let soc_facebook = modal.querySelector('.soc_facebook').value;

        /* -- POST DATA TO SERVER -- */

        // Add new team-item to page
        if (item_id === '0') {
            let team_item = document.getElementById('tpl_team_item').content.cloneNode(true);
            team_item.querySelector('.team_list_media').addEventListener('click', team_adm_modal_open);
            team_item.querySelector('.name').innerHTML = team_name;
            team_item.querySelector('.soc_facebook a').setAttribute('href', soc_facebook);
            team_item.querySelector('.soc_instagram a').setAttribute('href', soc_instagram);
            document.querySelector('.team_list_li.team_add').after(team_item);
        }
=======
        // Get new data
        let modal = document.querySelector('.modal_team_adm');
        let team_data = {
            id: modal.getAttribute('data-teamId'),
            img: modal.querySelector('.team_img').getAttribute('style'),
            name: modal.querySelector('.team_name').value,
            info: modal.querySelector('textarea.team_info').value,
            instagram: modal.querySelector('.soc_instagram').value,
            facebook: modal.querySelector('.soc_facebook').value
        };
        if (modal.querySelector('.team_img_file').files[0] !== null) {
            team_data['img_file'] = modal.querySelector('.team_img_file').files[0];
        }

        /* -- POST NEW DATA TO SERVER -- */
        let url = modal.getAttribute('data-formAction');
        team_data['type'] = 'save_team';
        let func_success = (data) => {
            console.log(data);
            if (!data['data']['id']) return view_modal_simple_info(data['message']);
            // Set new data
            let team_one = document.getElementById('tpl_team_one').content.cloneNode(true);
            team_one.querySelector('.team_list_media').addEventListener('click', team_adm_modal_open);
            team_one.childNodes[1].setAttribute('data-teamId', data['data']['id']);
            team_one.querySelector('.team_img').setAttribute('style', team_data['img']);
            team_one.querySelector('.name').innerHTML = team_data['name'];
            team_one.childNodes[1].setAttribute('data-teamInfo', team_data['info']);
            team_one.querySelector('.soc_instagram').setAttribute('href', team_data['instagram']);
            team_one.querySelector('.soc_instagram').parentElement.classList.add('d-none');
            if (team_data['instagram'] !== '') team_one.querySelector('.soc_instagram').parentElement.classList.remove('d-none');
            team_one.querySelector('.soc_facebook').setAttribute('href', team_data['facebook']);
            team_one.querySelector('.soc_facebook').parentElement.classList.add('d-none');
            if (team_data['facebook'] !== '') team_one.querySelector('.soc_facebook').parentElement.classList.remove('d-none');

            let team_list = document.querySelector('.team_list');
            let team_old = team_list.querySelector('.team_one[data-teamId="' + team_data['id'] + '"]');
            if (team_old === null) team_list.querySelector('.team_add').after(team_one);
            else team_old.replaceWith(team_one);

            view_modal_simple_info('Success!');
        };
        requestWithFetch('post', url, team_data, func_success, func_default_fail);
    });

    // Delete temmate ADM
    // #event #function #server
    document.querySelector('.modal_team_adm .delete').addEventListener('click', () => {
        // Get new data
        let modal = document.querySelector('.modal_team_adm');
        let team_data = {
            id: modal.getAttribute('data-teamId'),
        };

        /* -- POST NEW DATA TO SERVER -- */
        let url = modal.getAttribute('data-formAction');
        team_data['type'] = 'delete_team';
        let func_success = (data) => {
            if (!data['data']['id']) return view_modal_simple_info(data['message']);

            // Remove old data
            let team_one = document.querySelector('.team_one[data-teamId="' + team_data['id'] + '"]');
            team_one.remove();

            view_modal_simple_info('Success!');
        };
        requestWithFetch('post', url, team_data, func_success, func_default_fail);
>>>>>>> dev
    });
})();