<?php

    require "$directory/Classes/session.class.php";
    Session::createSession();
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
            </ul>
        </nav>