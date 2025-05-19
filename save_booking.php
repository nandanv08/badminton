<?php
require_once('config.php');
session_start();

if(!isset($_SESSION['userdata'])) {
    header("Location: login.php");
    exit;
}

extract($_POST);
$user_id = $_SESSION['userdata']['id'];

$stmt = $conn->prepare("INSERT INTO rental_list (court_id, user_id, datetime_start, datetime_end) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $court_id, $user_id, $datetime_start, $datetime_end);
$stmt->execute();

if($stmt->affected_rows > 0){
    echo "Booking successful. <a href='book_court.php'>Book another</a>";
} else {
    echo "Booking failed.";
}
