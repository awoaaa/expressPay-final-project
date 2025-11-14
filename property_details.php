<?php
$conn = new mysqli("localhost", "root", "", "booking_system");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$checkin  = isset($_GET['checkin'])  ? $_GET['checkin']  : '';
$checkout = isset($_GET['checkout']) ? $_GET['checkout'] : '';
$guests   = isset($_GET['guests'])   ? (int)$_GET['guests'] : 1;

$listing_id = isset($_GET['listing_id']) ? (int)$_GET['listing_id'] : 0;
if ($listing_id <= 0) { echo "Invalid listing ID."; exit; }

// Main property info
$sql = "SELECT p.name AS property_name, p.location, 
               l.name AS listing_name, l.price, l.capacity, 
               l.description, l.cover_img
        FROM listings l
        JOIN properties p ON l.property_id = p.id
        WHERE l.id = $listing_id";
$property = $conn->query($sql)->fetch_assoc();
if (!$property) { echo "Not found."; exit; }

// Gallery images
$gallery = $conn->query("SELECT image_url FROM property_images WHERE listing_id = $listing_id");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo htmlspecialchars($property['listing_name']); ?></title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin:0;
        background: rgba(0, 0, 0, 0.2);
        color:#333;
    }
    .container {
        max-width: 1100px;
        margin: auto;
        padding: 20px;
    }
    .cover {
        width: 100%;
        height: 400px;
        overflow: hidden;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    .cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .info {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }
    .info h1 {
        margin: 0 0 5px;
        font-size: 24px;
    }
    .info p {
        margin: 5px 0;
        color: #555;
    }
    .price {
        font-weight: bold;
        font-size: 18px;
        color: #5c6bc0;
        margin: 10px 0;
    }
    .btn {
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
    .btn:hover {
      background: #e31c5f;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }
    .gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 10px;
        margin-top: 20px;
    }
    .gallery img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
</style>
</head>
<body>

<div class="container">

    <!-- Cover -->
    <div class="cover">
        <img src="<?php echo htmlspecialchars($property['cover_img']); ?>" 
             alt="<?php echo htmlspecialchars($property['property_name']); ?>">
    </div>

    <!-- Info -->
    <div class="info">
        <h1><?php echo htmlspecialchars($property['listing_name']); ?></h1>
        <p><?php echo htmlspecialchars($property['location']); ?> · 
           <?php echo (int)$property['capacity']; ?> guests</p>
        <div class="price">₵<?php echo number_format($property['price'], 2); ?></div>
        <p><?php echo nl2br(htmlspecialchars($property['description'])); ?></p>
        
        <form action="submit.php" method="POST">
            <input type="hidden" name="listing_id" value="<?php echo (int)$listing_id; ?>">
            <input type="hidden" name="checkin" value="<?php echo htmlspecialchars($checkin); ?>">
            <input type="hidden" name="checkout" value="<?php echo htmlspecialchars($checkout); ?>">
            <input type="hidden" name="numof_guests" min="1" max="<?php echo (int)$property['capacity']; ?>" value="<?php echo (int)$guests; ?>">
            <input type="hidden" name="total_price" value="<?php echo (float)$property['price']; ?>">
            <button type="submit" class="btn">Book Now</button>
        </form>
    </div>

    <!-- Gallery -->
    <div class="gallery">
        <?php while ($img = $gallery->fetch_assoc()): ?>
            <img src="<?php echo htmlspecialchars($img['image_url']); ?>" alt="Property Image">
        <?php endwhile; ?>
    </div>

</div>

</body>
</html>
<?php $conn->close(); ?>
