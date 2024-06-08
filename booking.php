<?php
session_start();
if (!isset($_SESSION["username"])) {
    $_SESSION['url'] = $_SERVER['REQUEST_URI']; 
    header("Location: blocked.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Booking | tourism_management</title>
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

    <?php
    $mode = $_POST["modeHidden"];
    ?>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projectmeteor";

    // Creating a connection to MySQL database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Checking if successfully connected to the database
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>

    <div class="spacer">a</div>
    <div class="bookingWrapper">
        <div class="headingOne">Please review and confirm your booking</div>

        <?php if ($mode == "hotel"): ?>
            <div class="col-sm-12 bookingHotel">
                <?php
                $hotelID = $_POST["hotelIDHidden"];
                $hotelSQL = "SELECT * FROM `hotels` WHERE hotelID='$hotelID'";
                $hotelQuery = $conn->query($hotelSQL);
                $row = $hotelQuery->fetch_assoc();
                ?>
                <div class="col-sm-7">
                    <div class="col-sm-12">
                        <div class="boxLeftHotel">
                            <div class="col-sm-12 hotelMode">Booking Summary</div>
                            <div class="col-sm-12 hotelName">
                                Name of the hotel: <span class="nameText"><?php echo $row["hotelName"] . ', ' . $row["locality"] . ', ' . $row["city"]; ?></span>
                            </div>
                            <div class="col-sm-3 borderRight">
                                <div class="checkIn"><?php echo $_SESSION["checkIn"]; ?></div>
                                <div class="checkInSubscript">Check In Date</div>
                            </div>
                            <div class="col-sm-3 borderRight">
                                <div class="checkOut"><?php echo $_SESSION["checkOut"]; ?></div>
                                <div class="checkOutSubscript">Check Out Date</div>
                            </div>
                            <div class="col-sm-3 borderRight">
                                <div class="noOfRooms"><?php echo $_SESSION["noOfRooms"]; ?></div>
                                <div class="noOfRoomsSubscript">No. of rooms</div>
                            </div>
                            <div class="col-sm-3">
                                <div class="noOfGuests"><?php echo $_SESSION["noOfGuests"]; ?></div>
                                <div class="noOfGuestsSubscript">No. of guests</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="col-sm-12">
                        <div class="boxRightHotel">
                            <div class="col-sm-12 fareSummary">Payment Summary</div>
                            <div class="col-sm-8">
                                <?php
                                $var1 = $_SESSION["checkIn"];
                                $var2 = $_SESSION["checkOut"];
                                $date1 = date_create(str_replace('/', '-', $var1));
                                $date2 = date_create(str_replace('/', '-', $var2));
                                $diff = date_diff($date1, $date2);
                                ?>
                                <div class="heading"><?php echo $_SESSION["noOfRooms"]; ?> Rooms x <?php echo $diff->format("%a Days"); ?></div>
                                <div class="heading">Convenience Fee</div>
                            </div>
                            <?php $noOfDays = $diff->format("%a"); ?>
                            <div class="col-sm-4">
                                <div class="price"><span class="sansSerif">₹ </span><?php echo $_SESSION["noOfRooms"] * $row["price"] * $noOfDays; ?></div>
                                <div class="price"><span class="sansSerif">₹ </span>250</div>
                            </div>
                            <div class="col-sm-12">
                                <div class="calcBar"></div>
                            </div>
                            <div class="col-sm-8">
                                <div class="headingTotal">Total Payment</div>
                            </div>
                            <div class="col-sm-4">
                                <div class="priceTotal"><span class="sansSerif">₹ </span><?php echo ($_SESSION["noOfRooms"] * $row["price"] * $noOfDays) + 250; ?></div>
                            </div>
                            <form action="booking_confirmation.php" method="POST">
                                <div class="bookingButton text-center">
                                    <input type="submit" class="confirmButton" value="Confirm Booking">
                                </div>
                                <?php $totalFare = ($_SESSION["noOfRooms"] * $row["price"] * $noOfDays) + 250; ?>
                                <input type="hidden" name="fareHidden" value="<?php echo $totalFare; ?>">
                                <input type="hidden" name="hotelIDHidden" value="<?php echo $hotelID; ?>">
                                <input type="hidden" name="modeHidden" value="hotel">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacerLarge">.</div>
    <?php include("common/footer.php"); ?>
</body>
</html>
