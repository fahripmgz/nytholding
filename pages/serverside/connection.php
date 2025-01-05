<?php session_start();
Class dbObj{
	/* Database connection start */
	var $servername = "localhost";
	var $username = "appnyt_whm_sarana";
	var $password = "whm_sarana2024";
	var $dbname = "appnyt_warehouse";
	var $conn;
	function getConnstring() {
		$con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname) or die("Connection failed: " . mysqli_connect_error());

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		} else {
			$this->conn = $con;
		}
		return $this->conn;
	}
}

?>