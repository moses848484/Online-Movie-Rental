<?php
    function OpenCon(){
        $dbhost = "localhost";
        $dbuser = "moses";
        $dbpass = "970107";
        $db = "moviedatabase";
        $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);      
        return $conn;
    }        
    function CloseCon($conn){
        $conn -> close();
    }  
?>