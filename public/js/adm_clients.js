(() => {

    // Sort and search clients
    // #function
    let sort_search_cliets = (sort_by, search_by) => {
        console.log(sort_by);
        console.log(search_by);

        let download_href = document.querySelector('.clients_table .download').getAttribute('data-href');
        download_href += `?sort_by=${sort_by}&search_by=${search_by}`;
        document.querySelector('.clients_table .download').setAttribute('href', download_href);

        let data = {
            sort_by: sort_by,
            search_by: search_by
        };

        /* -- POST NEW DATA TO SERVER -- */
        let url = document.querySelector('.clients_form').getAttribute('data-formAction');
        let func_success = (data) => {
            // console.log(data);

            document.querySelector('.clients_table tbody').innerHTML = '';
            data['data']['clients'].forEach((element, key) => {

                // Add new data
                let client_item = document.getElementById('tpl_client_item').content.cloneNode(true);
                client_item.querySelector('.tools').innerHTML = key;
                client_item.querySelector('.name').innerHTML = element['name'];
                client_item.querySelector('.phone').innerHTML = element['phone'];
                client_item.querySelector('.email').innerHTML = element['email'];
                client_item.querySelector('.total_courses').innerHTML = element['total_courses'];
                client_item.querySelector('.link a').setAttribute('href', client_item.querySelector('.link a').getAttribute('href') + element['id']);
                document.querySelector('.clients_table tbody').append(client_item);
            });
        };
        requestWithFetch('post', url, data, func_success, func_default_fail);

    }

    // Sort clients with search word
    // #event #function
    document.querySelectorAll('.sort_button').forEach(element => element.addEventListener('click', event => {
        let sort_by = event.target.closest('.sort_button').getAttribute('data-sortBy');
        let search_by = document.querySelector('.search_by').value;

        sort_search_cliets(sort_by, search_by);

        document.querySelectorAll('.sort_button.active').forEach(element => element.classList.remove('active'));
        event.target.closest('.sort_button').classList.add('active');
    }));

    // Search client by word and clear sort
    // #event #function
    document.querySelector('.search_by').addEventListener('change', event => {
        document.querySelectorAll('.sort_button.active').forEach(element => element.classList.remove('active'));
        let sort_by = 'name';
        let search_by = document.querySelector('.search_by').value;

        sort_search_cliets(sort_by, search_by);
    });
})();