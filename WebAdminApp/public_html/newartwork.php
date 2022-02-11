<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
?>

<form method="post" action="newartwork.php">
    
</form>

<?php
    require "./footer.php";
?>