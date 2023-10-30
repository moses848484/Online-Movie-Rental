<?php
include '../db.php';
session_start();
$connect = OpenCon();
$id = $_SESSION['cusid'];
$movid = isset($_POST['movid']) ? $_POST['movid'] : null;

if ($movid !== null) {
    $query = "SELECT title FROM movie WHERE movid = $movid;";
    $result = $connect->query($query);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
} else {
    $title = "Movie Title Not Available";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/videoplay.css">
    <title>video play</title>

    <style> body {
            background-image: url('../images/avengers.jpg'); /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            margin-bottom: 20%;
          
        }
        .title-area {
            color: aliceblue;
        }
        .notification.message { /* Corrected class name here */
            color: aliceblue;
        }
    </style>
</head>
<body>

<?php
    // Define a PHP variable to store the desired text color
    $textColor = 'white'; // You can change this color value

    // Use PHP to generate HTML with inline CSS to change the text color
    echo "<p style='color: $textColor;'></p>";
?>

<div class="container">
        <!-- ------- Common top menu (except for the index page, which is changed to 'Logout') ------- -->
        <nav class="topmenu-nav">
            <div class="topmenu-nav-links">
            <a href="../index.html" class="topmenu-nav-links-name">Home</a>
                <a href="./logout_action.php" class="topmenu-nav-links-logout">Log Out</a>
            </div>
        </nav>
        <!-- ------- Center Content Area ------- -->
        <section class="content-section">
            <div class="title-area">
                <h2><?php echo $title; ?></h2>
            </div>
            <iframe class="videoarea" width="auto" height="auto" src="https://www.youtube.com/embed/TcMBFSGVi1c?si=SVz2O2EUgTuh5qxC" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="content-section-review">
                <table class="review-table">
                <?php 
                $query = "SELECT * FROM review WHERE rvmovid = $movid;";
                $result = mysqli_query($connect, $query);
                               
                if (mysqli_num_rows($result) == 0) { ?>
                    <tr>
                        <td colspan="3" class="notification message">There are no reviews yet</td>
                    </tr>
                <?php } else { ?>                 
                    <tr>
                        <td colspan="3" class="notification message">User Reviews</td>
                    </tr>
                    <thead>
                        <tr>
                            <th>users</th><th>reviews</th><th>Ratings</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?php echo $row['rvcusid']; ?></td>
                                    <td><?php echo $row['rvtext']; ?></td>
                                    <td><?php echo $row['rvrating']; ?></td>
                                    <td><?php echo $row['rvmovid']; ?></td>
                                </tr>
                            <?php } ?>
                    </tbody>
                <?php } ?>
                </table>
                <form id="reviewform" action="review_action.php" method="post">
                    <strong>Grade</strong>
                    <select name="rating" id="rating">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <textarea name="inputtextarea" id="reviewform" rows="5rem"></textarea>
                    <div class="clearfix">
                        <input type="hidden" name="movid" value="<?php echo $movid; ?>">
                        <input type="submit" class="addbtn" value="Submit">
                        <button type="button" class="rebtn" onclick="location.href='./mypage.php'">Go to My Page</button>            
                    </div>
                </form>
            </div>
        </section>
        <!-- ------------------------- footer-------------------------- -->
        <footer class="footer-section">
            <div class="footer-section-btn">
                <button id="Assistance-btn">For assistance call 0979342154</button>
            </div>
        </footer>
    </div>
</body>
</html>
