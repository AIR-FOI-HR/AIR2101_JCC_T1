<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];

    $GLOBALS['visitsSortColumn'] = isset($_POST['sortVisitsColumn']) ? $_POST['sortVisitsColumn'] : 1;
    $_POST['sortVisitsColumn'] =  $GLOBALS['visitsSortColumn'];
    $GLOBALS['sortVisitsType'] = isset($_POST['sortVisitsType']) ? $_POST['sortVisitsType'] : "DESC";
    $_POST['sortVisitsType'] = $GLOBALS['sortVisitsType'];

    if (isset($_POST['dateSort']))
    {
        $GLOBALS['visitsSortColumn'] = 1;
        $_POST['sortVisitsColumn'] = 1;
        if ($_POST['sortVisitsType'] == "DESC")
        {
            $GLOBALS['sortVisitsType'] = "ASC";
        }
        else
        {
            $GLOBALS['sortVisitsType'] = "DESC";
        }
        $_POST['sortVisitsType'] = $GLOBALS['sortVisitsType'];
    }
    if (isset($_POST['visitSort']))
    {
        $GLOBALS['visitsSortColumn'] = 2;
        $_POST['sortVisitsColumn'] = 2;
        if ($_POST['sortVisitsType'] == "DESC")
        {
            $GLOBALS['sortVisitsType'] = "ASC";
        }
        else
        {
            $GLOBALS['sortVisitsType'] = "DESC";
        }
        $_POST['sortVisitsType'] = $GLOBALS['sortVisitsType'];
    }

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
            ORDER BY ".$GLOBALS['visitsSortColumn']." ".$GLOBALS['sortVisitsType']."";
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
<form name="visitsDay" action="" method="post">
    <input type="hidden" name="sortVisitsColumn" value="<?php echo $GLOBALS['visitsSortColumn'] ?>"/>
    <input type="hidden" name="sortVisitsType" value="<?php echo $GLOBALS['sortVisitsType'] ?>"/>
    <table>
        <tr>
            <th><input name="dateSort" type="submit" value="Date"/></th>
            <th><input name="visitSort" type="submit" value="Visits"/></th>
        </tr>
        <?php printVisits()?>
    </table>
</form>

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