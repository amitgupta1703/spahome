<?php
include './config.php';
class DBController {
	//private $host = "localhost";
	//private $user = "root";
	//private $password = "shiv";
	//private $database = "spa2";
	
	private $host = "127.0.0.1:3306";
	private $user = "u231784203_spadbun";
	private $password = "0Z^Bj:^Z3=Wk";
	private $database = "u231784203_spadb";
	
	 
	private $conn;
	
	function __construct() {
		$this->conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	function getMainCategory(){
		$user_check_query = "select * from main_category where status='active' order by id asc"; 
		$results = mysqli_query($this->conn, $user_check_query); 
		$data_array = $results->fetch_all(MYSQLI_ASSOC);
		return $data_array;
	}
 
	function getLocations(){
		$getLoc_query = "select * from ourlocations where status='active' order by id asc"; 
		$results1 = mysqli_query($this->conn, $getLoc_query); 
		$location_array = $results1->fetch_all(MYSQLI_ASSOC);
		return $location_array;
	}
	
}

?>