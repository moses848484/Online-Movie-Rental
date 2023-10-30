<?php
    include '../db.php';
    session_start();
    $connect = OpenCon();
    $id = $_SESSION['cusid'];
    $keyword=$_POST['keyword'];
    $input=$_POST['inputkeyword'];

    if($keyword == "actname"){
        $query = "select * from movie where movid in (select mamovid from movieactor where maactid in (select actid from actor where $keyword like '%$input%'));";
    }else{
        $query = "select * from movie where $keyword like '%$input%';";
    }
    $result = $connect->query($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/main.css">
        <link rel="stylesheet" href="../css/searchaction.css">
        <title>Movie Rental</title>
        <style> body {
            background-image: url('../images/strange.jpg'); /* Replace with your background image URL */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        
        .content-section {
            color: aliceblue;
        }

        </style>


    </head>
    <body>
    <div class="container">
        <!-- -------  top menu ------- -->
        <nav class="topmenu-nav">
            <div class="topmenu-nav-links">
                <a href="../index.html" class="topmenu-nav-links-name">Movie Rental</a>
                <a href="./logout_action.php" class="topmenu-nav-links-logout">Log out</a>
            </div>
        </nav>
        <!-- ------- center content area ------- -->
        <section class="content-section">
            <form class="search-result-form" action="addorder_action.php" method="post">
            <table class="searchlist-table">
                <thead>
                    <tr>
                        <th>Number</th>
                        <th>Title</th>
                        <th>Genre</th>
                        <th>Inventory</th>
                        <th>Rating</th>
                        <th>Price</th>
                        <th>Add</th>
                    </tr>
                </thead>
                <tbody>


                <style>

        .likey {
            background-color: #3498db; /* Change the background color to your desired color */
            color: #fff; /* Text color */
            border: none;
            margin-bottom: 50px;
            padding: 10px 200px; /* Adjust padding as needed for button size */
            border-radius: 5px; /* Add rounded corners */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add a smooth hover effect */
        }

        
        .ordey {
            background-color: #3498db; /* Change the background color to your desired color */
            color: #fff; /* Text color */
            border: none;
            margin-bottom: 50px;
            padding: 10px 200px; /* Adjust padding as needed for button size */
            border-radius: 5px; /* Add rounded corners */
            cursor: pointer;
            transition: background-color 0.3s ease; /* Add a smooth hover effect */
        }

        .rebtn {
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


                    <?php

                        if(!mysqli_num_rows($result)){ ?>
                            <p class="notification message">No search results found.</p>
                        <?php }else{ ?>
                            <p class="notification message">Search Results</p>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                                <tr>
                                    <td><?php echo $row['movid']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['genre']; ?></td>
                                    <td><?php echo $row['copies']; ?></td>
                                    <td><?php echo $row['rating']; ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td><input type="radio" name="movid" value="<?php echo $row['movid']; ?>"></td>
                                </tr>
                            <?php }
                        }?>
                </tbody>
            </table>
            <div class="clearfix">
                <input name= "addaction" class = "ordey" type="submit" value="order">
                <input name= "addaction" class = "likey" type="submit" value="great">
                <button type="button" class="rebtn" value="research" onclick="location.href='./mypage.php'">search again</button>
            </div>
        </form>
        </section>
        <!-- ------------------------- footer  -------------------------- -->
        <footer class="footer-section">
            <div class="footer-section-btn">
                <button id="btn"></button>
            </div>
        </footer>
    </div>
    </body>
</html>