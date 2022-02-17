<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];

    function printArtwork()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT * 
            FROM `art` 
            WHERE MuseumID=".$GLOBALS['museumID'];
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            $arttype = "";

            $query = "SELECT *
                FROM `arttype` 
                WHERE ArtTypeID=".$row['ArtTypeID'];
            $result2 = $connection->selectDB($query);
            $row2 = mysqli_fetch_array($result2);
            if ($row2) $arttype=$row2['Name'];

            echo "<tr>
                <td>".$row['Name']."</td>
                <td>".$row['Author']."</td>
                <td>".$arttype."</td>
                <td>".$row['Description']."</td>
                <td><img/ width=\"200\" height=\"200\" src=\"./images/".$row['Photo']."\"></td>
                <td><a href=\"./newartwork.php?id=".$row['ArtID']."\">Update</a></td>
                <td><a href=\"./deleteartwork.php?id=".$row['ArtID']."\">Delete</a></td>
            </tr>";
        }
        $connection->closeDB();
    }
?>

<a href="./newartwork.php">New artwork</a>  
<a href="./newevent.php">New event</a>
<table>
    <tr>
        <th>Name</th>
        <th>Author</th>
        <th>Art Type</th>
        <th>Description</th>
        <th>Photo</th>
        <th>Update</th>
        <th>Delete</th>
    </tr>
    <?php printArtwork()?>
</table>

<?php
    require "./footer.php";
?>