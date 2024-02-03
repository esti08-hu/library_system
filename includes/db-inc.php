<?php 
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "library_db";

    $conn = mysqli_connect($host, $user, $pass, $db);

    if(!$conn){
        echo "Check your Db connection!";
    }
    // else{
    //     echo "check your Db connection";
    // }
?>