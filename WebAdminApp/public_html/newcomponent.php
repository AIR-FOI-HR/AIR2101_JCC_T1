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
        $_POST['comptype'] = 1;
    }

    function printCompTypes()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `componenttype`";
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            echo "<option value=\"".$row['CompTypeID']."\" ";
            if ($_POST['comptype'] == $row['CompTypeID']) echo "selected";
            echo">".$row['Name']."</option>";
        }
        $connection->closeDB();
    }
?>

<form method="post" action="">
    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" autofocus value="<?php if (!empty($_POST['name'])) echo $_POST['name'] ?>"/><br>

    <label for="comptype">Component Type: </label>
    <select id="comptype" name="comptype">
        <?php printCompTypes(); ?>
    </select><br>

    <label for="turnedon">Turned On: </label>
    <input id="turnedon" name="turnedon" type="checkbox" <?php if (!empty($_POST['turnedon'])) echo "checked" ?>/><br>

    <input name="submit" type="submit" value="Add component"/>
</form>

<?php
    require "./footer.php";
?>