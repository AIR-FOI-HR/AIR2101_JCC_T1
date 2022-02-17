<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];

    function printEvents()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `event` 
            WHERE MuseumID=".$GLOBALS['museumID'];
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            $curator = "";

            $query = "SELECT *
                FROM `user` 
                WHERE UserID=".$row['UserID'];
            $result2 = $connection->selectDB($query);
            $row2 = mysqli_fetch_array($result2);
            if ($row2) $curator=$row2['Name'];

            echo "<tr>
                <td>".$row['Name']."</td>
                <td>".$row['Date']."</td>
                <td>".$row['Time']."</td>
                <td>".$curator."</td>
                <td><a href=\"./newevent.php?id=".$row['EventID']."\">Update</a></td>
                <td><a href=\"./deleteevent.php?id=".$row['EventID']."\">Delete</a></td>
            </tr>";
        }
        $connection->closeDB();
    }
?>

<a href="./newevent.php">New event</a>
<table>
    <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Time</th>
        <th>Added by</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php printEvents()?>
</table>

<?php
    require "./footer.php";
?>