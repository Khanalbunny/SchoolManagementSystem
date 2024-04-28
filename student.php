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
        <link rel="stylesheet" href="css/student-details.css" media="screen">

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
                                    <h2 class="title">Dashboard</h2>

                                </div>
                                <!-- /.col-sm-6 -->
                            </div>
                            <!-- /.row -->
                            <!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
   
</head>
<body>
    <h1>Your Information</h1>

    <?php
    // Start a session to manage user authentication
    session_start();

    // Check if the user is logged in
    if (!isset($_SESSION['user_email'])) {
        // Redirect to the login page if not logged in
        header("Location: student-login.php"); // Replace with your login page URL
        exit();
    }

    // Include the database connection code (replace with your database credentials)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "srms";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the logged-in student's information
    $email = $_SESSION['user_email'];

    // Use single quotes around the email address in the SQL query
    $sql = "SELECT student.StudentId,student.first_name,student.middle_name,student.last_name,student.roll_number,student.image_path,student.class,student.gender,student.date_of_birth,student.phone,student.email,student.address,student.registered_date,student.Status,tblclasses.ClassName,tblclasses.ClassNameNumeric,tblclasses.Section from student join tblclasses on tblclasses.id=student.class where email = '$email'";
    $result = $conn->query($sql);

    echo "<table>";
    echo "<tr><th>Section</th><th>Your Data</th></tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
           echo "<tr>";
            echo "<td><strong>Profile Image:</strong></td><td><img src='" . $row['image_path'] . "' alt='Profile Image' class='profile-image'></td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Student Name:</strong></td><td>" . $row['first_name']  . " " . $row['middle_name'] . " " . $row['last_name'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Roll Number:</strong></td><td>" . $row['roll_number'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Email:</strong></td><td>" . $row['email'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Gender:</strong></td><td>" . $row['gender'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Class:</strong></td><td>" . $row['ClassNameNumeric'] ." ". "(" .$row['Section'].")". "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Date of Birth:</strong></td><td>" . $row['date_of_birth'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Address:</strong></td><td>" . $row['address'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Phone Number:</strong></td><td>" . $row['phone'] . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td><strong>Registered Date:</strong></td><td>" . $row['registered_date'] . "</td>";
            echo "</tr>";

            // You can add more fields here as needed
        }
    } else {
        echo "<tr><td colspan='2'>Student information not found.</td></tr>";
    }

    echo "</table>";

    // Close the database connection
    $conn->close();
    ?>

</body>
</html>



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
        <!-- /.main-page -->


        <!-- /.main-wrapper -->

        <!-- ========== COMMON JS FILES ========== -->
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
        <script>
            $(function() {

                // Counter for dashboard stats
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });

                // Welcome notification
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
                toastr["success"]("Welcome to student Result Management System!");

            });
        </script>

    </body>

    </html>
