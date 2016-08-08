/** Scroll Menu */
var scroll_start = 0;
var menu = $('#menu');
if ( menu.length ) {
    var offset = menu.offset();
    $(document).scroll(function() {
        scroll_start = $(this).scrollTop();
        if(scroll_start > offset.top) {
            menu.removeClass('remove-box-shadow');
        } else {
            menu.addClass( "remove-box-shadow" );
        }
    });
}

/** Fab Menu*/
//Fab menu
var nbOptions = 8;
var angleStart = -360;

// jquery rotate animation
function rotate(li,d) {
    $({d:angleStart}).animate({d:d}, {
        step: function(now) {
            $(li)
                .css({ transform: 'rotate('+now+'deg)' })
                .find('label')
                .css({ transform: 'rotate('+(-now)+'deg)' });
        }, duration: 0
    });
}

// show / hide the options
function toggleOptions(s) {
    $(s).toggleClass('open');
    var li = $(s).find('li');
    var deg = $(s).hasClass('half') ? 180/(li.length-1) : 360/li.length;
    for(var i=0; i<li.length; i++) {
        var d = $(s).hasClass('half') ? (i*deg)-90 : i*deg;
        $(s).hasClass('open') ? rotate(li[i],d) : rotate(li[i],angleStart);
    }
}

$('.selector button').click(function(e) {
    $(this).toggleClass('active');
    toggleOptions($(this).parent());
});

// Datepicker for form
var datepicker = $('#published_date');
if(datepicker)
{
    datepicker.pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year
        format: 'dd-mm-yyyy',
        //min: new Date()
    });
}

//Modal
var modal = $('.modal-trigger');
if(modal)
{
    modal.leanModal();
}

//Side-nav collapsible
var sidenav = $(".button-collapse");
if(sidenav)
{
    sidenav.sideNav();
}
//slick
var slick =$('.slick-carousel');
if(slick)
{
    slick.slick({
        dots: false,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear',
        slide: 'li',
        autoplay: true,
        autoplaySpeed: 4000
    });
}
//smooth scroll
$(function() {
    $('a.smooth[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });
});

//custom validation message for search input.

//$('#search').get(0).setCustomValidity('Campo Requerido.');