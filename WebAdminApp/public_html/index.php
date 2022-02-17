<?php

    $directory = getcwd();
    require "./header.php";

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
?>

Visits by day:<br>
<table>
    <tr>
        <th>Date</th>
        <th>Visits</th>
    </tr>
    <?php printVisits()?>
</table>

<?php
    require "./footer.php";
?>