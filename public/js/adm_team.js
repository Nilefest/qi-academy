/* PRIVATE */
(() => {
    // Open modal Team
    //#function #server
    let team_adm_modal_open = () => {

        /* -- GET DATA FROM SERVER -- */

        modalOpen('.modal_team_adm');
    };

    // Open modal Team
    // #event
    document.querySelectorAll('.team_adm_modal.view').forEach(element => element.parentElement.addEventListener('click', team_adm_modal_open));

    // Open modal Team ADM for Add
    // #event #function #server
    document.querySelectorAll('.team_add').forEach(element => element.addEventListener('click', () => {

        // Clear old data
        document.querySelector('.modal_team_adm').setAttribute('data-teamId', '0');
        document.querySelector('.modal_team_adm .team_img').style.backgroundImage = "";
        document.querySelectorAll('.modal_team_adm input[type="text"], .modal_team_adm textarea').forEach(element => element.value = "");

        modalOpen('.modal_team_adm');
    }));

    // View preview Team-img
    // #event #function #filereader-event-function
    let preview_team_img = event => document.querySelector('.modal_team_adm .team_img').style.backgroundImage = "url(" + event.target.result + ")";
    document.querySelector('.modal_team_adm .team_img input').addEventListener('change', event => preview_input_img(event.target.files[0], preview_team_img));

    // Save data from modal Team ADM
    // #event #function #server
    document.querySelector('.modal_team_adm .save').addEventListener('click', () => {
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
    });
})();