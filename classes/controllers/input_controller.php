<?php
include_once '../model/Student.php';

$strInput = $_POST['paste-data'];
if(isset($strInput))
{
   $theStudent = Student::ClipboardReader($strInput);   
   $trungbinhH4 = $theStudent->get_TrungBinhChungTichLuy();
   $trungbinhH10 = $theStudent->get_TrungBinhHe10();
   $ar_monCoTheNangDiem = $theStudent->get_Subjects_CoTheNangDiem();//mảng mon co the nang diem
   $ar_monChuaQua = $theStudent->get_Subjects_ChuaQua();// aray các môn chưa qua
   $idStudent = $theStudent->getStudentID();// mã sinh viên
   $studentName = $theStudent->getName();// tên sinh viên
   $soTcTichLuy = $theStudent->get_TotalTinChi();// số tín chỉ không tính môn điều kiện
   $soTcHoclai = Student::CountNumTinChi($theStudent->get_Subjects_DaHocLai());// số tín chỉ đã học lại
}
?>
<html>    
    <head>
        <meta charset="UTF-8">
        <title>Trang kết quả - beta</title>
        <style>
            div{
                alignment-adjust: auto;
                background: #cccccc;
                margin-left: auto;
                float: top;
                padding-left: 30px;
                padding-right: 30px;
                padding-bottom: 5px;
                padding-top: 15px;
            }
            .kq{
                color: #ffffff;
            }
            .kqr{
                color:#000000;
                background: #499249;
                font-weight: bold;
                font-size: 38px;                              
            }
        </style>      
            
    </head>
    
    <body>
        <div>
            Chào Bạn: <?php echo $theStudent->getName();?> <br>
            Mã sinh viên: <?php echo $theStudent->getStudentID();?> <br>
            Khóa : <?php echo $theStudent->getKhoa();?> <br>
            Lớp: <?php echo $theStudent->getLop();?> <br>
            <form action="../../index.php" method="POST">chức năng nhập thông tin bằng tay này chưa viết
                <input type=submit value="Nhập/sửa thông tin" />
            </form>   
             <p>Lưu ý trang đang trong quá trình phát triển và thử nghiệm nên với một số bạn mà QLDT nhập thiếu điểm có thể kết quả sẽ không đúng </p>
            <h1 align="center">Thông tin học tập ngắn ngọn của bạn được trang đọc được như sau: </h1>
           
        </div>
        <table cellspacing ="0" style="margin: auto; font-size:20px; margin: auto; border: 0px; float: inside;">
            <tr class="kqr">
                <td> Tích lũy hệ số 4: </td><td class ="kq"><?php echo $trungbinhH4;?></td>
            </tr>
            <tr class="kqr" style="background: #0033ff; ">
                <td style="color: #999999">Trung bình hệ 10: </td><td class="kq"><?php echo $trungbinhH10; ?></td>
            </tr>  
            <tr>                
                <td>Tổng số tín chỉ tích lũy: </td><td class="tc"><?php echo $soTcTichLuy; ?></td>                
            </tr>   
            <tr>
                <td>Số tín chỉ đã học lại: </td><td class="tc"><?php echo $soTcHoclai; ?></td>
            </tr>
            <tr>
                <td colspan="2">
<!--                    <hr/>
                    <ul>
                    <?php                    
//                    foreach ($theStudent->getAllSubjecs() as $subj) {
//                        echo "<li>".$subj->getName()." : ";                         
//                        foreach ($subj->getPoints() as $p)
//                        {
//                             echo "(";
//                            echo $p;
//                             echo ")";
//                        }
//                       
//                        echo "</li>";
//                    }
                    ?>
                    </ul>-->
                    <hr/>
                    <p style="color: #0033cc"> Các môn có thể nâng điểm : </p>
                    <ul>
                        <?php                        
                        foreach ($ar_monCoTheNangDiem as $monHoc) {
                            echo '<li>'.$monHoc->getName().'</li>';
                        }
                        ?>
                    </ul>
                    <hr/>
                    Các môn còn nợ: <?php  echo Student::CountNumTinChi($ar_monChuaQua).'(tín chỉ)';?>
                    <ul>
                        <?php                        
                        foreach ($ar_monChuaQua as $monHoc) {
                            echo '<li>'.$monHoc->getName().': '.$monHoc->get_CurrentPoint()->get_DiemKt().'</li>';
                            
                        }
                        ?>
                    </ul>
                </td>
            </tr>
        </table>
    </body>
</html>
