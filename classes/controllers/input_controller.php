<?php
include_once '../model/Student.php';

$strInput = $_POST['pasteData'];
$major = $_POST['major'];

if ((isset($strInput) && !empty($strInput)) && (isset($major) && $major > 0)) {
    $stu = Student::ClipboardReader($strInput);

    $trungbinhH10 = $stu->get_TrungBinhHe10();
    $ar_monCoTheNangDiem = $stu->get_Subjects_CoTheNangDiem(); //mảng mon co the nang diem
    $ar_monChuaQua = $stu->get_Subjects_ChuaQua(); // aray các môn chưa qua
    $ar_MonDaHocLai = $stu->get_Subjects_DaHocLai();
    $soTcDaHocLai = Student::CountNumTinChi($ar_MonDaHocLai);

    // các field cần trong CSDL:
    $studentName = $stu->getStudentName(); // tên sv
    $studentID = $stu->getStudentID(); // Mã sv
    $mark = $stu->getMark(); // điểm tích lũy hệ 4
    $soTcHoclai = $stu->getCredit_miss(); // số tc chưa qua
    $soTcTichLuy = $stu->getCredit_completed(); // số tc hoàn thành
    $grade = $stu->getGrade(); // khoá 
    $className = $stu->getClassName(); // Tên lớp học
    $stu->setGrade($major); // Khoa-viện (cái này nhập tay nên ở đây chưa có value thực)


    $color = "#C40000"; // màu hiển thị theo điểm
    $icon = "<i class='fa fa-exclamation-triangle'></i>"; // icon hiển thị theo điểm
    if ($mark >= 3.60) {
        $color = "#016E09";
        $icon = "<i class='fa fa-trophy'></i>";
    }
    if (3.20 <= $mark && $mark <= 3.59) {
        $color = "#6AAE3B";
        $icon = "<i class='fa fa-thumbs-up'></i>";
    }
    if (2.50 <= $mark && $mark <= 3.19) {
        $color = "#CBB104";
        $icon = "<i class='fa fa-smile-o'></i>";
    }
    if (2.00 <= $mark && $mark <= 2.49) {
        $color = "#D87500";
        $icon = "<i class='fa fa-frown-o'></i>";
    }
} else {
    // redirect sang trang index nếu user cố tình không nhập
    header('location: ./');
}
?>
<html>    
    <head>
        <title>Kết quả của <?php echo $studentName; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="./img/favicon.png">

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&subset=vietnamese' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="./css/font-awesome.min.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.css" />
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <link rel="stylesheet" type="text/css" href="./css/bootstrap-responsive.css" />
        <script type="text/javascript" src="./js/jquery.js"></script>
        <script type="text/javascript" src="./js/jquery.localscroll-1.2.7-min.js"></script>        
        <script type="text/javascript" src="./js/jquery.scrollTo-1.4.2-min.js"></script>
    </head>    
    <body>
        <!--********************* NAV BAR *********************-->
        <div class="navbar-wrapper">
            <div class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                        <h1 class="brand"><a href="./">Tinhdiem.COM</a></h1>
                        <nav class="pull-right nav-collapse collapse">
                            <ul id="menu-main" class="nav">
                                <li><a title="Kết quả" href="#result"><i class="fa fa-trophy"></i> Kết quả</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section id="results" class="single-page">
            <div class="container">
                <div class="align" style="color: <?php echo $color; ?>"><?php echo $icon; ?></div>
                <h1 style="color: <?php echo $color; ?>"><?php echo $mark; ?></h1>
                <div class="row">
                    <div class="span6">
                        <div class="pull-right">
                            <ul>
                                <li>Xin chào <span><?php echo $studentName; ?></span></li>
                                <li>
                                    <span>MSV của bạn: </span><?php echo $studentID; ?> 
                                </li>
                                <li>
                                    <span>Bạn học lớp: </span><?php echo $className; ?> K<?php echo $grade; ?>
                                </li>
                                <li>
                                    <span>Khoa (Viện): </span><?php echo $major; ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="span6">
                        <p class="header">Thông tin học tập của bạn</p>
                        <div class="well">
                            <ul>
                                <li>
                                    <span>Điểm tích lũy hệ số 4:</span> <?php echo $mark; ?>
                                </li>
                                <li>
                                    <span>Điểm trung bình hệ 10:</span> <?php echo $trungbinhH10; ?>
                                </li>
                                <li>
                                    <span>Xếp loại:</span> <font style="color: <?php echo $color; ?>" ><?php echo $stu->getSort(); ?></font>
                                </li>
                                <li>
                                    <span>Tổng số tín chỉ tích lũy:</span> <?php echo $soTcTichLuy; ?>
                                </li>
                                <li>
                                    <span>Số tín chỉ đã học lại:</span> <?php echo $soTcDaHocLai; ?>
                                </li>
                            </ul>    
                        </div>
                    </div>                    
                    <p class="note">Trang đang trong quá trình phát triển và thử nghiệm nên đối với một số bạn, QLDT nhập thiếu điểm có thể kết quả sẽ không đúng </p>
                    <div class="row span12 offset1">
                        <ul id="pallete">
                            <li id="excellent">Xuất sắc</li>
                            <li id="good">Giỏi</li>
                            <li id="normal">Khá</li>
                            <li id="bad">Trung bình</li>
                            <li id="verybad">Không đủ ĐK</li>
                        </ul>
                    </div>
                </div>
                <div class="row well">
                    <div class="span5">                        
                        <p class="header">Các môn có thể nâng điểm</p>
                        <ul class="subject">
                            <?php
                            foreach ($ar_monCoTheNangDiem as $monHoc) {
                                echo '<li>' . $monHoc->getName() . ' - ' . $monHoc->getNumTc() . ' TC - ' . $monHoc->get_CurrentPoint()->get_DiemChu() . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="span5 offset1">                        
                        <p class="header">Các môn còn nợ (<?php echo Student::CountNumTinChi($ar_monChuaQua); ?> tín chỉ)</p>
                        <ul class="subject">
                            <?php
                            foreach ($ar_monCoTheNangDiem as $monHoc) {
                                echo '<li>' . $monHoc->getName() . ' - ' . $monHoc->getNumTc() . ' TC - ' . $monHoc->get_CurrentPoint()->get_DiemChu() . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>
