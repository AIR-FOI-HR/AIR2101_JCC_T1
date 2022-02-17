<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    if ($user[Session::ROLE] != 1)
    {
        header("Location: ./index.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];
    
    if (!isset($_GET['id']))
    {
        header("Location: ./museummanagement.php");
    }

    if (isset($_GET['id']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "DELETE FROM `component` 
            WHERE ComponentID=".$_GET['id'];
        $result = $connection->updateDB($query);
        $connection->closeDB();
        header("Location: ./museummanagement.php");
    }
?>

<?php
    require "./footer.php";
?>