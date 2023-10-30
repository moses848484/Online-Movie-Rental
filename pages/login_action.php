<?php
    include '../db.php';
    session_start();
    $connect = OpenCon();
    
    // Translate: "ID and password entered on the login screen"
    $userid=$_POST['userid'];
    $userpw=$_POST['userpw'];
    
    //Check if there is an ID.
    $query = "select * from customer where cusid='$userid'";
    $result = $connect->query($query);
 
 
    //If there is an ID, then check the password.
    if($result->num_rows==1) { // id Check for duplicates as well.
 
        $row = mysqli_fetch_assoc($result);
 
        //if the password is correct, create a session.
        if($row['cuspw'] == $userpw){
            $_SESSION['cusid'] = $userid;
            $_SESSION['acctype'] = $row['acctype'];


            if(isset($_SESSION['cusid'])){
                echo "<script>alert(\"You are logged in.\"); </script>";
                echo "<script>location.replace(\"mypage.php\"); </script>";
            }else{
                echo "session fail";
            }
        }
        else {              
            echo "<script>alert(\"ID or password is incorrect.\"); </script>";
            echo "<script>history.back(); </script>";
        }
 
    }
 
    else{              
        echo "<script>alert(\"ID or password is incorrect.\"); </script>";
        echo "<script>history.back(); </script>";
    }
?>

