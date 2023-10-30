<?php
    include '../db.php';
    session_start();
    $connect = OpenCon();
    $cusid = $_SESSION['cusid'];
    $movid = $_POST['movid'];
    
    if ($_POST['addaction'] == "order") {
        $query = "SELECT COUNT(*) AS cnt FROM moviequeue WHERE qcusid='$cusid' AND qmovid='$movid'";
        $result = $connect->query($query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['cnt'] == 0) {
            $query = "CALL orderMovie('$cusid', '$movid')";
            $result = $connect->query($query);
            
            if ($result) { ?>
                <script>
                    alert('Added to the list.');
                    location.replace("./mypage.php");
                </script>
            <?php } else { ?>
                <script>
                    alert('Failed to add to the list.');
                    location.replace("./mypage.php");
                </script>
            <?php }
        } else { ?>
            <script>
                alert('The movie has already been ordered.');
                location.replace("./mypage.php");
            </script>
        <?php }
    } elseif ($_POST['addaction'] == "great") {
        $query = "SELECT COUNT(*) AS cnt FROM likes WHERE likecusid='$cusid' AND likemovid='$movid'";
        $result = $connect->query($query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['cnt'] == 0) {
            $query = "INSERT INTO likes(likecusid, likemovid) VALUES('$cusid', '$movid')";
            $result = $connect->query($query);
            
            if ($result) { ?>
                <script>
                    alert('Added to like list.');
                    location.replace("./mypage.php");
                </script>
            <?php } else { ?>
                <script>
                    alert('Failed to add to like list.');
                    location.replace("./mypage.php");
                </script>
            <?php }
        } else { ?>
            <script>
                alert('The movie is already in your like list.');
                location.replace("./mypage.php");
            </script>
        <?php }
    }
?>
