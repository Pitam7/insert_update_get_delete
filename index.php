<?php
include('connection.php');

class DAL {
    private $_connection;

    function __construct() {
        $connectionClass = new Connection();
        $this->_connection = $connectionClass->connect();

    }

    public function insert($argument) {
        $columns = '';
        $values = '';

        foreach($argument['values'] as $column_name => $column_value) {
            $columns .= "`". $column_name . "`,";
            $values .= "'". $column_value . "',";
        }

        $sql = "INSERT INTO " . $argument['table'] . " (";
        $sql .= rtrim($columns, ',') . ") ";
        $sql .= "VALUES (" . rtrim($values, ',') . ")";

        $this->_connection->exec($sql);
       

    }

    public function update($argument) {
        $columns = '';
        $c='';

        foreach($argument['values'] as $column_name => $column_value) 
        {
            $columns .= "`". $column_name . "` = " ."'".$column_value."'".",";
        }
        foreach($argument['where'] as $c_name => $c_value)
        {
            $c .= "`". $c_name . "` = " ."'".$c_value."'";
        }
        $sql = "UPDATE " . $argument['table'] . " SET ";
        $sql .= rtrim($columns, ',') ." WHERE ".$c;
       

        //$this->_connection->exec($sql);
        

    }
    
    public function get($argument) 
    {
        $sql = "SELECT * FROM " . $argument['table'] ;

        //$this->_connection->exec($sql);
        

    }

    public function delete($argument) 
    {
        $c='';
        foreach($argument['where'] as $c_name => $c_value)
        {
            $c .= "`". $c_name . "` = " ."'".$c_value."'";
        }

        $sql = "DELETE FROM " . $argument['table'] ." WHERE ".$c ;

        //$this->_connection->exec($sql);
        //echo $sql;

    }

}


$dal = new DAL();
$dal->insert([
    'table' => 'users',
    'values' => [
        'id' => 25,
        'firstname' => 'Pi',
        'lastname' => 'Pol',
        'roll' => 51,
        'created_at' => date('Y-m-d H:i:s'),
    ]
]);
$dal->insert([
    'table' => 'users',
    'values' => [
        'id' => 20,
        'firstname' => 'Ad',
        'lastname' => 'Sen',
        'roll' => 22,
        'created_at' => date('Y-m-d H:i:s'),
    ]
]);
$dal->update([
    'table' => 'users',
    'values' => [
        'id' => 6,
        'firstname' => 'Jagjit',
        'lastname' => 'Lal',
        'roll' => 25,
        'created_at' => date('Y-m-d H:i:s'),
    ],
    'where' => [
        'id'=> 1,
    ],
]);
$dal->get([
    'table'=>'users',
]);
$dal->delete([
    'table'=>'users',
    'where' => [
        'id'=> 2,
    ],
]);
?>
