// Remove FAQ items
// #function #server
let remove_faq_item = (event) => {
    /* -- POST TO SERVER -- */

    event.target.closest('.faq_item').remove();
};

// Remove FAQ items
// #event
document.querySelectorAll('.faq_block .icon_remove').forEach(element => element.addEventListener('click', remove_faq_item));

// Open/Hide FAQ items
// #function
let toggle_faq_item = (event) => event.target.closest('.faq_item').classList.toggle('open');
let open_faq_item = (event) => event.target.closest('.faq_item').classList.add('open');

// Open/Hide FAQ items
// #event
document.querySelectorAll('.faq_block .icon_down').forEach(element => element.addEventListener('click', toggle_faq_item));
document.querySelectorAll('.faq_block .text').forEach(element => element.addEventListener('focus', open_faq_item));

// Add FAQ item
document.querySelector('.faq_add').addEventListener('click', () => {
    /* -- POST-GET NEW ID FROM SERVER -- */

    let faq_item = document.getElementById('tpl_faq_item').content.cloneNode(true);
    faq_item.querySelector('.icon_remove').addEventListener('click', remove_faq_item);
    faq_item.querySelector('.icon_down').addEventListener('click', toggle_faq_item);
    faq_item.querySelectorAll('.text').forEach(element => element.addEventListener('click', open_faq_item));
    document.querySelector('.faq_list').append(faq_item);
});