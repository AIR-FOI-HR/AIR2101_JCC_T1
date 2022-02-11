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
            </tr>";
        }
    }
?>

<table>
    <tr>
        <th>Name</th>
        <th>Author</th>
        <th>Art Type</th>
        <th>Description</th>
        <th>Photo</th>
    </tr>
    <?php printArtwork()?>
</table>

<?php
    require "./footer.php";
?>