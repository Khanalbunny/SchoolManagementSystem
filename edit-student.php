<?php
error_reporting(0);
include('includes/config.php');
session_start();
if (!isset($_SESSION['alogin'])) {
    header('location:admin-login.php');
}
$msg = '';
$error = '';


$stid = intval($_GET['stid']);

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $roll_number = $_POST['roll_number'];
    $class = $_POST['class'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    $sql = "UPDATE student SET 
        first_name = :first_name,
        middle_name = :middle_name,
        last_name = :last_name,
        roll_number = :roll_number,
        gender = :gender,
        date_of_birth = :date_of_birth,
        phone = :phone,
        email = :email,
        address = :address,
        Status = :status
    WHERE StudentId = :stid";


    $query = $dbh->prepare($sql);
    $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
    $query->bindParam(':middle_name', $middle_name, PDO::PARAM_STR);
    $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
    $query->bindParam(':roll_number', $roll_number, PDO::PARAM_STR);
    $query->bindParam(':gender', $gender, PDO::PARAM_STR);
    $query->bindParam(':date_of_birth', $date_of_birth, PDO::PARAM_STR);
    $query->bindParam(':phone', $phone, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':address', $address, PDO::PARAM_STR);
    $query->bindParam(':status', $status, PDO::PARAM_STR);
    $query->bindParam(':stid', $stid, PDO::PARAM_INT);
    $query->execute();
    $msg = "Student info updated successfully";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Admin| Edit Student < </title>
            <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
            <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
            <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
            <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
            <link rel="stylesheet" href="css/prism/prism.css" media="screen">
            <link rel="stylesheet" href="css/select2/select2.min.css">
            <link rel="stylesheet" href="css/main.css" media="screen">
            <script src="js/modernizr/modernizr.min.js"></script>
</head>

<body class="top-navbar-fixed">
    <div class="main-wrapper">

        <!-- ========== TOP NAVBAR ========== -->
        <?php include('includes/topbar.php'); ?>
        <!-- ========== WRAPPER FOR BOTH SIDEBARS & MAIN CONTENT ========== -->
        <div class="content-wrapper">
            <div class="content-container">

                <!-- ========== LEFT SIDEBAR ========== -->
                <?php include('includes/leftbar.php'); ?>
                <!-- /.left-sidebar -->

                <div class="main-page">

                    <div class="container-fluid">
                        <div class="row page-title-div">
                            <div class="col-md-6">
                                <h2 class="title">Student Admission</h2>

                            </div>

                            <!-- /.col-md-6 text-right -->
                        </div>
                        <!-- /.row -->
                        <div class="row breadcrumb-div">
                            <div class="col-md-6">
                                <ul class="breadcrumb">
                                    <li><a href="dashboard.php"><i class="fa fa-home"></i> Home</a></li>

                                    <li class="active">Student Admission</li>
                                </ul>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="container-fluid">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <div class="panel-title">
                                            <h5>Fill the Student info</h5>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <?php if ($msg) { ?>
                                            <div class="alert alert-success left-icon-alert" role="alert">
                                                <strong>Well done!</strong><?php echo htmlentities($msg); ?>
                                            </div><?php } else if ($error) { ?>
                                            <div class="alert alert-danger left-icon-alert" role="alert">
                                                <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
                                            </div>
                                        <?php } ?>
                                        <form class="form-horizontal" method="post">
                                            <?php

                                            $sql = "SELECT student.first_name,student.middle_name,student.last_name,student.roll_number,student.class,student.gender,student.date_of_birth,student.phone,student.email,student.address,student.registered_date,student.Status,tblclasses.Section,tblclasses.ClassNameNumeric,tblclasses.ClassName from student join tblclasses on tblclasses.id=student.class where student.StudentId=:stid";

                                            $query = $dbh->prepare($sql);
                                            $query->bindParam(':stid', $stid, PDO::PARAM_STR);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt = 1;
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) {  ?>


                                                    < <div class="form-group">
                                                        <label for="default" class="col-sm-2 control-label">First Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo htmlentities($result->first_name) ?>" required="required" autocomplete="off">
                                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Middle Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="middle_name" class="form-control" id="middle_name" autocomplete="off" value="<?php echo htmlentities($result->middle_name) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="last_name" class="form-control" id="last_name" required="required" autocomplete="off" value="<?php echo htmlentities($result->last_name) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Roll Id</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="roll_number" class="form-control" id="roll_number" maxlength="5" required="required" autocomplete="off" value="<?php echo htmlentities($result->roll_number) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Gender</label>
                                        <div class="col-sm-10">
                                            <?php $gndr = $result->gender;
                                                    if ($gndr == "Male") {
                                            ?>
                                                <input type="radio" name="gender" value="Male" required="required" checked>Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required">Other
                                            <?php } ?>
                                            <?php
                                                    if ($gndr == "Female") {
                                            ?>
                                                <input type="radio" name="gender" value="Male" required="required">Male <input type="radio" name="gender" value="Female" required="required" checked>Female <input type="radio" name="gender" value="Other" required="required">Other
                                            <?php } ?>
                                            <?php
                                                    if ($gndr == "Other") {
                                            ?>
                                                <input type="radio" name="gender" value="Male" required="required">Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required" checked>Other
                                            <?php } ?>


                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="email" required="required" value="<?php echo htmlentities($result->email) ?>">
                                        </div>
                                    </div>





                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Address</label>
                                        <div class="col-sm-10">
                                            <input type="textarea" name="address" class="form-control" id="address" required="required" autocomplete="off" value="<?php echo htmlentities($result->address) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <input type="number" name="phone" class="form-control" id="phone" required="required" autocomplete="off" value="<?php echo htmlentities($result->phone) ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date" class="col-sm-2 control-label">DOB</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" value="<?php echo htmlentities($result->date_of_birth) ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="default" class="col-sm-2 control-label">Class</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="class" class="form-control" id="class" value="<?php echo htmlentities($result->ClassNameNumeric) ?>(<?php echo htmlentities($result->Section) ?>)" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Reg Date: </label>
                                            <div class="col-sm-10">
                                                <?php echo htmlentities($result->registered_date) ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="default" class="col-sm-2 control-label">Status</label>
                                            <div class="col-sm-10">
                                                <?php $stats = $result->Status;
                                                    if ($stats == "1") {
                                                ?>
                                                    <input type="radio" name="status" value="1" required="required" checked>Active <input type="radio" name="status" value="0" required="required">Block
                                                <?php } ?>
                                                <?php
                                                    if ($stats == "0") {
                                                ?>
                                                    <input type="radio" name="status" value="1" required="required">Active <input type="radio" name="status" value="0" required="required" checked>Block
                                                <?php } ?>



                                            </div>
                                        </div>

                                <?php }
                                            } ?>


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                </form>

                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-12 -->
                        </div>
                    </div>
                </div>
                <!-- /.content-container -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!-- /.main-wrapper -->
        <script src="js/jquery/jquery-2.2.4.min.js"></script>
        <script src="js/bootstrap/bootstrap.min.js"></script>
        <script src="js/pace/pace.min.js"></script>
        <script src="js/lobipanel/lobipanel.min.js"></script>
        <script src="js/iscroll/iscroll.js"></script>
        <script src="js/prism/prism.js"></script>
        <script src="js/select2/select2.min.js"></script>
        <script src="js/main.js"></script>
        <script>
            $(function($) {
                $(".js-states").select2();
                $(".js-states-limit").select2({
                    maximumSelectionLength: 2
                });
                $(".js-states-hide").select2({
                    minimumResultsForSearch: Infinity
                });
            });
        </script>
</body>

</html>