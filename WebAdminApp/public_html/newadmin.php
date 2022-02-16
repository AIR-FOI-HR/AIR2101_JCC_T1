<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];

    if (!isset($_GET['admin']))
    {
        header("Location: ./museummanagement.php");
    }

    if (!isset($_POST['submit']))
    {
        $_POST['name'] = "";
        $_POST['email'] = "";
    }

    if (isset($_POST['submit']))
    {
        $connection = new Database();
        $connection->connectDB();
        $role = 2;
        if ($_GET['admin'] == 1) 
        { 
            $role = 1;
        }
        $query = "INSERT INTO `user`
            VALUES (DEFAULT, 
            '".$_POST['email']."', 
            '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 
            '".date("Y-m-d")."', 
            '".$_POST['name']."', 
            '$role')";
        $result = $connection->updateDB($query);
        
        $query = "SELECT `UserID` 
            FROM `user` 
            WHERE Email=".$_POST['email'];
        $result = $connection->selectDB($query);
        $row = mysqli_fetch_array($result);
        

        $query2 = "";
        if ($_GET['admin'] == 1)
        {
            $query2 = "INSERT INTO `admin`
                VALUES ('".$row['UserID']."', 
                '".$GLOBALS['museumID']."')";
        }
        else
        {
            $query2 = "INSERT INTO `curator`
                VALUES ('".$row['UserID']."', 
                '".$GLOBALS['museumID']."')";
        }
        $result = $connection->updateDB($query2);
        $connection->closeDB();
        header("Location: ./museummanagement.php");
    }
?>

<form method="post" action="">
    <label for="email">E-mail: </label>
    <input id="email" name="email" type="text" placeholder="E-mail" autofocus value="<?php if (!empty($_POST['email'])) echo $_POST['email'] ?>"/><br>

    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" value="<?php if (!empty($_POST['name'])) echo $_POST['name'] ?>"/><br>

    <input name="submit" type="submit" value="Add admin"/>
</form>

<?php
    require "./footer.php";
?>