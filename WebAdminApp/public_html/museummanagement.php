<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];
    $GLOBALS['userID'] = $user[Session::ID];

    function printMuseumDetails()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `museum` 
            WHERE MuseumID=".$GLOBALS['museumID'];
        $result = $connection->selectDB($query);
        if ($row = mysqli_fetch_array($result))
        {
            echo "<a>Name: ".$row['Name']."</a><br>
            <a>Phone: ".$row['Phone']."</a><br>
            <a>Email: ".$row['Email']."</a><br>
            <a>Layout: ".$row['Layout']."</a><br>";
        }
        $connection->closeDB();
    }
    function printIoTComponents()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `component` 
            WHERE MuseumID=".$GLOBALS['museumID'];
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            $comptype = "";

            $query = "SELECT *
                FROM `componenttype` 
                WHERE CompTypeID=".$row['CompTypeID'];
            $result2 = $connection->selectDB($query);
            $row2 = mysqli_fetch_array($result2);
            if ($row2) $comptype=$row2['Name'];

            echo "<tr>
                <td>".$row['Name']."</td>
                <td>".$comptype."</td>
                <td>";
            if ($row['TurnedOn'] == 1) echo "On";
            else echo "Off";
            echo "</td>
                <td><a href=\"./changecomponentstate.php?id=".$row['ComponentID']."\">Change</a></td>
                <td><a href=\"./newcomponent.php?id=".$row['ComponentID']."\">Update</a></td>
                <td><a href=\"./deletecomponent.php?id=".$row['ComponentID']."\">Delete</a></td>
            </tr>";
        }
        $connection->closeDB();
    }
    function printMuseumAdmins()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
        FROM `admin` a
        LEFT JOIN `user` u 
        ON u.UserID = a.UserID
        WHERE a.MuseumID = ".$GLOBALS['museumID'];
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            if ($row['UserID'] != $GLOBALS['userID'])
            {
                echo "<tr>
                    <td>".$row['Name']."</td>
                    <td>".$row['Email']."</td>
                    <td>".$row['RegistrationDate']."</td>
                    <td><a href=\"\">Remove</a></td>";
            }
        }
    }
?>

Museum:<br>
<?php printMuseumDetails(); ?>
<br>
<a href="./newcomponent.php">New Component</a>
<table>
    <tr>
        <th>Name</th>
        <th>Component Type</th>
        <th>Turned On</th>
        <th>Change State</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php printIoTComponents()?>
</table>

<br>
<table>
    <tr>
        <th>Name</th>
        <th>E-mail</th>
        <th>Registration Date</th>
        <th>Remove</th>
    </tr>
    <?php printMuseumAdmins()?>
</table>

<?php
    require "./footer.php";
?>