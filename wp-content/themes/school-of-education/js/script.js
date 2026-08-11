jQuery(document).ready(function($){

    $.exists = function(selector) {
        return ($(selector).length > 0);
    }

    if ( $.exists('#tf-partical-wrap') && school_of_education_object.background_animation_status ) {
        
        // Some random colors
        const colors = school_of_education_object.background_animation_circle_colors;

        const numBalls = 50;
        const balls = [];

        for (let i = 0; i < numBalls; i++) {
            let ball = document.createElement('div');
            ball.classList.add('tf-ball');
            ball.style.background = colors[Math.floor(Math.random() * colors.length)];
            ball.style.left = `${Math.floor(Math.random() * 100)}vw`;
            ball.style.top = `${Math.floor(Math.random() * 100)}vh`;
            ball.style.transform = `scale(${Math.random()})`;
            ball.style.width = `${Math.random()}em`;
            ball.style.height = ball.style.width;
          
            balls.push(ball);
            document.getElementById('tf-partical-wrap').append(ball);
        }

        // Keyframes
        balls.forEach((el, i, ra) => {
          let to = {
            x: Math.random() * (i % 2 === 0 ? -11 : 11),
            y: Math.random() * 12
          };

          let anim = el.animate(
            [
              { transform: 'translate(0, 0)' },
              { transform: `translate(${to.x}rem, ${to.y}rem)` }
            ],
            {
              duration: (Math.random() + 1) * 3000, // random duration
              direction: 'alternate',
              fill: 'both',
              iterations: Infinity,
              easing: 'ease-in-out'
            }
          );
        });
    }

    /*-----------------------------------------------------------------------------------*/
    /*  COUNTER UP
    /*-----------------------------------------------------------------------------------*/
    jQuery('.school-value').counterUp({
        delay: 50,
        time: 1000
    });

    jQuery('.partner-slider').slick({
        rtl: school_of_education_object.rtl ? true : false,
         infinite: true,
         slidesToShow: 6,
         slidesToScroll: 1,
         swipeToSlide: school_of_education_object.rtl ? false : true,
         rows: 0,
         arrows: false,
         dots: false,
         autoplay: true,
         loop:true,
         responsive: [{
             breakpoint: 1000,
             settings: {
                 slidesToShow: 3
             }
         }, {
             breakpoint: 800,
             settings: {
                 slidesToShow: 3
             }
         }, {
             breakpoint: 500,
             settings: {
                 slidesToShow: 1
             }
         }]
     });

    $('.review-slider').slick({
        rtl: school_of_education_object.rtl ? true : false,
         infinite: true,
         slidesToShow: 3,
         slidesToScroll: 1,
         swipeToSlide: school_of_education_object.rtl ? false : true,
         arrows: false,
         dots: false,
         rows:0,
         autoplay: true,
         speed: 2000,
         loop:true,
         responsive: [{
             breakpoint: 800,
             settings: {
                 slidesToShow: 2
             }
         }, {
             breakpoint: 700,
             settings: {
                 slidesToShow: 1
             }
         }]
    });

    $('.testimonial-slider').slick({
        rtl: school_of_education_object.rtl ? true : false,
         infinite: true,
         slidesToShow: 3,
         slidesToScroll: 1,
         swipeToSlide: school_of_education_object.rtl ? false : true,
         arrows: false,
         dots: false,
         rows:0,
         autoplay: true,
         speed: 2000,
         loop:true,
         responsive: [{
             breakpoint: 800,
             settings: {
                 slidesToShow: 2
             }
         }, {
             breakpoint: 700,
             settings: {
                 slidesToShow: 1
             }
         }]
    });

});