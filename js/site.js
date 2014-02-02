jQuery(document).ready(function($) {
    $('.noscript').hide();
    $.localScroll();
    $('.question').click(function() {

        if ($(this).siblings('.answer').hasClass('answer-open')) {

            $(this).siblings('.answer').removeClass('answer-open');
            $(this).children('.show-question').removeClass('show-rotate');

        } else {

            $(this).siblings('.answer').addClass('answer-open');
            $(this).children('.show-question').addClass('show-rotate');
        }
    });
});

function startIntro() {
    var intro = introJs();
    intro.setOptions({
        steps: [
            {
                element: "#inputStr",
                intro: "Bạn hãy vào trang <a href='http://qldt.utc.edu.vn' title='QLDT' target='_blank'>QLDT</a> , nhấn Ctrl+A, Ctrl+C và quay lại đây, Ctrl+V vào ô này",
                position: 'top'
            },
            {
                element: "#step2",
                intro: "<small>Sau đó nhấn nút này, dữ liệu của bạn sẽ được tính toán</small>",
                position: 'top'
            },
            {
                element: "#step3",
                intro: "Bạn có thể xem thứ hạng của mình tại đây<br/>Chức năng này đang được xây dựng <i class='fa fa-smile-o'></i>",
                position: 'top'
            },
            {
                element: "#step4",
                intro: "Bạn có thể tải phần mềm về để sử dụng",
                position: 'top'
            },
            {
                element: "#step5",
                intro: "Đây là những câu hỏi thường gặp",
                position: 'top'
            },
            {
                element: "#step6",
                intro: "Nếu còn có thắc mắc, hãy inbox chúng tôi nhé :D",
                position: 'top'
            }
        ],
    });
    
    intro.start();
}