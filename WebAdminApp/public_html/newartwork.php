<?php

    $directory = getcwd();
    require "./header.php";
    
    if (empty($user))
    {
        header("Location: ./login.php");
    }
?>

<form method="post" action="newartwork.php">
    <label for="name">Name: </label>
    <input id="name" name="name" type="text" placeholder="Name" autofocus/><br>

    <label for="author">Author: </label>
    <input id="author" name="author" type="text" placeholder="Author"/><br>

    <label for="arttype">Art Type: </label>
    <select id="arttype" name="arttype">
        
    </select><br>

    <label for="description">Description: </label>
    <input id="description" name="description" type="text" placeholder="Description"/><br>

    <label for="photo">Photo: </label>
    <input id="photo" name="photo" type="text" placeholder="Photo"/><br>
</form>

<?php
    require "./footer.php";
?>