<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    
    if (!isset($_GET['id']))
    {
        header("Location: ./events.php");
    }

    $connection = new Database();
    $connection->connectDB();
    $query = "DELETE FROM `event` 
        WHERE EventID=".$_GET['id'];
    $result = $connection->updateDB($query);
    $connection->closeDB();
    header("Location: ./events.php");
?>

<?php
    require "./footer.php";
?>