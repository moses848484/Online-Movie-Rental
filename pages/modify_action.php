<?php
    include '../db.php';
    session_start();
    $connect = OpenCon();
    $id = $_SESSION['cusid'];
    $pw=$_POST['pw'];
    $email=$_POST['email'];
    $phoneno=$_POST['phoneno'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zipcode=$_POST['zipcode'];
    $cardno=$_POST['cardno'];
    $acctype=$_POST['acctype'];


    


    //Save the input data to the database.
    $query = "update customer set cuspw='$cuspw', email='$email', address='$address', city='$city', zipcode='$zipcode', phonenum='$phoneno', cardno='$cardno', acctype='$acctype' where cusid='$id'";
    $result = $connect->query($query);

    //If saved (result = true), registration is complete.
    if($result) { ?>      
    <script>
        alert('The fix has been completed successfully.');
        location.replace("./mypage.php");
    </script>
 
<?php }else{ ?>              
    <script>          
        alert("You did not fill out the form correctly.");
        location.replace("./setting.php");

</script>
<?php }
    mysqli_close($connect);

?>
