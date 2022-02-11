<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];
    
    if (!isset($_GET['id']))
    {
        header("Location: ./artwork.php");
    }

    if (isset($_GET['id']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "DELETE FROM `art` 
            WHERE ArtID=".$_GET['id'];
        $result = $connection->updateDB($query);
        $connection->closeDB();
        header("Location: ./artwork.php");
    }
?>

<?php
    require "./footer.php";
?>