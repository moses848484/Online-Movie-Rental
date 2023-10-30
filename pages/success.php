<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/mypage.css">
    <title>Payment Success</title>
    <style>
        body {
            background-image: url('../images/star wars.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin-bottom: 55%;
        }
        .yes {
            color: aliceblue;
        }

        .p {
            color: aliceblue;
        }


        </style>

</head>
<body>
<div class="container">
        <nav class="topmenu-nav">
            <div class="topmenu-nav-links">
                <a href="../index.html" class="topmenu-nav-links-name">Home</a>
                <a href="./mypage.php" class="topmenu-nav-links-setting">My Page</a>
                <a href="./logout_action.php" class="topmenu-nav-links-logout">Log Out</a>
            </div>
        </nav>
    <h1 class="yes">Payment Successful</h1>
    <p class="yes">Thank you for your payment. Your order has been successfully processed.</p>
    <p class="yes">Order Details:</p>
    <?php
    use Symfony\Component\Console\Color;
    // Include your database connection code
    include '../db.php';
    
    // Establish a database connection
    $connect = OpenCon();

    if (isset($_POST['movid'])) {
        $movid = $_POST['movid'];

        // Assuming you have a table named "orders" to store order information
        $query = "SELECT * FROM orders WHERE movid = $movid";
        $result = $connect->query($query);

        if ($result->num_rows > 0) {
            $order = $result->fetch_assoc();
            ?>
            <p class="yes">Order ID: <?php echo $order['ordmovid']; ?></p>
            <p class="yes">Amount Paid: $<?php echo number_format($order['amount'] / 100, 2); ?></p>

            <!-- You can display additional order details based on your database structure -->
            
            <?php
        } else {
            echo "<p>Order not found.</p>";
        }
    } else {
        echo "<p>";
    }

    // Close the database connection
    CloseCon($connect);
    ?>

    <p class="yes">For any inquiries or issues, please contact our support team.</p>
</body>
</html>
