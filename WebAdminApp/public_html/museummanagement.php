<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];

    function printMuseumDetails()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `museum` 
            WHERE MuseumID=".$GLOBALS['museumID'];
        $result = $connection->selectDB($query);
        if ($row = mysqli_fetch_array($result))
        {
            echo "<a>Name: ".$row['Name']."</a><br>
            <a>Phone: ".$row['Phone']."</a><br>
            <a>Email: ".$row['Email']."</a><br>
            <a>Layout: ".$row['Layout']."</a><br>";
        }
        $connection->closeDB();
    }
?>

Museum:<br>
<?php printMuseumDetails(); ?>

<?php
    require "./footer.php";
?>