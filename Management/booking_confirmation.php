<?php
session_start();
if (!isset($_SESSION["username"])) {
    $_SESSION['url'] = $_SERVER['REQUEST_URI'];
    header("Location: blocked.php");
    exit();
}

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

// Retrieve and sanitize POST data
$hotelID = isset($_POST['hotelIDHidden']) ? $conn->real_escape_string($_POST['hotelIDHidden']) : '';
$totalFare = isset($_POST['fareHidden']) ? $conn->real_escape_string($_POST['fareHidden']) : '';
$mode = isset($_POST['modeHidden']) ? $conn->real_escape_string($_POST['modeHidden']) : '';

if ($mode == 'hotel' && $hotelID && $totalFare) {
    $username = $_SESSION['username'];
    $checkIn = $_SESSION['checkIn'];
    $checkOut = $_SESSION['checkOut'];
    $noOfRooms = $_SESSION['noOfRooms'];
    $noOfGuests = $_SESSION['noOfGuests'];
    
    // Insert booking details into the database
    $insertSQL = "INSERT INTO bookings (username, hotelID, checkIn, checkOut, noOfRooms, noOfGuests, totalFare) 
                  VALUES ('$username', '$hotelID', '$checkIn', '$checkOut', '$noOfRooms', '$noOfGuests', '$totalFare')";
    
    if ($conn->query($insertSQL) === TRUE) {
        echo "Booking confirmed successfully. Your booking ID is: " . $conn->insert_id;
        // Optionally redirect to a success page
        // header("Location: success.php");
    } else {
        echo "Error: " . $insertSQL . "<br>" . $conn->error;
    }
} else {
    echo "Invalid booking details.";
}

$conn->close();
?>
