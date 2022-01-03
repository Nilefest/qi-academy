(() => {

    // Update sugnature
    // #event #function #server
    document.querySelector('.form_pay').addEventListener('submit', event => {
        event.preventDefault();

        let form = event.target;

        let url = document.location;
        let pay_data = {
            update_signature: 1
        };
        form.querySelectorAll('.field_editable').forEach(element => pay_data[element.getAttribute('name')] = element.value);
        let func_success = (data) => {
            if (!data['data'].hasOwnProperty('orderDescription') || !data['data'].hasOwnProperty('signature_str')) {
                view_modal_simple_info('Coś poszło nie tak... Spróbuj trochę później lub skontaktuj się z administratorem.');
                return false;
            }

            form.querySelector('input[name="customerFirstName"]').value = data['data']['customerFirstName'];
            form.querySelector('input[name="customerLastName"]').value = data['data']['customerLastName'];
            form.querySelector('input[name="customerEmail"]').value = data['data']['customerEmail'];
            form.querySelector('input[name="customerPhone"]').value = data['data']['customerPhone'];
            form.querySelector('input[name="orderDescription"]').value = data['data']['orderDescription'];
            form.querySelector('input[name="signature"]').value = data['data']['signature_str'];

            form.submit()
        };
        requestWithFetch('post', url, pay_data, func_success, func_default_fail);

        return false;
    });
})()