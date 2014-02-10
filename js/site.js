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

    $.validator.addMethod("checkSelect", function(value, element) {
        return this.optional(element) || value !== "0";
    }, "Bạn phải chọn khoa (viện)");
    
    $("#inputForm").validate({
        rules: {
            pasteData: {
                required: true
            },
            major: {
                checkSelect: true
            }
        },
        messages: {
            pasteData: {
                required: "Bạn chưa dán dữ liệu copy từ QLDT vào"
            }
        }, 
        submitHandler: function (form) {
            $(form).hide();
            $("#loading").addClass("loading-bg").html('<img src="img/loading.GIF" />');
            setTimeout(function() {
                form.submit();
            }, 2000);
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
                element: "#major",
                intro: "Chú ý chọn khoa (viện) nhé bạn <i class='fa fa-smile-o'></i>",
                position: 'left'
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
            },
            {
                element: "#inputForm",
                intro: "Bắt đầu thôi ^^",
                position: 'bottom'
            }
        ],
    });

    intro.start();
}