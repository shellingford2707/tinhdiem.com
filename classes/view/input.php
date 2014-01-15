<!-- ******************** HeaderWrap ********************-->
<div id="headerwrap">
    <header class="clearfix">
        <h1><span>Xin chào!</span> Đây là website tính điểm tích lũy dành cho sinh viên <span>UTC</span> <i class="fa fa-smile-o"></i></h1>
        <div class="container">
            <div class="row">
                <div class="span12">
                    <h2><i class="fa fa-check"></i> Hãy copy điểm từ <a href="http://qldt.utc.edu.vn" title="QLDT" target="_blank">qldt.utc.edu.vn</a> và paste vào ô dưới đây</h2>
                    <div id="theme-form" class="cform">
                        <form method="POST" action="./classes/controllers/input_controller.php">
                            <textarea id ="inputStr" class="cform-text" name="paste-data" title="Paste vào đây bạn nhé" placeholder="Paste vào đây bạn nhé :D" rows="10"></textarea>
                            <input class="cform-submit pull-right" type="submit" value="Tính điểm"/>
                        </form>                       
                    </div>                   
                </div>
            </div>
        </div>
    </header>
</div>