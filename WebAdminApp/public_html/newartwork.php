<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];
    
    if (!isset($_POST['submit']))
    {
        $_POST['name'] = "";
        $_POST['photoname'] = "";
        $_POST['author'] = "";
        $_POST['arttype'] = 1;
        $_POST['description'] = "";
    }
    if (isset($_GET['id']) && !isset($_POST['submit']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `art` 
            WHERE ArtID=".$_GET['id'];
        $result = $connection->selectDB($query);
        if ($row = mysqli_fetch_array($result))
        {
            $_POST['name'] = $row['Name'];
            $_POST['photoname'] = $row['Photo'];
            $_POST['author'] = $row['Author'];
            $_POST['arttype'] = $row['ArtTypeID'];
            $_POST['description'] = $row['Description'];
        }
        $connection->closeDB();
    }


    if (isset($_POST['submit']))
    {
        if (empty($_FILES['photo']))
        {
            $error = "No photo is chosen!<br>";
        }
        else
        {
            $file_name = $_FILES['photo']['tmp_name'];
            $file = $_FILES['photo']['tmp_name'];
            $file_size = $_FILES['photo']['size'];
            $file_type = $_FILES['photo']['type'];
            $file_error = $_FILES['photo']['error'];
            if (strpos($file_type, "image") === false)
            {
                $error = "Wrong file format!<br>";
            }
            else
            {
                $reference = $_POST['photoname'].".".strtolower(pathinfo(basename($_FILES["photo"]["name"]), PATHINFO_EXTENSION));
                $filePath = "./images/$reference";
                move_uploaded_file($_FILES["photo"]["tmp_name"], $filePath);
                $connection = new Database();
                $connection->connectDB();
                $query = "";
                if (isset($_GET['id']))
                {
                    $query = "UPDATE `art` 
                    SET `Name`='".$_POST['name']."', 
                    `Author`='".$_POST['author']."', 
                    `ArtTypeID`='".$_POST['arttype']."', 
                    `Description`='".$_POST['description']."', 
                    `Photo`='".$reference."'
                    WHERE ArtID=".$_GET['id'];
                }
                else
                {
                    $query = "INSERT INTO `art` 
                        VALUES (DEFAULT, 
                        '".$_POST['name']."', 
                        '".$_POST['author']."', 
                        '".$GLOBALS['museumID']."', 
                        '".$_POST['arttype']."', 
                        '".$_POST['description']."', 
                        '".$reference."')";
                }
                $result = $connection->updateDB($query);
                $connection->closeDB();
                header("Location: ./artwork.php");
            }
        }
    }

    function printArtTypes()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `arttype`";
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            echo "<option value=\"".$row['ArtTypeID']."\" ";
            if ($_POST['arttype'] == $row['ArtTypeID']) echo "selected";
            echo">".$row['Name']."</option>";
        }
        $connection->closeDB();
    }
?>

<form method="post" action="" enctype="multipart/form-data">
    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" autofocus value="<?php if (!empty($_POST['name'])) echo $_POST['name'] ?>"/><br>

    <label for="author">Author: </label>
    <input id="author" name="author" type="text" placeholder="Author" value="<?php if (!empty($_POST['author'])) echo $_POST['author'] ?>"/><br>

    <label for="arttype">Art Type: </label>
    <select id="arttype" name="arttype">
        <?php printArtTypes(); ?>
    </select><br>

    <label for="description">Description: </label>
    <textarea id="description" name="description" rows="10" cols="60" maxlength="255" placeholder="Description"><?php if (!empty($_POST['description'])) echo $_POST['description'] ?></textarea><br>

    <label for="photo">Photo: </label>
    <input type='file' name="photo"/>
    <input type='hidden' name='MAX_FILE_SIZE' value='3000000'/><br>

    <label for="photoname">Photo name: </label>
    <input id="photoname" name="photoname" type="text" placeholder="Photo name" value="<?php if (!empty($_POST['photoname'])) echo $_POST['photoname'] ?>"/><br>

    <input name="submit" type="submit" value="Add artwork"/>
</form>

<br><?php if (isset($error)) echo $error; ?>

<?php
    require "./footer.php";
?>