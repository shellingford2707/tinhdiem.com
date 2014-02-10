<?php
include_once 'classes/util/DBUtil.php';
$majorList = DBUltility::getAllMajor();
?>
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
                    <div class="cform">
                        <form id="inputForm" method="POST" action="./result.html">
                            <select id="major" name="major">
                                <option value="0">---Chọn khoa (viện)---</option>
                                <?php
                                foreach ($majorList as $major) {
                                    echo '<option value="' . $major->getMajorID() . '">' . $major->getMajorName() . '</option>';
                                }
                                ?>
                            </select>
                            <textarea id ="inputStr" class="cform-text" name="pasteData" title="Paste vào đây bạn nhé" placeholder="Paste vào đây bạn nhé :D" rows="10"></textarea>                            
                            <input id="step2" class="cform-submit pull-right" type="submit" value="Tính điểm"/>
                        </form>                       
                    </div>
                    <div id="loading"></div>
                </div>
            </div>
        </div>
    </header>
</div>