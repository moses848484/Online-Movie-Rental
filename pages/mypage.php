<?php
include '../db.php';
session_start();
$connect = OpenCon();
$id = $_SESSION['cusid'];

$query = "SELECT acctype FROM customer WHERE cusid='$id'";
$result = $connect->query($query);
$row = mysqli_fetch_assoc($result);
$acctype = $row['acctype'];

// Remove rows that have expired before displaying the user's order list
$query1 = "DELETE FROM orders WHERE duedate < NOW() AND ordcusid = '$id'";
$result1 = $connect->query($query1);

if (isset($_POST['delete_movie'])) {
    $movieToDelete = $_POST['delete_movie'];
    $deleteQuery = "DELETE FROM orders WHERE ordmovid = $movieToDelete AND ordcusid = '$id'";
    $deleteResult = $connect->query($deleteQuery);
}

// Initialize total price
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/mypage.css">
    <title>Movie Rental</title>
    <style>
        body {
            background-image: url('../images/shazam.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }

        .content-section-accountinfo {
            color: aliceblue;
        }

        .content-section {
            color: aliceblue;
        }



        .order-list-table {
            border-top: 2px solid gold
        }

        .like-list-table {
            border-top: 2px solid gold
        }


                                    .nice-button {
                              background-color: #3498db; /* Change the background color to your desired color */
            color: #fff; /* Text color */
            border: none;
            margin-bottom: 50px;
            padding: 5px 10px; /* Adjust padding as needed for button size */
            border-radius: 5px; /* Add rounded corners */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add a smooth hover effect */
        }

        /* Hover state for the nice button */
        .nice-button:hover {
            background-color: #2980b9; /* Change the background color on hover */
        }

        .searchbtn {
            background-color: #3498db; /* Change the background color to your desired color */
            color: #fff; /* Text color */
            border: none;
            margin-bottom: 50px;
            padding: 10px 200px; /* Adjust padding as needed for button size */
            border-radius: 5px; /* Add rounded corners */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add a smooth hover effect */
        }




        </style>


    </style>
</head>

<body>
    <div class="container">
        <nav class="topmenu-nav">
            <div class="topmenu-nav-links">
                <a href="../index.html" class="topmenu-nav-links-name">Home</a>
                <a href="./setting.php" class="topmenu-nav-links-setting">Account Settings</a>
                <a href="./logout_action.php" class="topmenu-nav-links-logout">Log Out</a>
            </div>
        </nav>

        <section class="content-section">
            <div class="content-section-accountinfo">
                <h3>Welcome <?php echo $id . '(' . $acctype . ')'; ?></h3>
            </div>

            <div class="content-section-movieinfo">
                <table class="bestseller-table">

                <form method="POST" action='searchaction.php'>
                    <strong>Search Keyword</strong>

                    <select name="keyword" id="keyword">
                        <option value="title">Title</option>
                        <option value="actname">Actor</option>
                        <option value="genre">Genre</option>
                    </select>

                    <input type="text" placeholder="Enter keyword" name="inputkeyword" required>

                    <div class="clearfix">
                        <button type="submit" class="searchbtn" value="search">Search</button>
                    </div>
                </form>
            </div>
        </section>


        <?php
$query = "SELECT movid, title, genre, rating, copies, price FROM movie;";
$result = $connect->query($query);

if (!mysqli_num_rows($result)) { ?>
    <label class="notification message">No movies Available</label>
<?php } else { ?>
    <label class="notification message">Movies Available</label>
    <form action="likeaction.php" method="POST">
    <thead>
        <tr>
            <th>Number</th>
            <th>Title</th>
            <th>Genre</th>
            <th>Rating</th>
            <th>copies</th>
            <th>Price</th>
        </tr>


    </thead>

    <tbody>
        <?php
        $number = 1;
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $number . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['rating'] . "</td>";
            echo "<td>" . $row['copies'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
            $number++;
            
            
        }
        ?>
    </tbody>
    </table>
   
<?php } ?>

                  
                <table class="order-list-table">
                    <?php


                    // query2 display orders
                    $query2 = "SELECT movid, title, genre, rating, duedate, movie.price FROM movie, orders WHERE movie.movid = orders.ordmovid AND orders.ordcusid = '$id'";
                    $result2 = $connect->query($query2);
                    if (mysqli_num_rows($result2) == 0) { ?>

                        <label class="notification message">Shopping Cart Empty</label>
                    <?php } else { ?>
                        <label class="notification message">Shopping Cart</label>
                        <form action="likeaction.php" method="POST">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Title</th>
                                <th>Genre</th>
                                <th>Rating</th>
                                <th>Expiration Date</th>
                                <th>Price</th> <!-- Added Price Column -->
                                <th>Select</th>
                                <th>Delete</th> <!-- Added Delete Column -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result2->fetch_assoc()) {
                                // Calculate the total price for the order
                                $totalPrice += $row['price'];
                                
                            ?>
                                <tr>
                                    <td><?php echo $row['movid']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['genre']; ?></td>
                                    <td><?php echo $row['rating']; ?></td>
                                    <td><?php echo $row['duedate']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><input type="radio" name="movid" value="<?php echo $row['movid']; ?>"></td>
                                    <td>

                                    
                     
                            <form method="POST" action="">
                                        <body>
                           <!-- Your HTML content here -->
                       <button type="submit" name="delete_movie" value="<?php echo $row['movid']; ?>" class="nice-button">Delete</button>
                     <!-- Other HTML content -->
                      </body>
                                        </form>

                                       
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <!-- Display the total price in dollars -->
                        <tfoot>
                            <tr>
                                <td colspan="6" style="text-align: right;"><strong>Total Price:</strong></td>
                                <td>$<?php echo number_format($totalPrice, 2); ?></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    <?php } ?>
                </table>


                <!-- Stripe Payment Section -->
<div class="stripe-payment">
    <form action="process_payment.php" method="POST">
        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                data-key="pk_test_51NynyUASHNDt1ImDoWqOLx5TIulD4Zn2gO8mgCjeR2hp0dDbqvGAmSgCKRlMrY0QhK4QqF73REGzEiWhOZ9CfH7x00hvw55xMZ"
                data-amount="<?php echo $totalPrice * 100; ?>" <!-- Amount in cents -->
                data-name="Movie Rental"
                data-description="Payment for Movie Rental"
                data-image="https://yourwebsite.com/images/your-logo.png" <!-- Replace with your logo URL -->
                data-locale="auto"
                data-currency="USD">
                var_dump($amountInCents);
        </script>
    </form>
</div>
<!-- End of Stripe Payment Section -->


               <!-- Your HTML content here -->
               <form action="playvideo.php" method="POST">
   
</form>

<!-- Other HTML content -->
            <?php ?>

            <!-- List of Liked Movies; You can add an unlimited number of likes regardless of your account type. -->
            <div class="videoplace"> </div>
            <table class="like-list-table">
                <?php

                

                // query3 Display the "like" table
                $query3 = "SELECT movid, title, genre, rating, copies FROM movie m, likes l WHERE m.movid = l.likemovid AND l.likecusid = '$id'";
                $result3 = $connect->query($query3);
                if (mysqli_num_rows($result3) == 0) { ?>
                    <label class="notification message">There are no movies liked..</label>
                <?php } else { ?>
                    <label class="notification message">Here are the movies you have liked:</label>
                    <form action="likeaction.php" method="POST">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Title</th>
                                <th>Genre</th>
                                <th>Rating</th>
                                <th>Inventory</th>
                                <th>Select</th>
                                <th>Action</th> <!-- Action Column -->
                            </tr>
                        </thead>
                        <?php
                        while ($row2 = $result3->fetch_assoc()) { ?>
                            <tbody>
                                <tr>
                                    <td><?php echo $row2['movid']; ?></td>
                                    <td><?php echo $row2['title']; ?></td>
                                    <td><?php echo $row2['genre']; ?></td>
                                    <td><?php echo $row2['rating']; ?></td>
                                    <td><?php echo $row2['copies']; ?></td>
                                    <td><input type="radio" name="movid" value="<?php echo $row2['movid']; ?>"></td>
                                    <td>
                                        <input name="likeaction" type="submit" value="Order">
                                        <input name="likeaction" type="submit" value="Delete">
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </form>
                <?php } ?>
            
            </div>
        </section>
  
            </div>

        </footer>
    </div>
</body>

</html>
