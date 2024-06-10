<?php

ob_start();
session_start();

?>

<!DOCTYPE html>

<html lang="en">

<!-- HEAD TAG STARTS -->

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | tourism_management</title>

    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-select.css" rel="stylesheet">
    <link href="css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/jquery-2.1.1.min.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/bootstrap-datetimepicker.js"></script>

</head>

<body>
    <?php
    $servername = "localhost";
    $usernameConn = "root";
    $passwordConn = "";
    $dbname = "projectmeteor";

    // Creating a connection to MySQL database
    $conn = new mysqli($servername, $usernameConn, $passwordConn, $dbname);

    // Checking if we've successfully connected to the database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $fare = $_POST["fareHidden"];
    $hotelID = $_POST["hotelIDHidden"];
    $mode = $_POST["modeHidden"];
    $username = $_SESSION["username"];
    $date = date("Y-m-d");
    $bookingSQL = "INSERT INTO `hotelbookings` (hotelName, date, username, cancelled) VALUES ('$hotelID', '$date', '$username', 'no')";
    $booking = $conn->query($bookingSQL);


    ?>
    <h2>
        <?php
        if ($booking) {
            echo "Booking confirmed!";
        } else {
            echo "Booking failed!";
        }
        ?>
    </h2>
</body>

</html>