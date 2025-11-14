<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "booking_system");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect user input and sanitize it
$type = isset($_GET['property_type']) ? mysqli_real_escape_string($conn, $_GET['property_type']) : '';
$guests = isset($_GET['numof_guests']) ? mysqli_real_escape_string($conn, $_GET['numof_guests']) : '';

// If no type or guests, show an error
if (empty($type) || empty($guests)) {
    echo "Please select property type and number of guests.";
    exit;
}

// Query to get search results
$sql = "SELECT properties.name AS property_name, properties.location, listings.name AS listing_name, listings.price, listings.capacity
        FROM listings
        JOIN properties ON listings.property_id = properties.id
        WHERE properties.type = '$type' AND listings.capacity >= '$guests'";

// Execute the query
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
        .results-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }
        .card {
            width: 200px;
            margin: 10px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            text-align: center;
            background-color: white;
            cursor: pointer;
        }
        .card:hover {
            background-color: #f1f1f1;
        }
        .card img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            margin-bottom: 10px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .card-price {
            color: #5c6bc0;
            font-size: 16px;
        }
        .no-results {
            text-align: center;
            font-size: 18px;
            color: #5c6bc0;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2>Search Results</h2>

<div class="results-container">

<?php
// Check if any results are returned
if ($result->num_rows > 0) {
    // Loop through each row and display it as a clickable card
    while ($row = $result->fetch_assoc()) {
        echo "
        <a href='property_details.php?listing_id=" . $row['listing_id'] . "' class='card'>
            <img src='https://via.placeholder.com/200x120' alt='" . $row['property_name'] . "'>
            <div class='card-title'>" . $row['property_name'] . "</div>
            <div class='card-title'>" . $row['listing_name'] . "</div>
            <div class='card-price'>$" . $row['price'] . "</div>
        </a>";
    }
} else {
    // Show message if no results are found
    echo "<div class='no-results'>No properties found matching your criteria.</div>";
}
?>

</div> <!-- .results-container -->

</body>
</html>

<?php
// Close the connection
$conn->close();
?>
