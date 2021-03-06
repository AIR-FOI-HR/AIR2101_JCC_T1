<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    
    if (!isset($_POST['submit']))
    {
        $_POST['name'] = "";
        $_POST['date'] = "";
        $_POST['time'] = "";
    }
    if (isset($_GET['id']) && !isset($_POST['submit']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `event` 
            WHERE EventID=".$_GET['id'];
        $result = $connection->selectDB($query);
        if ($row = mysqli_fetch_array($result))
        {
            $_POST['name'] = $row['Name'];
            $_POST['date'] = $row['Date'];
            $_POST['time'] = $row['Time'];
        }
        $connection->closeDB();
    }


    if (isset($_POST['submit']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "";
        if (isset($_GET['id']))
        {
            $query = "UPDATE `event` 
                SET `Name`='".$_POST['name']."', 
                `Date`='".$_POST['date']."', 
                `Time`='".$_POST['time']."', 
                `MuseumID`='".$user[Session::MUSEUM]."', 
                `UserID`='".$user[Session::ID]."'
                WHERE EventID=".$_GET['id'];
        }
        else
        {
            $query = "INSERT INTO `event` 
                VALUES (DEFAULT, 
                '".$_POST['name']."', 
                '".$_POST['date']."', 
                '".$_POST['time']."', 
                '".$user[Session::MUSEUM]."', 
                '".$user[Session::ID]."')";
        }
        $result = $connection->updateDB($query);
        $connection->closeDB();
        header("Location: ./events.php");
    }
?>

<form method="post" action="" enctype="multipart/form-data">
    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" autofocus value="<?php if (!empty($_POST['name'])) echo $_POST['name'] ?>"/><br>

    <label for="date">Date: </label>
    <input id="date" name="date" type="date" value="<?php if (!empty($_POST['date'])) echo $_POST['date'] ?>"/><br>

    <label for="time">Time: </label>
    <input id="time" name="time" type="time" value="<?php if (!empty($_POST['time'])) echo $_POST['time'] ?>"/><br>

    <input name="submit" type="submit" value="Add event"/>
</form>

<br><?php if (isset($error)) echo $error; ?>

<?php
    require "./footer.php";
?>