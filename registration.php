<?php
// Database connection settings
$db_host = 'localhost'; // Your database host (e.g., localhost)
$db_user = 'root'; // Your database username
$db_password = ''; // Your database password
$db_name = 'srms'; // Your database name

try {
    // Create a PDO database connection
    $dbh = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get student information from the form
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $roll_number = $_POST['roll_number'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $class = $_POST['class'];
        $date_of_birth = $_POST['dob'];

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $hashed_password = md5($password);
        $hashed_confirm_password = md5($confirm_password);

        $status = 1;

        if ($_POST['password'] !== $_POST['confirm_password']) {
            echo '<script>alert("Password and Confirm Password Doesnot Match")</script>';
            exit; // Exit the script if they don't match
        }
        $target_dir = "profile/";
        $target_file = $target_dir . basename($_FILES["image_path"]["name"]);

        if (move_uploaded_file($_FILES["image_path"]["tmp_name"], $target_file)) {
            // Insert student data into the database using a prepared statement
            $sql = "INSERT INTO student (first_name, middle_name, last_name, roll_number, email, gender, class, date_of_birth, address, phone, image_path, password, confirm_password,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";

            $stmt = $dbh->prepare($sql);
            $stmt->execute([$first_name, $middle_name, $last_name, $roll_number, $email, $gender, $class, $date_of_birth, $address, $phone, $target_file, $hashed_password, $hashed_confirm_password, $status]);

            echo "Registration Successful!";
            

        } else {
            echo "Error uploading the image.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Student Registration< </title>
            <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
            <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
            <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
            <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
            <link rel="stylesheet" href="css/prism/prism.css" media="screen">
            <link rel="stylesheet" href="css/select2/select2.min.css">
            <link rel="stylesheet" href="css/main.css" media="screen">
            <script src="js/modernizr/modernizr.min.js"></script>
            <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/principal.css" rel="stylesheet" />
    <link  href="css/footer.css" media="screen"rel="stylesheet" >
    <link rel="stylesheet" href="css/contact.css">
</head>

<body class="top-navbar-fixed">
<?php
    include('navbar.php');
    ?>
    <div class="main-wrapper">



        <div class="jjj">

            <div class="container-fluid">
                <div class="row page-title-div">
                    <div class="col-md-6">
                        <h2 class="title">Student Admission</h2>

                    </div>

                    <!-- /.col-md-6 text-right -->
                </div>
                <!-- /.row -->


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

                            <form class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validatePhoneNumber();" onsubmit="return validate();"  >

                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">First Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="first_name" class="form-control" id="first_name" required="required" autocomplete="off" placeholder="Enter first name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Middle Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="middle_name" class="form-control" id="middle_name" autocomplete="off" placeholder="Enter middle name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Last Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="last_name"  class="form-control" id="last_name" required="required" autocomplete="off" placeholder="Enter last name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Roll Id</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="roll_number" class="form-control" id="roll_number" maxlength="5" required="required" autocomplete="off" placeholder="Enter roll number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Email Id</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" class="form-control" id="email" required="required" placeholder="Enter email">
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Gender</label>
                                    <div class="col-sm-10">
                                        <input type="radio" name="gender" value="Male" required="required" checked="">Male <input type="radio" name="gender" value="Female" required="required">Female <input type="radio" name="gender" value="Other" required="required">Other
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Address</label>
                                    <div class="col-sm-10">
                                        <input type="textarea" name="address" class="form-control" id="address" required="required" autocomplete="off" placeholder="Enter address">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="phone" class="form-control" id="phone" required="required" autocomplete="off" placeholder="Enter phone number" maxlength="10">
                                        <span id="phone-error" style="color: red;"></span>
                                        <small>*Phone number must be 10 digits.</small>


                                    </div>
                                </div>




                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Class</label>
                                    <div class="col-sm-10">
                                        <select name="class" class="form-control" id="default" required="required">
                                            <option value="">Select Class</option>
                                            <?php $sql = "SELECT * from tblclasses";
                                            $query = $dbh->prepare($sql);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { ?>
                                                    <option value="<?php echo htmlentities($result->id); ?>"><?php echo htmlentities($result->ClassName); ?>&nbsp;
                                                        Section-<?php echo htmlentities($result->Section); ?>
                                                    </option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>






                                <div class="form-group">
                                    <label for="date" class="col-sm-2 control-label">DOB</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="dob" class="form-control" id="date">
                                    </div>
                                </div>





                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Profile</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image_path" class="form-control" id="image_path" required="required">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" required="required" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                                    <small>*Password must contain at least 8 characters,</small>
                                    <small>including at least one uppercase,lowercase letter, number, and special character: @$!%*?&.</small>
                                    
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="default" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Enter confirm password" required="required" pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$">
                                        <!-- title="Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one special character: @$!%*?&"-->

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" name="submit" id="submit" class="btn btn-primary">Register</button>

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
    <script src="js/namevalidation.js"></script>

    <script src="js/phonevalidation.js"></script>

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


<?php
    include('footer.php');
    ?>

</body>

</html>