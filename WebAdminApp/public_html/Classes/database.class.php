<?php

class Database 
{
    const server = "localhost";
    const user = "root";
    const password = "";
    const database = "jcc";

    private $connection = null;
    private $error = '';

    function connectDB()
    {
        $this->connection = new mysqli(self::server, self::user, self::password, self::database);
        if ($this->connection->connect_errno) {
            echo "Error while connecting to database: " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->error = $this->connection->connect_error;
        }
        $this->connection->set_charset("utf8");
        if ($this->connection->connect_errno) {
            echo "Error while setting charset: " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->error = $this->connection->connect_error;
        }
        return $this->connection;
    }
    function closeDB()
    {
        $this->connection->close();
    }
    function selectDB($query)
    {
        $result = $this->connection->query($query);
        if ($this->connection->connect_errno) {
            echo "Error with query: {$query} - " . $this->connection->connect_errno . ", " .
            $this->connection->connect_error;
            $this->error = $this->connection->connect_error;
        }
        if (!$result) {
            $result = null;
        }
        return $result;
    }
    function updateDB($query)
    {

    }
}

?>