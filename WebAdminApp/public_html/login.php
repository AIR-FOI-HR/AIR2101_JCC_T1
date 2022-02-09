<?php

    $directory = getcwd();
    require "./header.php";

?>

<form method="post" action="login.php">
    <label for="email">E-mail: </label>
    <input id="email" name="email" type="text" placeholder="E-mail" autofocus/><br>

    <label for="password">Password: </label>
    <input id="password" name="password" type="password" placeholder="Password"/><br>

    <input name="submit" type="submit" value="Log in"/>
</form>

<?php
    require "./footer.php";
?>