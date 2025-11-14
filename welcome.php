<?php
session_start();
include 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: rgba(0, 0, 0, 0.2);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.3);
            padding: 40px;
            border-radius: 15px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        h1 {
            font-size: 2.2rem;
            margin-bottom: 20px;
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            background: #ff385c;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            margin: 10px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: #e31c5f;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        form {
            display: inline;
        }
    </style>
</head>
<body>

<div class="container">
    <?php if (!isset($_SESSION['user_id'])): ?>
        <h1>Welcome to Book&Pay</h1>
        <p>Discover and book the perfect stay — start your journey with us.</p>
        <form action="login.php" method="post">
            <button id="signInButton" class="btn">Sign In</button>
        </form>
    <?php else: ?>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['firstname']); ?>!</h1>
        <p>We’re glad to have you here. Ready to book your next stay with us?</p>
        <form action="lookup.php" method="post">
            <button type="submit" id="form" class="btn">Get Started</button>
        </form>
        <form action="logout.php" method="post">
            <button type="submit" id="form" class="btn">Logout</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
