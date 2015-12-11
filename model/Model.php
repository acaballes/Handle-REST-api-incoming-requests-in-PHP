<?php
namespace Model;

class Query
{
    protected $mysqli;
    protected $table;

    public function __construct($table)
    {
	$this->table = $table;
    }

    protected function connectDatabase()
    {
	$this->mysqli = mysqli_connect("localhost", "root", "algieadmin", "api");
	if (mysqli_connect_errno()) {
    	    printf("Connect failed: %s\n", mysqli_connect_error());
    	    exit();
	}	
    }

    protected function closeConnection()
    {
	mysqli_close($this->mysqli);
    }

    public function getDataById($id)
    {
	$this->connectDatabase();
	$result = mysqli_query($this->mysqli, "SELECT * from {$this->table} where id = {$id}");
	$data = mysqli_fetch_assoc($result);
	$this->closeConnection();
	return empty($data) ? array() : $data;
    }

    public function getAllData()
    {
	$this->connectDatabase();
        $result = mysqli_query($this->mysqli, "SELECT * from {$this->table}");
        $data = mysqli_fetch_assoc($result);
        $this->closeConnection();
        return empty($data) ? array() : array("items"=>$data);
    }

    public function addData($data)
    {
	
	print_r($data);
    }
}

?>
