<?php //CONNECTION FOR DB
    $host ="localhost";
    $user ="root";
    $password ="";
    $database ="repo";

    $conn = mysqli_connect($host, $user, $password, $database);

    if(mysqli_connect_error()) {
        echo 'error';
    }else{
        echo'nice';
    }
?>