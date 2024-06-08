<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectmeteor";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the destination ID from the URL query parameter
$destination_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch destination details
$sql = "SELECT * FROM popular_destination WHERE id = ? AND status = TRUE";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $destination_id);
$stmt->execute();
$result = $stmt->get_result();

$destination = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Destination Details | tourism_management</title>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/hover-min.css" rel="stylesheet"/>
    <link href="css/main.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <!-- HEADER SECTION STARTS -->
        <div class="header">
            <?php
            if (!isset($_SESSION["username"])) {
                include("common/headerTransparentLoggedOut.php");
            } else {
                include("common/headerTransparentLoggedIn.php");
            }
            ?>
        </div>
        <!-- HEADER SECTION ENDS -->

        <div class="content">
            <?php if ($destination): ?>
                <h1><?php echo htmlspecialchars($destination['destination_name']); ?></h1>
                <p><?php echo nl2br(htmlspecialchars($destination['description'])); ?></p>
                <div class="images">
                    <?php if ($destination['image1']): ?>
                        <img src="images/popularDestinations/<?php echo htmlspecialchars($destination['image1']); ?>" alt="Image1" class="img-responsive"/>
                    <?php endif; ?>
                    <?php if ($destination['image2']): ?>
                        <img src="images/popularDestinations/<?php echo htmlspecialchars($destination['image2']); ?>" alt="Image2" class="img-responsive"/>
                    <?php endif; ?>
                    <?php if ($destination['image3']): ?>
                        <img src="images/popularDestinations/<?php echo htmlspecialchars($destination['image3']); ?>" alt="Image3" class="img-responsive"/>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <h1>Destination Not Found</h1>
                <p>The destination you are looking for does not exist or is currently unavailable.</p>
            <?php endif; ?>
        </div>

        <!-- FOOTER SECTION STARTS -->
        <div class="footerMod col-sm-12">
            <div class="col-sm-4">
                <div class="footerHeading">Contact Us</div>
                <div class="footerText">Kamaladi <br> Kathmandu, Nepal</div>
                <div class="footerText">E-mail: info@orbitnepal.com</div>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <div class="footerHeading">Social Links</div>
                <div class="socialLinks">
                    <div class="fb"><a href="https://www.facebook.com/Orbitnepal">Facebook</a></div>
                    <div class="gp"><a href="https://www.instagram.com/myflightdeal">Instagram</a></div>
                    <div class="tw">twitter.com/tourism_management</div>
                    <div class="in">linkedin.com/tourism_management</div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="copyrightContainer">
                    <div class="copyright"></div>
                </div>
            </div>
        </div>
        <!-- FOOTER SECTION ENDS -->
    </div>
</body>
</html>
