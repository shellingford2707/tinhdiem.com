<?php
include_once '../model/Student.php';

$strInput = $_POST['paste-data'];
if(isset($strInput))
{
   $theStudent = Student::ClipboardReader($strInput);   
   
   $trungbinhH10 = $theStudent->get_TrungBinhHe10();
   $ar_monCoTheNangDiem = $theStudent->get_Subjects_CoTheNangDiem();//mảng mon co the nang diem
   $ar_monChuaQua = $theStudent->get_Subjects_ChuaQua();// aray các môn chưa qua
   $ar_MonDaHocLai = $theStudent->get_Subjects_DaHocLai();
   $soTcDaHocLai = Student::CountNumTinChi($ar_MonDaHocLai);
   
   // các field cần trong CSDL:
   $studentName = $theStudent->getStudentName();// tên sv
   $studentID = $theStudent->getStudentID();// Mã sv
   $mark = $theStudent->getMark();// điểm tích lũy hệ 4
   $soTcHoclai = $theStudent->getCredit_miss();// số tc chưa qua
   $soTcTichLuy = $theStudent->getCredit_completed();// số tc hoàn thành
   $major = $theStudent->getMajor();// khoá 
   $className = $theStudent->getClassName();// Tên lớp học
   $faculty = $theStudent->getFaculty();// Khoa-viện (cái này nhập tay nên ở đây chưa có value thực)
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
            Chào Bạn: <?php echo $studentName;?> <br>
            Mã sinh viên: <?php echo $studentID;?> <br>
            Khóa : <?php echo $major;?> <br>
            Lớp: <?php echo $className;?> <br>
            Khoa - viện: <?php echo $faculty; ?><br>
            <form action="../../index.php" method="POST">chức năng nhập thông tin bằng tay này chưa viết
                <input type=submit value="Nhập/sửa thông tin" />
            </form>   
             <p>Lưu ý trang đang trong quá trình phát triển và thử nghiệm nên với một số bạn mà QLDT nhập thiếu điểm có thể kết quả sẽ không đúng </p>
            <h1 align="center">Thông tin học tập ngắn ngọn của bạn được trang đọc được như sau: </h1>
           
        </div>
        <table cellspacing ="0" style="margin: auto; font-size:20px; margin: auto; border: 0px; float: inside;">
            <tr class="kqr">
                <td> Tích lũy hệ số 4: </td><td class ="kq"><?php echo $mark;?></td>
            </tr>
            <tr class="kqr" style="background: #0033ff; ">
                <td style="color: #999999">Trung bình hệ 10: </td><td class="kq"><?php echo $trungbinhH10; ?></td>
            </tr>  
            <tr>                
                <td>Tổng số tín chỉ tích lũy: </td><td class="tc"><?php echo $soTcTichLuy; ?></td>                
            </tr>   
            <tr>
                <td>Số tín chỉ đã học lại: </td><td class="tc"><?php echo $soTcDaHocLai; ?></td>
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
