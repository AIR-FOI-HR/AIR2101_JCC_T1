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
            echo "<tr>
                <td>".$row['Name']."</td>
                <td>".$row['Author']."</td>
                <td>".$row['ArtTypeID']."</td>
                <td>".$row['Description']."</td>
                <td>".$row['Photo']."</td>
                <td><a href=\"./newartwork.php?id=".$row['ArtID']."\">Update</a></td>
                <td><a href=\"./deleteartwork.php?id=".$row['ArtID']."\">Delete</a></td>
            </tr>";
        }
        $connection->closeDB();
    }
?>

<a href="./newartwork.php">New artwork</a>
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