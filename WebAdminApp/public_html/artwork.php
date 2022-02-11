<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }

    $museumID = $user[Session::MUSEUM];
    $connection = new Database();
    $connection->connectDB();
    $query = "SELECT * 
        FROM `art` 
        WHERE MuseumID=$museumID";
    $result = $connection->selectDB($query);
    while ($row = mysqli_fetch_array($result))
    {
        
    }
?>

<?php
    require "./footer.php";
?>