<?php
// Connects to database
$conn = new mysqli("localhost", "root", "", "booking_system");

// Checks our connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// This SQL query first collects a users first name, the property name and renames it as property_name and the name of each listing and renames it as listing_name. It does this renaming because in my database, the listing name and property name in the table is just called 'name'. It then collects each check in, check out, number of guests and total price from the booking table. I then used the JOIN feature to get booking of the user id in the users table that matches the user id in the booking table, the listing of that particular listing id in the booking table that matches that of the one in the listing table and lastly the property of that particular property id in the listing table that matches that of the one in the property table. I then ordered the checkin dates so that it is from the most recent check in.

$sql = "
SELECT 
    users.firstname,
    properties.name AS property_name,
    listings.name AS listing_name,
    bookings.checkin,
    bookings.checkout,
    bookings.numof_guests,
    bookings.total_price
FROM users
JOIN bookings ON users.id = bookings.user_id
JOIN listings ON bookings.listing_id = listings.id
JOIN properties ON listings.property_id = properties.id
ORDER BY bookings.checkin
";

$result = $conn->query($sql);

// If the query fails, we will use the die function to print out the error message and stop the rest of the script from running.
if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bookings</title>
</head>
<body>
    <h2>All Bookings</h2>
    <table border="1" cellpadding="6">
        <tr>
            <th>First Name</th>
            <th>Property</th>
            <th>Listing</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Guests</th>
            <th>Total Price</th>
        </tr>
        <!-- This while loop is used to collect each row and store it as an associative array (key-value) and collects the values of each key from our php and fills our table with this information -->
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['firstname']; ?></td>
                <td><?php echo $row['property_name']; ?></td>
                <td><?php echo $row['listing_name']; ?></td>
                <td><?php echo $row['checkin']; ?></td>
                <td><?php echo $row['checkout']; ?></td>
                <td><?php echo $row['numof_guests']; ?></td>
                <td><?php echo $row['total_price']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
