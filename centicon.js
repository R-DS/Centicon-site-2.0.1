
/***collapse navbar when menu button clicked*/
//jquery
$('.nav-link').on('click',function() {
    $('.navbar-collapse').collapse('hide');
});

/***navbar javascript***/
document.addEventListener("DOMContentLoaded", function(){

    let el_autohide = document.querySelector('.autohide');

    let navbar_height = document.querySelector('.navbar').offsetHeight;
    document.body.style.paddingTop = navbar_height + 'px';

    if(el_autohide){
        let last_scroll_top = 0;
        window.addEventListener('scroll', function() {
            let scroll_top = window.scrollY;
            if(scroll_top < last_scroll_top) {
                el_autohide.classList.remove('scrolled-down');
                el_autohide.classList.add('scrolled-up');
            }
            else {
                el_autohide.classList.remove('scrolled-up');
                el_autohide.classList.add('scrolled-down');
            }
            last_scroll_top = scroll_top;
        });
    }
});


let items = document.querySelectorAll('.abt')

items.forEach((el) => {
    const minPerSlide = 3
    let next = el.nextElementSibling
    for (let i=1; i<minPerSlide; i++) {
        if (!next) {
            // wrap carousel by using first child
            next = items[0]
        }
        let cloneChild = next.cloneNode(true)
        el.appendChild(cloneChild.children[0])
        next = next.nextElementSibling
    }
});



/* navbar js ends*/



/***Home and Contact animation*/
window.sr = ScrollReveal();
sr.reveal('.Home h1', {duration: 3000, origin: 'top', distance: '40px'});
/*sr.reveal('.contactleft', {
    duration: 2000, origin: 'left', distance: '300px'
});
sr.reveal('.contactright', {
    duration: 2000, origin: 'right', distance: '300px'
});*/


/***Scrolling smooth animation*/

$(function () {
    // smooth scrolling
    $('a[href*="#"]:not([href="#"])').click(function (){
        if(location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') &&
            location.hostname === this.hostname) {
            let target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1);
                return false;
            }
        }
    });
});


$('input').on('focus', function() {
    $(this).prev('label').addClass('moveUp');
})

$('input').on('focusout', function() {
    if (!$(this).val()) $(this).prev('label').removeClass('moveUp');
})



/*** Services section ***/
$('.team-slider').owlCarousel({
    loop:true,
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000, smartSpeed: 450, margin: 20,
    responsiveClass: true,
    nav:true,
    responsive:{
        0:{
            items:1,
            nav: false,
            height: 100
        },
        600:{
            items:2
        },
        1000:{
            items:3
        },
        1800: {
            items: 4
        }
    }
});