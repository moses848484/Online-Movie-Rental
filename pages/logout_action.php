<?php
    session_start();
    session_destroy();
    echo "<script>alert(\"You have logged out successfully.\"); </script>";
?>
<meta http-equiv="refresh" content="0;url=../index.html" />