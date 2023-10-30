<?php
    include '../db.php';
    session_start();
    $connect = OpenCon();
    $rvcusid = $_SESSION['cusid'];
    $rvmovid = $_POST['movid'];
    $rvrating = $_POST['rating'];
    $rvtext = $_POST['inputtextarea'];

    $cntquery = "select count(*) cnt from review where rvcusid='$rvcusid' and rvmovid=$rvmovid;";
    $cntresult = $connect->query($cntquery);
    $cntrow = mysqli_fetch_assoc($cntresult);
    
    if(!$cntrow['cnt']){
        $query = "insert into review(rvcusid, rvmovid, rvrating, rvtext) values('$rvcusid', $rvmovid, $rvrating, '$rvtext')";
        $result = $connect->query($query);

        $newcntquery = "select count(*) cnt from review where rvcusid='$rvcusid' and rvmovid=$rvmovid;";
        $newcntresult = $connect->query($newcntquery);
        $newcntrow = mysqli_fetch_assoc($newcntresult);
        if($newcntrow['cnt'] == 1){ ?>
            <script>
                alert('You have registered a review.');
            </script>
        <?php }
        else{ ?>
            <script>
                alert('Failed to register review.');
            </script>
        <?php }
    }
    else{ ?> 
        <script>
            alert('You have already written a review for this movie');
        </script>
    <?php } ?>
    <script>
        location.replace('./mypage.php');
// history.replaceState({}, "Registration", "playvideo.php?msg=$_POST['movid']");
        // location.reload();
    </script>
