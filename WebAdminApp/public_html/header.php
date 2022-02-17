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
                <?php
                    if (!empty($user))
                    {
                        echo "<li><a href=\"./login.php\">Logout</a></li>";
                        if ($user[Session::ROLE] <= 2) 
                        {
                            echo "<li><a href=\"./artwork.php\">Artwork</a></li>";
                        }
                        if ($user[Session::ROLE] == 1)
                        {
                            echo "<li><a href=\"./museummanagement.php\">Museum Management</a></li>";
                        }
                    }
                    else
                    {
                        echo "<li><a href=\"./login.php\">Login</a></li>";
                    }
                ?>
            </ul>
        </nav>