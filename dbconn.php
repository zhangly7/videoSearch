<?php
    // create connection
    $conn = mysqli_connect("localhost", "root", "335506mysql", "760p3");

    //check connection
    if (!$conn) {
        die("connection failed: " . mysqli_connect_error());
    }
?>