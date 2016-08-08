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



