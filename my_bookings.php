<?php
session_start();
include('config.php'); // DB connection

// Get logged-in user ID
$user_id = $_SESSION['login_id'];

$query = "SELECT cr.*, c.name AS court_name 
          FROM court_rentals cr
          JOIN court_list c ON cr.court_id = c.id
          WHERE cr.user_id = '$user_id'
          ORDER BY cr.date_created DESC";

$result = mysqli_query($conn, $query);
?>

<h2>My Court Bookings</h2>
<table border="1">
    <tr>
        <th>#</th>
        <th>Court</th>
        <th>Date</th>
        <th>Time</th>
        <th>Status</th>
    </tr>
    <?php
    $i = 1;
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>{$i}</td>
                <td>{$row['court_name']}</td>
                <td>{$row['date']}</td>
                <td>{$row['time_slot']}</td>
                <td>{$row['status']}</td>
              </tr>";
        $i++;
    }
    ?>
</table>
