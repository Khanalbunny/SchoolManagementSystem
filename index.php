<?php
error_reporting(0);
include('includes/config.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>




    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Academic Result View Management System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />

    <link rel="stylesheet" href="css/bootstrap.min.css" media="screen">
            <link rel="stylesheet" href="css/font-awesome.min.css" media="screen">
            <link rel="stylesheet" href="css/animate-css/animate.min.css" media="screen">
            <link rel="stylesheet" href="css/lobipanel/lobipanel.min.css" media="screen">
            <link rel="stylesheet" href="css/prism/prism.css" media="screen">
            <link rel="stylesheet" href="css/select2/select2.min.css">
            <link rel="stylesheet" href="css/main.css" media="screen">
            <script src="js/modernizr/modernizr.min.js"></script>
            <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
            <script src="js/modernizr/modernizr.min.js"></script>

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/principal.css" rel="stylesheet" />
    <link rel="stylesheet" href="footer.css" media="screen" >
    <link  href="css/contact.css" rel="stylesheet">

</head>

<body>
    <!-- Responsive navbar-->
    <?php
    include('navbar.php');
    ?>
    <!-- Header - set the background image for the header in the line below-->
    <header class="py-5 bg-image-full" style="background-image: url('images/background-image.jpg')">

    </header>
    <!-- Content section-->
    <section class="principal-message">
        <h2>Message From the Principal</h2>
        <div class="principal-info">
            <img src="principal.jpg" alt="Principal's Photo">
            
            <div class="principal-text">
                <p>Dear Students / Parents and Guardians,

                It’s my great pleasure to introduce Shree Adarsha Secondary School Buddhashanti- 2 Jayapur as a well-recognized community school of Jhapa. It was founded in 2017 B.S and has managed to stand out among a group of high-quality education providers in the country.

                This school, which is always motivated by a noble vision, aspires to make a significant contribution to nation-building. This school has provided time-tested instruction to all of its pupils since the beginning of its existence. It provides a vast array of options, both within and outside of our taught curriculum. This is a proven school with a positive attitude and a belief that anything is possible. We believe in learning by doing in our school. The practical part of schooling is very important to us. All of the faculty as well as teaching members are always striving with their hearts and thoughts to generate virtue in various aspects of life. In addition, we are running technical courses to enhance student’s knowledge towards modern development in science and technology.

                In the coming years, this school hopes to grow and reach a broader segment of the population. Our primary focus and dedication will always be on providing high-quality education. That is our pledge to everyone.</p>
            </div>
        </div>
        <h3>Bhesh Raj Khanal</h3>
    </section>


    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "srms";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare and execute the SQL INSERT query
    $sql = "INSERT INTO contact_submissions (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Thank you for your submission!";
    } else {
        // Error in inserting data
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>


    <header>
        <h1>Contact Us</h1>
    </header>
    <main>
        <section class="contact-form">
            <h2>Contact Information</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>

                <button type="submit">Submit</button>
            </form>
        </section>

    </main>






    <!-- <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img src="scll.png" alt="School Logo">
            </div>
            <div class="footer-contact">
                <h4>Contact Information</h4>
                <p>Khanadaha Arghakhanchi</p>
                <p>Arghakhanchi, Lumbini, 32941</p>
                <p>Contact No: +077 420-780</p>
                <p>Email: info@aadarshamavi.com</p>
            </div>
            <div class="site-footer-primary-section-2 site-footer-section site-footer-section-2">
                <aside class="footer-widget-area widget-area site-footer-focus-item" data-section="sidebar-widgets-footer-widget-2" aria-label="Footer Widget 2">
                    <div class="footer-widget-area-inner site-info-inner">
                        <section id="block-5" class="widget widget_block">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3563.8169625859027!2d88.02043871699614!3d26.718293848051253!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e5b765f179c667%3A0x52b3ade51168663c!2sadarsha%20higher%20secondary%20school%20budhabare%204%20jayapur%20Jhapa!5e0!3m2!1sen!2snp!4v1646738286807!5m2!1sen!2snp" width="350" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </section>
                    </div>
                </aside>
            </div>
        </div>
    </footer> -->

    <!-- Footer-->
    <!-- <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Student Result Management System <php echo date('Y'); ?></p>
        </div>
    </footer> -->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
<?php
include('footer.php');
?>
</body>

</html>