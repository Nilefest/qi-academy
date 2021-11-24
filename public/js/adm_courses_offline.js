/* PRIVATE */
(() => {

    // Remove offline course
    // #function #server
    let remove_offline_course = (event) => {
        let course_item = event.target.closest('.course_item');
        course_item.nextElementSibling.remove();
        course_item.remove();

        /* -- POST TO SERVER -- */
    }

    // Remove offline course
    // #event
    document.querySelectorAll('.remove_course').forEach(element => element.addEventListener('click', remove_offline_course));

    // Add new offline course
    // #event #function
    document.querySelectorAll('.add_course').forEach(element => element.addEventListener('click', () => {
        /* -- POST-GET NEW ID FROM SERVER -- */

        let course_item = document.getElementById('tpl_course_item').content.cloneNode(true);
        course_item.addEventListener('click', remove_offline_course);
        document.querySelector('.courses_offline tbody').append(course_item);
    }));
    // Save offline courses
    // #event #function
    document.querySelectorAll('.save_courses').forEach(element => element.addEventListener('click', () => {
        /* -- POST TO SERVER -- */
        
        document.querySelector('.modal_simple_info .message').innerHTML  = 'Сохранено!';
        modalOpen('.modal_simple_info');
    }));
})();