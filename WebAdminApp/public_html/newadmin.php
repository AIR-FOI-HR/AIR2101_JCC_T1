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
        $pass = generatePassword();
        $query = "INSERT INTO `user`
            VALUES (DEFAULT, 
            '".$_POST['email']."', 
            '".hash("sha256", $pass)."', 
            '".date("Y-m-d")."', 
            '".$_POST['name']."', 
            '$role')";
        $result = $connection->updateDB($query);
        if ($result == 1)
        {
            //mail($_POST['email'], "JCC password", "Your password for JCC is: $pass");
        }
        $connection->closeDB();
        $connection = new Database();
        $connection->connectDB();
        
        $query = "SELECT `UserID` 
            FROM `user` 
            WHERE Email='".$_POST['email']."'";
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
        echo $pass;
        //header("Location: ./museummanagement.php");
    }

    function generatePassword()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $pass = "";
        for ($i = 0; $i < 10; $i++) {
            $pass .= $characters[rand(0, $charactersLength - 1)];
        }
        return $pass;
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