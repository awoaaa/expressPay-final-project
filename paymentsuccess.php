<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: rgba(0, 0, 0, 0.2);
            color: #fff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: rgba(0, 0, 0, 0.3);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .success-icon {
            font-size: 60px;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: 
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
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
    </style>
</head>
<body>
<div class="container">
    <div class="success-icon">✅</div>
    <h1>Payment Successful!</h1>
    <p>Thank you for your booking. Your payment has been processed successfully.</p>
    
    <!-- Placeholder actions for now -->
    <form action="send_email.php" method="post" style="display:inline;">
        <button type="submit" class="btn">Send to Email</button>
    </form>
    <form action="download_invoice.php" method="post" style="display:inline;">
        <button type="submit" class="btn">Download Invoice</button>
    </form>
</div>
</body>
</html>
