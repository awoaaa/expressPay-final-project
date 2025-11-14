<?php
// to connect to the database
$conn = new mysqli("localhost", "root", "", "booking_system");

// stop if the connection fails
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// collect search parameters
$type     = $_GET['property_type'];
$guests   = $_GET['numof_guests'];
$checkin  = $_GET['checkin'];
$checkout = $_GET['checkout'];

// validation
if (empty($type) || empty($guests)) {
    echo "Please select property type and number of guests.";
    exit;
}

// query listings
$sql = "SELECT properties.name AS property_name, properties.location, 
               listings.name AS listing_name, listings.price, listings.capacity, 
               listings.cover_img, listings.id AS listing_id
        FROM listings
        JOIN properties ON listings.property_id = properties.id
        WHERE properties.type = '$type' 
          AND listings.capacity >= '$guests'";

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
    margin: 30px 0;
}
.results-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    padding: 20px;
}
.property-card {
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    text-decoration: none;
    color: inherit;
    display: block;
}
.property-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.property-card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}
.property-content {
    padding: 15px;
}
.property-title {
    font-size: 18px;
    font-weight: 600;
    margin: 0 0 5px;
}
.property-sub {
    font-size: 14px;
    color: #777;
    margin-bottom: 10px;
}
.property-price {
    font-size: 16px;
    font-weight: bold;
    color: #5c6bc0;
}
.no-results {
    text-align: center;
    font-size: 18px;
    color: #5c6bc0;
    margin-top: 20px;
}
.back-button { 
    display: inline-block;
    padding: 12px 25px;
    margin: 10px;
    background: #ff385c;
    color: #fff;
    font-weight: bold;
    text-decoration: none;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    transition: all 0.3s ease;
}
.back-button:hover { 
    background: #e31c5f;
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
</style>
</head>
<body>

<h2>Search Results</h2>

<div class="results-container">
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <a href='property_details.php?listing_id={$row['listing_id']}&checkin=" . urlencode($checkin) . "&checkout=" . urlencode($checkout) . "&guests=" . urlencode($guests) . "' class='property-card'>
            <img src='" . htmlspecialchars($row['cover_img']) . "' alt='" . htmlspecialchars($row['property_name']) . "'>
            <div class='property-content'>
                <div class='property-title'>" . htmlspecialchars($row['property_name']) . "</div>
                <div class='property-sub'>" . htmlspecialchars($row['location']) . " · " . (int)$row['capacity'] . " Guests</div>
                <div class='property-price'>₵" . number_format($row['price'], 2) . "</div>
            </div>
        </a>";
    }
} else {
    echo "<div class='no-results'>No properties found matching your criteria.</div>";
}
?>
</div>

<a href="lookup.php" class="back-button">Back to Search</a>

</body>
</html>

<?php $conn->close(); ?>
