<?php

class Database {

    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    function __construct()
    {
        $this->host = constant('HOST');
        $this->db = constant('DB');
        $this->user = constant('USER');
        $this->password = constant('PASSWORD');
        $this->charset = constant('CHARSET');
    }

    function connect() 
    {
        try
        {
            $connection = "mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $pdo = new PDO($connection, $this->user, $this->password);
            return $pdo;
        }
        catch(PDOException $ex){
            print_r($ex->getMessage());
        }
    }

}
?>