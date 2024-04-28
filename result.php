<?php
error_reporting(0);
include('includes/config.php');
session_start();
if  (!isset($_SESSION['user_email']))
{
    header('location:student-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Result Management System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
    <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
    <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
    <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
    <link rel="stylesheet" href="css/prism/prism.css" media="screen">
    <link rel="stylesheet" href="css/main.css" media="screen">
    <link rel="stylesheet" href="css/resulttable.css" media="screen">

    <script src="js/modernizr/modernizr.min.js"></script>
</head>

<body>
    <div class="main-wrapper">
        <div class="content-wrapper">
            <div class="content-container">

<div class="main-wrapper">
            <?php include('includes/st_topbar.php'); ?>
            <div class="content-wrapper">
                <div class="content-container">

                    <?php include('includes/st_leftbar.php'); ?>

                    <div class="main-page">
                        <div class="container-fluid">
                            <div class="row page-title-div">
                                <div class="col-sm-6">
                                    <h2 class="title">Result</h2>

                                </div>
                                <!-- /.col-sm-6 -->
                            </div>
                            <section class="section" id="exampl">
                        <div class="container-fluid">

                            <div class="row">



                                <div class="col-md-8 col-md-offset-2">
                                    <div class="panel">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <h3 align="center"><b>Shree Aadarsha Higher Secondary School</b></h3>
                                                <p align="center">Malarani-03,Arghakhanchi
                                                          <br>Lumbini,Nepal
                                                           <br>Estd. 2008
                                                </p>
                                                <hr>
                                                <?php
                                                // code Student Data
                                                $roll_number = $_POST['roll_number'];
                                                $class = $_POST['class'];
                                                $_SESSION['roll_number'] = $roll_number;
                                                $_SESSION['class'] = $class;
                                                $qery = "SELECT student.first_name,student.middle_name,student.last_name,student.date_of_birth,student.address,student.roll_number,student.registered_date,student.StudentId,student.Status,tblclasses.ClassName,tblclasses.Section from student join tblclasses on tblclasses.id=student.class where student.roll_number=:roll_number and student.class=:class";
                                                $stmt = $dbh->prepare($qery);
                                                $stmt->bindParam(':roll_number', $roll_number, PDO::PARAM_STR);
                                                $stmt->bindParam(':class', $class, PDO::PARAM_STR);
                                                $stmt->execute();
                                                $resultss = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                $cnt = 1;
                                                if ($stmt->rowCount() > 0) {
                                                    foreach ($resultss as $row) {   ?>
                                                        <p><b>Student Name :</b> <?php echo htmlentities($row->first_name); ?> <?php echo htmlentities($row->middle_name); ?> <?php echo htmlentities($row->last_name); ?></p>
                                                        <p><b>Student Roll Number :</b> <?php echo htmlentities($row->roll_number); ?>
                                                        <p><b>Student Class:</b> <?php echo htmlentities($row->ClassName); ?>(<?php echo htmlentities($row->Section); ?>)
                                                        <p><b>Date Of Birth :</b> <?php echo htmlentities($row->date_of_birth); ?>
                                                        <p><b>Address :</b> <?php echo htmlentities($row->address); ?>
                                                        <?php }

                                                        ?>
                                            </div>
                                            <div class="panel-body p-20">







                                                <table class="table table-hover table-bordered" border="1" width="100%">
                                                    <thead>
                                                        <tr style="text-align: center">
                                                            <th style="text-align: center">S.N</th>
                                                            <th style="text-align: center"> Subject</th>
                                                            <th style="text-align: center">Marks</th>
                                                        </tr>
                                                    </thead>




                                                    <tbody>
                                                        <?php
                                                        // Code for result
                                                        $query = "select t.first_name,t.middle_name,t.last_name,t.roll_number,t.class,t.marks,SubjectId,tblsubjects.SubjectName from (select sts.first_name,sts.middle_name,sts.last_name,sts.roll_number,sts.class,tr.marks,SubjectId from student as sts join  tblresult as tr on tr.StudentId=sts.StudentId) as t join tblsubjects on tblsubjects.id=t.SubjectId where (t.roll_number=:roll_number and t.class=:class)";
                                                        $query = $dbh->prepare($query);
                                                        $query->bindParam(':roll_number', $roll_number, PDO::PARAM_STR);
                                                        $query->bindParam(':class', $class, PDO::PARAM_STR);
                                                        $query->execute();
                                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                                        $cnt = 1;
                                                        if ($countrow = $query->rowCount() > 0) {
                                                            foreach ($results as $result) {

                                                        ?>

                                                                <tr>
                                                                    <th scope="row" style="text-align: center"><?php echo htmlentities($cnt); ?></th>
                                                                    <td style="text-align: center"><?php echo htmlentities($result->SubjectName); ?></td>
                                                                    <td style="text-align: center"><?php echo htmlentities($totalmarks = $result->marks); ?></td>
                                                                </tr>
                                                            <?php
                                                                $totlcount += $totalmarks;
                                                                $cnt++;
                                                            }
                                                            ?>
                                                            <tr>
                                                                <th scope="row" colspan="2" style="text-align: center">Total Marks</th>
                                                                <td style="text-align: center"><b><?php echo htmlentities($totlcount); ?></b> out of <b><?php echo htmlentities($outof = ($cnt - 1) * 100); ?></b></td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="row" colspan="2" style="text-align: center">Percntage</th>
                                                                <td style="text-align: center"><b><?php echo  htmlentities($totlcount * (100) / $outof); ?> %</b></td>
                                                            </tr>

                                                            <tr>

                                                                <td colspan="3" align="center"><i class="fa fa-print fa-2x" aria-hidden="true" style="cursor:pointer" OnClick="CallPrint(this.value)"></i></td>
                                                            </tr>

                                                        <?php } else { ?>
                                                            <div class="alert alert-warning left-icon-alert" role="alert">
                                                                <strong>Notice!</strong> Your result not declare yet
                                                            <?php }
                                                            ?>
                                                            </div>
                                                        <?php
                                                    } else { ?>

                                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                                strong>Oh snap!</strong>
                                                            <?php
                                                            echo htmlentities("Invalid Roll Id");
                                                        }
                                                            ?>
                                                            </div>



                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-md-6 -->

                                    

                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->
                    </section>
                    
                        </div>
                <!-- /.left-sidebar -->
                

                
                <!-- /.main-page -->


            </div>
            <!-- /.content-container -->
        </div>
        <!-- /.content-wrapper -->

    </div>
    <!-- /.main-wrapper -->

    <!-- ========== COMMON JS FILES ========== -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/pace/pace.min.js"></script>
    <script src="js/lobipanel/lobipanel.min.js"></script>
    <script src="js/iscroll/iscroll.js"></script>

    <!-- ========== PAGE JS FILES ========== -->
    <script src="js/prism/prism.js"></script>

    <!-- ========== THEME JS ========== -->
    <script src="js/main.js"></script>
    <script>
        $(function($) {

        });


        function CallPrint(strid) {
            var prtContent = document.getElementById("exampl");
            var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        }
    </script>

    </script>

    <!-- ========== ADD custom.js FILE BELOW WITH YOUR CHANGES ========== -->

</body>

</html>