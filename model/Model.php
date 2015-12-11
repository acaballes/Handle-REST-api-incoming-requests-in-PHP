<?php
/**
 * @author Algie Caballes <algie.developer@gmail.com>
 * @desc Simple database communication queries
 */
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
	mysqli_free_result($result);
	$this->closeConnection();
	return empty($data) ? array() : $data;
    }

    public function getAllData()
    {
	$data = array();
	$this->connectDatabase();
        $result = mysqli_query($this->mysqli, "SELECT * from {$this->table}");
	if($result){
            while($row = mysqli_fetch_assoc($result)){
                $data[] = $row;
            }
        }
        $this->closeConnection();
        return empty($data) ? array() : array("items"=>$data);
    }

    public function addData($data)
    {
	$res = '';
	$this->connectDatabase();
	$result = mysqli_query($this->mysqli, "INSERT INTO {$this->table} VALUES(null,'{$data['name']}','{$data['description']}',{$data['price']})");
	if ($result)
	    $res = "The data was successfully added.";
	else
  	    $res = "There was an error in adding the data.";
        $this->closeConnection();
	return $res;
    }

    public function removeData($id)
    {
	$this->connectDatabase();
        $result = mysqli_query($this->mysqli, "DELETE from {$this->table} where id = {$id}");
	$this->closeConnection();
	if ($result)
	    return "Successfully removed.";
	else
	    return "There was an error in deleting the data.";
    }

    public function updateData($data)
    {
	$str = array();
	if (isset($data['name']))
	    $str[] = "set name = '{$data['name']}'";
	if (isset($data['description']))
	    $str[] = "set description = '{$data['description']}'";
	if (isset($data['price']))
	    $str[] = "set price = '{$data['price']}'";

	if (empty($str))
	    return "Empty parameters found.";
	$str = implode(',', $str);
	print $str;
    }
}

?>
