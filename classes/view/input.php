<!-- ******************** HeaderWrap ********************-->
<div id="headerwrap">
    <header class="clearfix">
        <div class="noscript">
            <p>Trình duyệt của bạn không hỗ trợ Javascript <i class="fa fa-frown-o"></i>.
                Website này sử dụng được tốt nhất khi có Javascript.</p>
        </div>
        <h1><span>Xin chào!</span> Đây là website tính điểm tích lũy dành cho sinh viên <span>UTC</span> <i class="fa fa-smile-o"></i></h1>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h2><i class="fa fa-check"></i> Hãy copy điểm từ <a href="http://qldt.utc.edu.vn" title="QLDT" target="_blank">qldt.utc.edu.vn</a> và paste vào ô dưới đây</h2>
                    <div id="theme-form" class="cform">
                        <form method="POST" action="./classes/controllers/input_controller.php">
                            <textarea data-step="1" data-intro="Bạn hãy vào trang QLDT , nhấn Ctrl+A, Ctrl+C và quay lại đây, Ctrl+V vào ô này" id ="inputStr" class="cform-text" name="paste-data" title="Paste vào đây bạn nhé" placeholder="Paste vào đây bạn nhé :D" rows="10"></textarea>
                            <input data-step="2" data-intro="Sau đó nhấn nút này, dữ liệu của bạn sẽ được tính toán" class="cform-submit pull-right" type="submit" value="Tính điểm"/>
                        </form>                       
                    </div>                   
                </div>
            </div>
        </div>
    </header>
</div>