<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];

    if (isset($_POST['submit']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT `Password` 
            FROM `user` 
            WHERE UserID=".$user[Session::ID];
        $result = $connection->selectDB($query);

        if ($row = mysqli_fetch_array($result))
        {
            if ($row['Password'] == hash("sha256", $_POST['oldpass']))
            {
                if ($_POST['newpass'] == $_POST['newpass2'])
                {
                    $query = "UPDATE `user` 
                        SET `Password`='".hash("sha256", $_POST['newpass'])."' 
                        WHERE UserID=".$user[Session::ID];
                    $result = $connection->updateDB($query);
                    header("Location: ./index.php");
                }
                else
                {
                    $error = "New passwords do not match!<br>";
                }
            }
            else
            {
                $error = "Wrong old password!<br>";
            }
        }
        $connection->closeDB();
    }
?>

<form method="post" action="">
    <label for="oldpass">Old password: </label>
    <input id="oldpass" name="oldpass" type="password" placeholder="Old password" autofocus/><br>

    <label for="newpass">New password: </label>
    <input id="newpass" name="newpass" type="password" placeholder="New password"/><br>

    <label for="newpass2">New password: </label>
    <input id="newpass2" name="newpass2" type="password" placeholder="New password"/><br>

    <input name="submit" type="submit" value="Add admin"/>
</form>

<?php if (isset($error) && !empty($error)) echo "$error<br>"; ?>

<?php
    require "./footer.php";
?>