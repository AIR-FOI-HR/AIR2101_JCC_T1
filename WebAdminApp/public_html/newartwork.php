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
        $_POST['author'] = "";
        $_POST['arttype'] = 1;
        $_POST['description'] = "";
        $_POST['photo'] = "";
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
            $_POST['author'] = $row['Author'];
            $_POST['arttype'] = $row['ArtTypeID'];
            $_POST['description'] = $row['Description'];
            $_POST['photo'] = $row['Photo'];
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
            $query = "UPDATE `art` 
            SET `Name`='".$_POST['name']."', 
            `Author`='".$_POST['author']."', 
            `ArtTypeID`='".$_POST['arttype']."', 
            `Description`='".$_POST['description']."', 
            `Photo`='".$_POST['photo']."'
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
                '".$_POST['photo']."')";
        }
        $result = $connection->updateDB($query);
        $connection->closeDB();
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

<form method="post" action="">
    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" autofocus value="<?php if (!empty($_POST['name'])) echo $_POST['name'] ?>"/><br>

    <label for="author">Author: </label>
    <input id="author" name="author" type="text" placeholder="Author" value="<?php if (!empty($_POST['author'])) echo $_POST['author'] ?>"/><br>

    <label for="arttype">Art Type: </label>
    <select id="arttype" name="arttype">
        <?php printArtTypes(); ?>
    </select><br>

    <label for="description">Description: </label>
    <input id="description" name="description" type="text" placeholder="Description" value="<?php if (!empty($_POST['description'])) echo $_POST['description'] ?>"/><br>

    <label for="photo">Photo: </label>
    <input id="photo" name="photo" type="text" placeholder="Photo" value="<?php if (!empty($_POST['photo'])) echo $_POST['photo'] ?>"/><br>

    <input name="submit" type="submit" value="Add artwork"/>
</form>

<?php
    require "./footer.php";
?>