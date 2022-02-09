<?php

    $directory = getcwd();
    require "./header.php";

    if (isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $password = hash("sha256", $_POST['password']);
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * FROM `user` 
            WHERE `Email`='{$email}' 
            AND `Password`='{$password}'";
        $result = $connection->selectDB($query);
    }
?>

<form method="post" action="login.php">
    <label for="email">E-mail: </label>
    <input id="email" name="email" type="text" placeholder="E-mail" autofocus/><br>

    <label for="password">Password: </label>
    <input id="password" name="password" type="password" placeholder="Password"/><br>

    <input name="submit" type="submit" value="Log in"/>
</form>

<?php
    require "./footer.php";
?>