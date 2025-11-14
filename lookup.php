<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Your Property</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: rgba(0, 0, 0, 0.2);
            margin: 0;
            padding: 0;
            color: #333;
        }
        h2 {
            text-align: center;
            color: #2a3d45;
        }
        .form-container {
            text-align: center;
            width: 70%;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            margin-top: 60px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="email"], input[type="date"], select {
            width: 70%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
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
        button:hover {
            background: #e31c5f;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .results-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .results-table th, .results-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        .results-table th {
            background-color: #5c6bc0;
            color: white;
        }
        .results-table tr:hover {
            background-color: #f1f1f1;
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
    
    <div class="form-container">
        <h1>Let's find your stay!</h1>
        <form method="GET" action="srchresults.php">
            <label for="property_type">Choose Property Type:</label>
            <select id="property_type" name="property_type">
                <option value="">-- Select an option --</option>
                <option value="Villa">Villa</option>
                <option value="Apartment">Apartment</option>
            </select>

            <label for="numof_guests">Number of Guests:</label>
            <input type="number" id="numof_guests" name="numof_guests" min="1" required>

            <label for="checkin">Check-in Date:</label>
            <input type="date" id="checkin" name="checkin" required>

            <label for="checkout">Check-out Date:</label>
            <input type="date" id="checkout" name="checkout" required>
<br>
            <button type="submit">Search</button>
        </form>
    </div>

</body>
</html>
