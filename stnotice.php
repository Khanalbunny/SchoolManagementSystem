<?php
error_reporting(0);
include('includes/config.php');
session_start();
if  (!isset($_SESSION['user_email']))
{
    header('location:student-login.php');
}
?>

    <head>
    <style>
        /* Notice container style */
        .notice {
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
        }

        /* Notice title style */
        .notice-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Notice content style */
        .notice-content {
            font-size: 16px;
        }
    </style>



        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student Result Management System | Dashboard</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
        <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
        <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
        <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
        <link rel="stylesheet" href="css/toastr/toastr.min.css" media="screen">
        <link rel="stylesheet" href="css/icheck/skins/line/blue.css">
        <link rel="stylesheet" href="css/icheck/skins/line/red.css">
        <link rel="stylesheet" href="css/icheck/skins/line/green.css">
        <link rel="stylesheet" href="css/main.css" media="screen">
        <script src="js/modernizr/modernizr.min.js"></script>
    </head>

    <body class="top-navbar-fixed">
        <div class="main-wrapper">
            <?php include('includes/st_topbar.php'); ?>
            <div class="content-wrapper">
                <div class="content-container">

                    <?php include('includes/st_leftbar.php'); ?>

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Notices</h2>
                                     
                                </div>
                                
                                <!-- /.col-sm-6 -->
                            </div>
                            <?php $sql = "SELECT * from tblnotice";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        $cnt = 1;
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {   ?>
                <a href="notice-details.php?nid=<?php echo htmlentities($result->id); ?>" target="_blank"> <div class="notice">
    <div class="notice-title">
        <?php echo htmlentities($result->noticeTitle); ?>
    </div>
    <div class="notice-content">
        <!-- Your notice content goes here -->
    </div>
</div>
        <?php }
        } ?>
                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->





                        <!-- /.dashboard-stat -->
                    </div>
                    <!-- /.col-lg-3 col-md-3 col-sm-6 col-xs-12 -->

                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            </section>
            <!-- /.section -->

        </div>

        
      

        
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>

        <!-- ========== PAGE JS FILES ========== -->
        <script src="js/prism/prism.js"></script>
        <script src="js/waypoint/waypoints.min.js"></script>
        <script src="js/counterUp/jquery.counterup.min.js"></script>
        <script src="js/amcharts/amcharts.js"></script>
        <script src="js/amcharts/serial.js"></script>
        <script src="js/amcharts/plugins/export/export.min.js"></script>
        <link rel="stylesheet" href="js/amcharts/plugins/export/export.css" type="text/css" media="all" />
        <script src="js/amcharts/themes/light.js"></script>
        <script src="js/toastr/toastr.min.js"></script>
        <script src="js/icheck/icheck.min.js"></script>

        <!-- ========== THEME JS ========== -->
        <script src="js/main.js"></script>
        <script src="js/production-chart.js"></script>
        <script src="js/traffic-chart.js"></script>
        <script src="js/task-list.js"></script>
    </body>
    
    </html

            