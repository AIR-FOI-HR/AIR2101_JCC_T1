<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    if ($user[Session::ROLE] != 1)
    {
        header("Location: ./index.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];
    
    if (!isset($_POST['submit']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `museum` 
            WHERE MuseumID=".$GLOBALS['museumID'];
        $result = $connection->selectDB($query);
        if ($row = mysqli_fetch_array($result))
        {
            $_POST['name'] = $row['Name'];
            $_POST['phone'] = $row['Phone'];
            $_POST['email'] = $row['Email'];
            $_POST['address'] = $row['Address'];
            $_POST['layout'] = $row['Layout'];
        }
        $connection->closeDB();
    }


    if (isset($_POST['submit']))
    {
        if (empty($_FILES['layout']))
        {
            $error = "No layout is chosen!<br>";
        }
        else
        {
            $file_name = $_FILES['layout']['tmp_name'];
            $file = $_FILES['layout']['tmp_name'];
            $file_size = $_FILES['layout']['size'];
            $file_type = $_FILES['layout']['type'];
            $file_error = $_FILES['layout']['error'];
            if (strpos($file_type, "image") === false)
            {
                $error = "Wrong file format!<br>";
            }
            else
            {
                $reference = $_POST['name'].".".strtolower(pathinfo(basename($_FILES["layout"]["name"]), PATHINFO_EXTENSION));
                $filePath = "./images/$reference";
                move_uploaded_file($_FILES["layout"]["tmp_name"], $filePath);
                $connection = new Database();
                $connection->connectDB();
                $query = "UPDATE `museum` 
                    SET `Name`='".$_POST['name']."', 
                    `Phone`='".$_POST['phone']."', 
                    `Email`='".$_POST['email']."', 
                    `Address`='".$_POST['address']."', 
                    `Layout`='".$reference."'
                    WHERE MuseumID=".$GLOBALS['museumID'];
                $result = $connection->updateDB($query);
                $connection->closeDB();
                header("Location: ./museummanagement.php");
            }
        }
    }
?>

<form method="post" action="" enctype="multipart/form-data">
    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" autofocus value="<?php if (!empty($_POST['name'])) echo $_POST['name'] ?>"/><br>

    <label for="phone">Phone: </label>
    <input id="phone" name="phone" type="text" placeholder="Phone" value="<?php if (!empty($_POST['phone'])) echo $_POST['phone'] ?>"/><br>

    <label for="email">E-mail: </label>
    <input id="email" name="email" type="text" placeholder="E-mail" value="<?php if (!empty($_POST['email'])) echo $_POST['email'] ?>"/><br>

    <label for="address">Address: </label>
    <input id="address" name="address" type="text" placeholder="Address" value="<?php if (!empty($_POST['address'])) echo $_POST['address'] ?>"/><br>

    <!-- <label for="description">Description: </label>
    <textarea id="description" name="description" rows="10" cols="60" maxlength="255" placeholder="Description"><?php if (!empty($_POST['description'])) echo $_POST['description'] ?></textarea><br> -->

    <label for="layout">Layout: </label>
    <input type='file' name="layout"/>
    <input type='hidden' name='MAX_FILE_SIZE' value='3000000'/><br>

    <input name="submit" type="submit" value="Update info"/>
</form>

<br><?php if (isset($error)) echo $error; ?>

<?php
    require "./footer.php";
?>