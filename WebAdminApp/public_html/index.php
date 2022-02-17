<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }

    $GLOBALS['museumID'] = $user[Session::MUSEUM];

    function printVisits()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT Date, COUNT(v.Date) AS Visits
            FROM `visited` v
            LEFT JOIN `art` a
            ON a.ArtID=v.ArtID
            WHERE a.MuseumID='".$GLOBALS['museumID']."'
            GROUP BY Date
            ORDER BY Date DESC";
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            echo "<tr>
                <td>".$row['Date']."</td>
                <td>".$row['Visits']."</td>
            </tr>";
        }
        $connection->closeDB();
    }

    function printArtworkVisits()
    {
        $connection = new Database();
        $connection->connectDB();
        $query = "SELECT a.Name, COUNT(v.Date) as Visits
            FROM `visited` v
            LEFT JOIN `art` a
            ON a.ArtID=v.ArtID
            WHERE a.MuseumID='".$GLOBALS['museumID']."'
            GROUP BY v.ArtID
            ORDER BY Visits DESC";
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            echo "<tr>
                <td>".$row['Name']."</td>
                <td>".$row['Visits']."</td>
            </tr>";
        }
        $connection->closeDB();   
    }
?>

Visits by day:<br>
<table>
    <tr>
        <th>Date</th>
        <th>Visits</th>
    </tr>
    <?php printVisits()?>
</table>
<br>
Visits by artwork:<br>
<table>
    <tr>
        <th>Artwork</th>
        <th>Visits</th>
    </tr>
    <?php printArtworkVisits()?>
</table>

<?php
    require "./footer.php";
?>