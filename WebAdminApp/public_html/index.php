<?php

    $directory = getcwd();
    require "./header.php";

    if (empty($user))
    {
        header("Location: ./login.php");
    }
    $GLOBALS['museumID'] = $user[Session::MUSEUM];
    $GLOBALS['pageSize'] = 10;

    //visits by day sorting and filtering
    $GLOBALS['sortVisitsColumn'] = isset($_POST['sortVisitsColumn']) ? $_POST['sortVisitsColumn'] : 1;
    $_POST['sortVisitsColumn'] =  $GLOBALS['sortVisitsColumn'];
    $GLOBALS['sortVisitsType'] = isset($_POST['sortVisitsType']) ? $_POST['sortVisitsType'] : "DESC";
    $_POST['sortVisitsType'] = $GLOBALS['sortVisitsType'];

    if (isset($_POST['dateSort']))
    {
        $GLOBALS['sortVisitsColumn'] = 1;
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
        $GLOBALS['sortVisitsColumn'] = 2;
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

    //visits by artowrk sorting and filtering
    $GLOBALS['sortArtworkColumn'] = isset($_POST['sortArtworkColumn']) ? $_POST['sortArtworkColumn'] : 2;
    $_POST['sortArtworkColumn'] =  $GLOBALS['sortArtworkColumn'];
    $GLOBALS['sortArtworkType'] = isset($_POST['sortArtworkType']) ? $_POST['sortArtworkType'] : "DESC";
    $_POST['sortArtworkType'] = $GLOBALS['sortArtworkType'];

    if (isset($_POST['artworkSort']))
    {
        $GLOBALS['sortArtworkColumn'] = 1;
        $_POST['sortArtworkColumn'] = 1;
        if ($_POST['sortArtworkType'] == "DESC")
        {
            $GLOBALS['sortArtworkType'] = "ASC";
        }
        else
        {
            $GLOBALS['sortArtworkType'] = "DESC";
        }
        $_POST['sortArtworkType'] = $GLOBALS['sortArtworkType'];
    }
    if (isset($_POST['visit2Sort']))
    {
        $GLOBALS['sortArtworkColumn'] = 2;
        $_POST['sortArtworkColumn'] = 2;
        if ($_POST['sortArtworkType'] == "DESC")
        {
            $GLOBALS['sortArtworkType'] = "ASC";
        }
        else
        {
            $GLOBALS['sortArtworkType'] = "DESC";
        }
        $_POST['sortArtworkType'] = $GLOBALS['sortArtworkType'];
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
            ORDER BY ".$GLOBALS['sortVisitsColumn']." ".$GLOBALS['sortVisitsType'];
        $result = $connection->selectDB($query);

        $maxPages = ceil($result->num_rows/$GLOBALS['pageSize']);
        $GLOBALS['maxPages'] = $maxPages;
        if (isset($_POST['firstPage']))
        {
            $_POST['page'] = 1;
            $GLOBALS['page'] = $_POST['page'];
        }
        if (isset($_POST['previousPage']))
        {
            if ($_POST['page'] > 1)
                $_POST['page'] -= 1;
            $GLOBALS['page'] = $_POST['page'];
        }
        if (isset($_POST['nextPage']))
        {
            if ($_POST['page'] < $GLOBALS['maxPages'])
                $_POST['page'] += 1;
            $GLOBALS['page'] = $_POST['page'];
        }
        if (isset($_POST['lastPage']))
        {
            $_POST['page'] = $GLOBALS['maxPages'];
            $GLOBALS['page'] = $_POST['page'];
        }
        $i=0;
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        while ($row = mysqli_fetch_array($result))
        {
            if ($row && $i>=$GLOBALS['pageSize']*($page-1) && $i<$GLOBALS['pageSize']*($page-1)+$GLOBALS['pageSize'])
            {
                echo "<tr>
                    <td>".$row['Date']."</td>
                    <td>".$row['Visits']."</td>
                </tr>";
            }
            $i++;
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
            ORDER BY ".$GLOBALS['sortArtworkColumn']." ".$GLOBALS['sortArtworkType'];
        $result = $connection->selectDB($query);
        while ($row = mysqli_fetch_array($result))
        {
            if (isset($_POST['search']) && !empty($_POST['search']) && strpos(strtolower($row['Name']), strtolower($_POST['search'])) !== false)
            {
                echo "<tr>
                    <td>".$row['Name']."</td>
                    <td>".$row['Visits']."</td>
                </tr>";
            }
            else if (!isset($_POST['search']) || empty($_POST['search']))
            {
                echo "<tr>
                    <td>".$row['Name']."</td>
                    <td>".$row['Visits']."</td>
                </tr>";
            }

        }
        $connection->closeDB();   
    }
?>

Visits by day:<br>
<form name="visitsDay" action="" method="post">
    <input type="hidden" name="sortVisitsColumn" value="<?php echo $GLOBALS['sortVisitsColumn'] ?>"/>
    <input type="hidden" name="sortVisitsType" value="<?php echo $GLOBALS['sortVisitsType'] ?>"/>
    <table>
        <tr>
            <th><input name="dateSort" type="submit" value="Date"/></th>
            <th><input name="visitSort" type="submit" value="Visits"/></th>
        </tr>
        <?php printVisits()?>
    </table>
    <br>
    <input name="firstPage" type="submit" value="First page"/>
    <input name="previousPage" type="submit" value="Previous page"/>

    <input name="page" type="number" min="1" max="<?php if(isset($GLOBALS['maxPages'])) echo $GLOBALS['maxPages'] ?>" value="<?php echo isset($_POST['page']) ? $_POST['page'] : 1 ?>"/>

    <input name="nextPage" type="submit" value="Next page"/>
    <input name="lastPage" type="submit" value="Last page"/>
</form>

<br>

Visits by artwork:<br>
<form name="visitsArtwork" action="" method="post">
    <input type="hidden" name="sortArtworkColumn" value="<?php echo $GLOBALS['sortArtworkColumn'] ?>"/>
    <input type="hidden" name="sortArtworkType" value="<?php echo $GLOBALS['sortArtworkType'] ?>"/>
    <input name="search" type="text" placeholder="Search" value="<?php if(isset($_POST['search'])) echo $_POST['search'] ?>"/>
    <table>
        <tr>
            <th><input name="artworkSort" type="submit" value="Artwork"/></th>
            <th><input name="visit2Sort" type="submit" value="Visits"/></th>
        </tr>
        <?php printArtworkVisits()?>
    </table>
</form>

<?php
    require "./footer.php";
?>