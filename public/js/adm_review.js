/* PRIVATE */
(() => {

    // Remove review
    // #function #server
    let remove_review = (event) => {
        let review_item = event.target.closest('.review_item');
        let review_data = {
            id: review_item.getAttribute('data-reviewId')
        };

        /* -- POST NEW DATA TO SERVER -- */
        let url = document.querySelector('.reviews_form').getAttribute('data-formAction');
        review_data['type'] = 'delete_video_review';
        let func_success = (data) => {
            console.log(data);

            // Remove old data
            review_item.remove();

            view_modal_simple_info('Deleted!');
        };
        requestWithFetch('post', url, review_data, func_success, func_default_fail);
    }

    // Remove review
    // #event
    document.querySelectorAll('.remove_review').forEach(element => element.addEventListener('click', remove_review));

    // Add new review
    // #event #function #server
    document.querySelectorAll('.add_review').forEach(element => element.addEventListener('click', () => {
        let review_data = {};

        /* -- POST NEW DATA TO SERVER -- */
        let url = document.querySelector('.reviews_form').getAttribute('data-formAction');
        review_data['type'] = 'save_video_reviews';
        let func_success = (data) => {
            if (!data['data']['id']) return view_modal_simple_info(data['message']);

            // Add new data
            let review_item = document.getElementById('tpl_review_item').content.cloneNode(true);
            review_item.querySelector('.remove_review').addEventListener('click', remove_review);
            review_item.childNodes[1].setAttribute('data-reviewId', data['data']['id']);
            document.querySelector('.reviews_form tbody').append(review_item);
        };
        requestWithFetch('post', url, review_data, func_success, func_default_fail);
    }));

    // Save review
    // #event #function #server
    document.querySelector('.save_reviews').addEventListener('click', () => {
        document.querySelectorAll('.review_item').forEach(element => {
            let review_data = {
                id: element.getAttribute('data-reviewId'),
                video: element.querySelector('.review_video').value,
            };

            /* -- POST NEW DATA TO SERVER -- */
            let url = document.querySelector('.reviews_form').getAttribute('data-formAction');
            review_data['type'] = 'save_video_reviews';
            let func_success = (data) => {
                if (!data['data']['id']) return view_modal_simple_info(data['message']);

                view_modal_simple_info('Success!');
            };
            requestWithFetch('post', url, review_data, func_success, func_default_fail);
        });
    });
})();