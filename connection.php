<?php
include('config.php');

class Connection {
   
    public function connect() 
    {
        $config =  new Config();
        
        try {
            $conn = new PDO("mysql:host=$config->host;dbname=$config->database", $config->username, $config->password);
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn;

        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}

$connection = new Connection();
$connection = $connection->connect();

?>