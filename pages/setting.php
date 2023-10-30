<?php
    include '../db.php';
    session_start();
    $connect = OpenCon();
    $id = $_SESSION['cusid'];

    $query = "select * from customer where cusid='$id'";
    $result = $connect->query($query);
    $row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/setting.css">

    <title>Movie Rental</title>

    <style> body {
            background-image: url('../images/spider.jpg'); /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .content-section {
            color: aliceblue;
        }

        .signupbtn {
            background-color: #3498db; /* Change the background color to your desired color */
            color: #fff; /* Text color */
            border: none;
            margin-bottom: 50px;
            padding: 5x 10px; /* Adjust padding as needed for button size */
            border-radius: 5px; /* Add rounded corners */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add a smooth hover effect */
        }

        .cancelbtn {
            background-color: #3498db; /* Change the background color to your desired color */
            color: #fff; /* Text color */
            border: none;
            margin-bottom: 50px;
            padding: 13px 10px; /* Adjust padding as needed for button size */
            border-radius: 5px; /* Add rounded corners */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add a smooth hover effect */
        }

        </style>



</head>
<body>
    <div class="container">
        <!-- ------- Common top menu (except for the index page, changed to 'Logout') ------- -->
        <nav class="topmenu-nav">
            <div class="topmenu-nav-links">
                <a href="../index.html" class="topmenu-nav-links-name">Movie Rental</a>
                <a href="./mypage.php" class="topmenu-nav-links-setting">My Page</a>
                <a href="./logout_action.php" class="topmenu-nav-links-logout">Logout</a>
            </div>
        </nav>
        <!-- ------- The center content area (various forms, database data retrieval results, etc.)------- -->
        <section class="content-section">
            <h2>Edit Information</h2>
            <form class="account-setting" action="modify_action.php" method="POST">
                <label for="fname"><strong>First Name</strong></label>
                <input class="fixed-text fname" type="text" placeholder="<?php echo $row['fname']; ?>" name="fname">

                <label for="lname"><strong>Last Name</strong></label>
                <input class="fixed-text lname" type="text" placeholder="<?php echo $row['lname']; ?>" name="lname">
                
                <label for="id"><strong>User ID</strong></label>
                <input class="fixed-text id" type="text" placeholder="<?php echo $row['cusid']; ?>" name="id">

                <label for="pw"><strong>Password</strong></label>
                <input type="password" placeholder="Enter Password" name="pw" required>

                <label for="email"><strong>Email</strong></label>
                <input type="text" placeholder="Enter Email(example@example.com)" name="email" required>

                <label for="address"><strong>Address</strong></label>
                <input type="text" placeholder="Enter Address" name="address" required>

                <label for="city"><strong>City</strong></label>
                <input type="text" placeholder="Enter City" name="city" required>
                
                <label for="zipcode"><strong>Zipcode</strong></label>
                <input type="text" placeholder="Enter Zipcode" name="zipcode" required>
                
                <label for="phoneno"><strong>Phoneno</strong></label>
                <input type="text" placeholder="Enter Phone number(010-xxxx-xxxx)" name="phoneno" required>

                <label for="cardno"><strong>CardNo</strong></label>
                <input type="text" placeholder="Enter CardNumber(xxxx-xxxx-xxxx-xxxx)" name="cardno" required>

                <label for="acctype"><strong>Account Type</strong></label>
                <input type="radio" id="basic" name="acctype" value="basic"><label for="basic" required>basic</label>
                <input type="radio" id="premium" name="acctype" value="premium" required><label for="premium">premium</label>
                <div class="clearfix">
                    <button type="submit" class="signupbtn" value="signup">Edit</button>
                    <button type="button" class="cancelbtn" value="cancel" onclick="location.href='./mypage.php'">Cancel</button>
                </div>
            </form>
        </section>
        <!-- ------------------------- footer Fixed content area -------------------------- -->
        <footer class="footer-section">
            <div class="footer-section-btn">
                <button class= "grain" id="Assistance-btn">For Assistance call 0979342154</button>
            </div>
            <style> 
            .grain {
                color: aliceblue;
            }
        </style>
        </footer>
    </div>
</body>
</html>