jQuery(document).ready(function($) {
    $('.noscript').hide();
    $.localScroll();
    $('.question').click(function () {

        if ($(this).siblings('.answer').hasClass('answer-open')) {

            $(this).siblings('.answer').removeClass('answer-open');
            $(this).children('.show-question').removeClass('show-rotate');

        } else {

            $(this).siblings('.answer').addClass('answer-open');
            $(this).children('.show-question').addClass('show-rotate');
        }
    });
});