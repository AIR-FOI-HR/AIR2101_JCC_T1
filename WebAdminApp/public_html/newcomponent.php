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
        $_POST['name'] = "";
        $_POST['comptype'] = 1;
    }
    if (isset($_GET['id']) && !isset($_POST['submit']))
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `component` 
            WHERE ComponentID=".$_GET['id'];
        $result = $connection->selectDB($query);
        if ($row = mysqli_fetch_array($result))
        {
            $_POST['name'] = $row['Name'];
            $_POST['comptype'] = $row['CompTypeID'];
            if ($row['TurnedOn'] == 1) $_POST['turnedon'] = "on";
            else unset($_POST['turnedon']);
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
            $query = "UPDATE `component` 
            SET `Name`='".$_POST['name']."', 
            `CompTypeID`='".$_POST['comptype']."', 
            `TurnedOn`='";
            if (isset($_POST['turnedon'])) $query .= "1";
            else $query .= "0";
            $query .="' 
            WHERE ComponentID=".$_GET['id'];
        }
        else
        {
            $query = "INSERT INTO `component` 
                VALUES (DEFAULT, 
                '".$_POST['name']."', 
                '".$_POST['comptype']."', 
                '".$GLOBALS['museumID']."', 
                '";
            if (isset($_POST['turnedon'])) $query .= "1";
            else $query .= "0";
            $query .= "')";
        }
        $result = $connection->updateDB($query);
        $connection->closeDB();
        header("Location: ./museummanagement.php");
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
    <input id="turnedon" name="turnedon" type="checkbox" <?php if (isset($_POST['turnedon'])) echo "checked" ?>/><br>

    <input name="submit" type="submit" value="Add component"/>
</form>

<?php
    require "./footer.php";
?>