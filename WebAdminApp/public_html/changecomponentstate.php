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
        header("Location: ./museummanagement.php");
    }

    if (isset($_GET['id']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `component` 
            WHERE ComponentID=".$_GET['id'];
        $result = $connection->selectDB($query);
        if ($row = mysqli_fetch_array($result))
        {
            $turnedOn = 0;
            if ($row['TurnedOn'] == 1) $turnedOn = 1;

            $query = "UPDATE `component` 
            SET `TurnedOn`='";
            if ($turnedOn == 0) $query .= "1";
            else $query .= "0";
            $query .="' 
            WHERE ComponentID=".$_GET['id'];
        }
        $result = $connection->updateDB($query);
        $connection->closeDB();
        header("Location: ./museummanagement.php");
    }
?>

<?php
    require "./footer.php";
?>