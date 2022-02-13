<?php

    require "$directory/Classes/session.class.php";
    $user = Session::getUser();
    require "$directory/Classes/database.class.php";

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="title" content="title">
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="./index.php">Index</a></li>
                <li><a href="./login.php">Login</a></li>
                <li><a href="./artwork.php">Artwork</a></li>
                <li><a href="./museummanagement.php">Museum Management</a></li>
            </ul>
        </nav>