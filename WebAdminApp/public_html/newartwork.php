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
        $query = "INSERT INTO `art` 
        VALUES (DEFAULT, 
        '".$_POST['name']."', 
        '".$_POST['author']."', 
        '".$GLOBALS['museumID']."', 
        '".$_POST['arttype']."', 
        '".$_POST['description']."', 
        '".$_POST['photo']."')";
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
            echo "<option value=\"".$row['ArtTypeID']."\">".$row['Name']."</option>";
        }
        $connection->closeDB();
    }
?>

<form method="post" action="newartwork.php">
    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" autofocus/><br>

    <label for="author">Author: </label>
    <input id="author" name="author" type="text" placeholder="Author"/><br>

    <label for="arttype">Art Type: </label>
    <select id="arttype" name="arttype">
        <?php printArtTypes(); ?>
    </select><br>

    <label for="description">Description: </label>
    <input id="description" name="description" type="text" placeholder="Description"/><br>

    <label for="photo">Photo: </label>
    <input id="photo" name="photo" type="text" placeholder="Photo"/><br>

    <input name="submit" type="submit" value="Add artwork"/>
</form>

<?php
    require "./footer.php";
?>