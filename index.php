<!DOCTYPE html>
<html>
    <head>
        <title>Tinhdiem.com</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" href="img/favicon.png">        

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&subset=vietnamese' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />
        <!--[if IE 7]>
            <link rel="stylesheet" href="css/font-awesome-ie7.min.css">
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <link rel="stylesheet" type="text/css"  id="prettyphoto-css" href="css/prettyPhoto.css" media="all"/>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.localscroll-1.2.7-min.js"></script>        
        <script type="text/javascript" src="js/jquery.scrollTo-1.4.2-min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("a[rel^='prettyPhoto']").prettyPhoto();
            });
        </script>
    </head>
    <body>
        <!--********************* NAV BAR *********************-->
        <div class="navbar-wrapper">
            <div class="navbar navbar-inverse navbar-fixed-bottom">
                <div class="navbar-inner">
                    <div class="container">
                        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                            <i class="fa fa-bars"></i>
                        </a>
                        <h1 class="brand"><a href="#top">Tinhdiem.COM</a></h1>
                        <nav class="pull-right nav-collapse collapse">
                            <ul id="menu-main" class="nav">
                                <li><a title="Xem xếp hạng" href="#rank"><i class="fa fa-bar-chart-o"></i> Xem xếp hạng</a></li>
                                <li><a title="Hướng dẫn" href="#help"><i class="fa fa-rocket"></i> Hướng dẫn</a></li>
                                <li><a title="Download phần mềm" href="#download"><i class="fa fa-download"></i> Download</a></li>
                                <li><a title="FAQs" href="#faq"><i class="fa fa-question-circle"></i> FAQs</a></li>
                                <li><a title="Thành viên phát triển" href="#team">Team</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div id="top"></div>
        <?php require_once './views/input.php'; ?>
        <!-- ******************** About ********************-->
        <div class="scrollblock">
            <section id="about">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <article>
                                <p>Website <a href="#" title="tinhdiem.com">tinhdiem.com</a>
                                    ra đời với mục đích tạo ra công cụ tính toán điểm tích lũy nhanh cho sinh viên <span> ĐH GTVT.</span>
                                </p>
                                <p><img alt="utc-logo" src="img/utc-logo.png" width="75px" /></p>
                            </article>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <hr>
        <!-- ******************** Rank Section ********************-->
        <?php require_once './views/rank.php'; ?>
        <!-- ******************** Help Section ********************-->
        <?php require_once './views/help.php'; ?>
        <!-- ******************** Description Section ********************-->
        <section id="description" class="single-page hidden-phone">
            <div class="container">
                <div class="row">
                    <div class="blockquote-wrapper">
                        <blockquote class="mega">
                            <div class="span8">
                                <p class="cite">Website này được xây dựng bởi nhóm sinh viên khoa Công nghệ thông tin.</p>
                            </div>
                            <div class="span10">
                                <p class="alignright">Bạn cũng có thể sử dụng offline bằng cách tải về phần mềm.</p>
                            </div>
                        </blockquote>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <!-- ******************** Download Section ********************-->
        <?php require_once './views/download.php'; ?>
        <!-- ******************** FAQs Section ********************-->
        <?php require_once './views/faq.php'; ?>
        <!-- ******************** Team Section ********************-->
        <?php require_once './views/team.php'; ?>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
        <script type="text/javascript" src="js/site.js"></script>
    </body>
</html>