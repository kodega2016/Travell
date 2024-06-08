<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Booking Success | tourism_management</title>
    <link href="css/main.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:200,300,400|Raleway:100,300,400,500|Roboto:100,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <?php include("common/headerLoggedIn.php"); ?>
    <div class="spacer">a</div>
    <div class="bookingWrapper">
        <div class="headingOne">
            Your booking has been confirmed!
        </div>
        <div class="spacerLarge">.</div>
        <a href="index.php">Return to Home</a>
    </div>
    <div class="spacerLarge">.</div>
    <?php include("common/footer.php"); ?>
</body>
</html>
