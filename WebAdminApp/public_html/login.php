<?php

    $directory = getcwd();
    require "./header.php";
    $error = "";

    if (isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $password = hash("sha256", $_POST['password']);
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * FROM `admin` a,`user` u 
        WHERE u.Email='{$email}' 
        AND u.Password='{$password}'
        AND a.UserID = u.UserID";
        $result = $connection->selectDB($query);

        $row = mysqli_fetch_array($result);
        if ($row)
        {
            if ($row['RoleID'] == 1)
            {
                Session::createUser($row['Name'], $row['RoleID'], $row['UserID'], $row['MuseumID']);
                header("Location: ./index.php");
            }
        }

        $query = "SELECT * FROM `curator` c,`user` u 
        WHERE u.Email='{$email}' 
        AND u.Password='{$password}'
        AND c.UserID = u.UserID";
        $result = $connection->selectDB($query);
        $row = mysqli_fetch_array($result);
        if ($row)
        {
            if ($row['RoleID'] == 2)
            {
                Session::createUser($row['Name'], $row['RoleID'], $row['UserID'], $row['MuseumID']);
                header("Location: ./index.php");
            }
            else
            {
                $error = "Wrong e-mail or password";
            }
        }
        else
        {
            $error = "Wrong e-mail or password";
        }
    }
?>

<form method="post" action="login.php">
    <label for="email">E-mail: </label>
    <input id="email" name="email" type="text" placeholder="E-mail" autofocus/><br>

    <label for="password">Password: </label>
    <input id="password" name="password" type="password" placeholder="Password"/><br>

    <input name="submit" type="submit" value="Log in"/>
</form>

<?php if ($error != "") echo $error ?>

<?php
    require "./footer.php";
?>