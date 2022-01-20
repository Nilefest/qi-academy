/* PRIVATE */
(() => {
    // Main Slider with courses
    // #init #slick #jquery
    $('.slider_courses_ul').slick({
        dots: false,
        arrows: true,
        prevArrow: $('.slider_courses_arrow.prev'),
        nextArrow: $('.slider_courses_arrow.next'),
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        autoplay: false
    });

    // Slider with team
    // #init #slick #jquery
    $('.block_team_ul').slick({
        dots: false,
        arrows: true,
        prevArrow: $('.block_team_arrow.prev'),
        nextArrow: $('.block_team_arrow.next'),
        speed: 500,
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 1,

        responsive: [{
                breakpoint: 1441,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                }
            },
        ]
    });

    // Profile  Sliders with courses
    // #init #slick #jquery
    $('.course_list_ul').each(function() {
        let container = $(this).parent();
        $(this).slick({
            dots: false,
            arrows: true,
            prevArrow: container.find('.course_list_arrow.prev'),
            nextArrow: container.find('.course_list_arrow.next'),
            speed: 500,
            infinite: false,
            slidesToShow: 5,
            slidesToScroll: 1,

            responsive: [{
                    breakpoint: 1441,
                    settings: {
                        slidesToShow: 4,
                    }
                },
                {
                    breakpoint: 1022,
                    settings: {
                        slidesToShow: 3,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        slidesToShow: 2,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                    }
                },
            ]
        });
    });

    // Slider with video-reviews
    // #init #jquery
    $('.block_video_reviews_ul').slick({
        dots: false,
        arrows: true,
        prevArrow: $('.block_video_reviews_arrow.prev'),
        nextArrow: $('.block_video_reviews_arrow.next'),
        speed: 500,
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,

        responsive: [{
                breakpoint: 1441,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1.1,
                }
            },
        ]
    });
})();