<?php
    include '../db.php';
    session_start();
    $connect = OpenCon();
    $cusid = $_SESSION['cusid'];
    $movid = isset($_POST['movid']) ? $_POST['movid'] : null;

    if (isset($_POST['likeaction']) && $_POST['likeaction'] == "Order") {
        if ($movid !== null) {
            $oldcntsql = "SELECT COUNT(*) AS cnt FROM moviequeue WHERE qcusid='$cusid'";
            $oldres = $connect->query($oldcntsql);
            $oldrow = mysqli_fetch_assoc($oldres);

            $query = "CALL orderMovie('$cusid', $movid)";
            $result = $connect->query($query);

            $newcntsql = "SELECT COUNT(*) AS cnt FROM moviequeue WHERE qcusid='$cusid'";
            $newres = $connect->query($newcntsql);
            $newrow = mysqli_fetch_assoc($newres);

            if ($oldrow['cnt'] != $newrow['cnt']) { ?>
                <script>
                    alert('Added to the list.');
                    location.replace("./mypage.php");
                </script>
            <?php
            } else { ?>
                <script>
                    alert('There are no remaining movies or the user account is of basic type.');
                    location.replace("./mypage.php");
                </script>
            <?php
            }
        } else { ?>
            <script>
                alert('Invalid movie ID.');
                location.replace("./mypage.php");
            </script>
        <?php
        }
    } else if (isset($_POST['likeaction']) && $_POST['likeaction'] == "Delete") {
        if ($movid !== null) {
            $query = "DELETE FROM likes WHERE likecusid='$cusid' AND likemovid=$movid";
            $result = $connect->query($query);

            $cntsql = "SELECT COUNT(*) AS cnt FROM likes WHERE likecusid='$cusid' AND likemovid=$movid";
            $cntres = $connect->query($cntsql);
            $cntrow = mysqli_fetch_assoc($cntres);

            if ($cntrow['cnt'] == 0) { ?>
                <script>
                    alert('Removed from like list.');
                    location.replace("./mypage.php");
                </script>
            <?php } else { ?>
                <script>
                    alert('Failed to delete.');
                    location.replace("./mypage.php");
                </script>
            <?php }
        } else { ?>
            <script>
                alert('Invalid movie ID.');
                location.replace("./mypage.php");
            </script>
        <?php
        }
    }
?>
