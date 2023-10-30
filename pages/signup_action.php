<?php
    include '../db.php';
    $connect = OpenCon();

    $id=$_POST['id'];
    $pw=$_POST['pw'];
    $email=$_POST['email'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $phoneno=$_POST['phoneno'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $zipcode=$_POST['zipcode'];
    $cardno=$_POST['cardno'];
    $acctype=$_POST['acctype'];

    //Save the received data to the database
    $query = "insert into customer values ('$id', '$pw', '$email', '$fname', '$lname', '$address', '$city', '$zipcode', '$phoneno', concat('acc_', '$id'), '$cardno', '$acctype')";
    $result = $connect->query($query);

    //If the save is successful (result = true), registration is complete.
    if($result) { ?>      
    <script>
        alert('You are registered.');
        location.replace("./login.html");
    </script>
 
<?php }else{ ?>              
    <script>          
        alert("There is a duplicate ID or the form was not entered correctly..");
        location.replace("./signup.html");

</script>
<?php   }
 
        mysqli_close($connect);
?>
