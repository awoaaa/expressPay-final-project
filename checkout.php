<?php
/*ini_set('display_errors', 1);
error_reporting(E_ALL);

$conn = new mysqli("localhost", "root", "", "booking_system");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$listing_id = isset($_GET['listing_id']) ? (int)$_GET['listing_id'] : 0;
$checkin    = $_GET['checkin']  ?? '';
$checkout   = $_GET['checkout'] ?? '';
$guests     = isset($_GET['guests']) ? (int)$_GET['guests'] : 1;

if ($listing_id <= 0) { exit("Invalid listing."); }

// get listing + property info
$sql = "SELECT 
          p.name AS property_name, p.location,
          l.name AS listing_name, l.price, l.capacity, l.description, l.cover_img
        FROM listings l
        JOIN properties p ON l.property_id = p.id
        WHERE l.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $listing_id);
$stmt->execute();
$prop = $stmt->get_result()->fetch_assoc();
if (!$prop) { exit("Listing not found."); }

// validate dates
$nights = 1;
if ($checkin && $checkout) {
    $d1 = date_create($checkin);
    $d2 = date_create($checkout);
    if ($d1 && $d2 && $d2 > $d1) {
        $nights = (int)date_diff($d1, $d2)->format("%a");
    } else {
        $checkin = ''; $checkout = '';
    }
}
if ($nights < 1) { $nights = 1; }

// compute total (simple: price * nights)
$pricePerNight = (float)$prop['price'];
$total = $pricePerNight * $nights;

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Checkout — <?php echo htmlspecialchars($prop['listing_name']); ?></title>
  <style>
    body{font-family:Arial;margin:0;background:#f8f8f8;color:#222}
    .wrap{max-width:1100px;margin:24px auto;padding:16px}
    .top{display:flex;gap:24px;background:#fff;padding:16px;border-radius:12px}
    .top img{width:48%;border-radius:12px;object-fit:cover}
    .info{flex:1}
    h1{margin:0 0 8px}
    .muted{color:#666}
    .box{background:#fff;margin-top:16px;padding:16px;border-radius:12px}
    .row{display:flex;justify-content:space-between;margin:6px 0}
    .total{font-weight:bold;font-size:18px}
    .btn{display:inline-block;margin-top:12px;padding:12px 18px;background:#ff385c;color:#fff;border-radius:8px;text-decoration:none}
    .btn:hover{background:#e31c5f}
    .small{font-size:12px;color:#666;margin-top:8px}
    .inputs{display:flex;gap:10px;margin-top:10px}
    input{padding:8px;border:1px solid #ddd;border-radius:6px}
  </style>
</head>
<body>
<div class="wrap">

  <div class="top">
    <img src="<?php echo htmlspecialchars($prop['cover_img']); ?>" alt="Cover">
    <div class="info">
      <h1><?php echo htmlspecialchars($prop['listing_name']); ?></h1>
      <div class="muted"><?php echo htmlspecialchars($prop['property_name']); ?> · <?php echo htmlspecialchars($prop['location']); ?></div>
      <p><?php echo nl2br(htmlspecialchars($prop['description'])); ?></p>

      <!-- allow user to adjust dates/guests here if needed -->
      <form class="inputs" action="checkout.php" method="get">
        <input type="hidden" name="listing_id" value="<?php echo (int)$listing_id; ?>">
        <input type="date" name="checkin"  value="<?php echo htmlspecialchars($checkin); ?>">
        <input type="date" name="checkout" value="<?php echo htmlspecialchars($checkout); ?>">
        <input type="number" name="guests" min="1" max="<?php echo (int)$prop['capacity']; ?>" value="<?php echo $guests; ?>">
        <button class="btn" type="submit">Update</button>
      </form>
    </div>
  </div>

  <div class="box">
    <h3>Trip summary</h3>
    <div class="row"><span>Check-in</span><span><?php echo $checkin ? htmlspecialchars($checkin) : '—'; ?></span></div>
    <div class="row"><span>Check-out</span><span><?php echo $checkout ? htmlspecialchars($checkout) : '—'; ?></span></div>
    <div class="row"><span>Guests</span><span><?php echo (int)$guests; ?></span></div>
    <div class="row"><span>Nights</span><span><?php echo (int)$nights; ?></span></div>
  </div>

  <div class="box">
    <h3>Price details</h3>
    <div class="row"><span>$<?php echo number_format($pricePerNight, 2); ?> × <?php echo (int)$nights; ?> nights</span><span>$<?php echo number_format($pricePerNight*$nights, 2); ?></span></div>
    <!-- Add fees here if you have them -->
    <div class="row total"><span>Total</span><span>$<?php echo number_format($total, 2); ?></span></div>

    <!-- Proceed to Pay (placeholder link) -->
    <form action="https://www.expresspaygh.com/payment" method="get">
      <!-- When you wire real ExpressPay, replace with their required params -->
      <input type="hidden" name="amount" value="<?php echo htmlspecialchars(number_format($total, 2, '.', '')); ?>">
      <input type="hidden" name="description" value="Booking for <?php echo htmlspecialchars($prop['listing_name']); ?>">
      <button class="btn" type="submit">Proceed to Pay</button>
    </form>

    <div class="small">Youll be redirected to ExpressPay to complete your payment.</div>
  </div>

  <div class="box">
    <a class="btn" href="srchresults.php">Back to search</a>
  </div>

</div>
</body>
</html>
<?php $conn->close(); ?>
*/