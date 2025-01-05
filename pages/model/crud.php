<?php

class database{
 
	var $host = "localhost";
	var $uname = "root";
	var $pass = "";
	var $db = "warehouse";
 
	function __construct(){
		mysql_connect($this->host, $this->uname, $this->pass);
		mysql_select_db($this->db);
	}
 


function viewMee(){
		$data = mysql_query("select * from master_maesurement");
		while($d = mysql_fetch_array($data)){
			$hasil[] = $d;
		}
		return $hasil;
	}
} 

?>
