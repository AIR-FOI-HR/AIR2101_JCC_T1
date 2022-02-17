<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];
    
    if (!isset($_GET['id']) || !isset($_GET['admin']))
    {
        header("Location: ./museummanagement.php");
    }

    if ($_GET['admin'] == 1)
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "DELETE FROM `admin` 
            WHERE UserID=".$_GET['id'];
        $result = $connection->updateDB($query);
        $connection->closeDB();
        header("Location: ./museummanagement.php");
    }
    else
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "DELETE FROM `curator` 
            WHERE UserID=".$_GET['id'];
        $result = $connection->updateDB($query);
        $connection->closeDB();
        header("Location: ./museummanagement.php");
    }
?>

<?php
    require "./footer.php";
?>