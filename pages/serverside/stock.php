
<?php
	//include connection file 
	include_once("connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Stock($connString);

	switch($action) {
	 case  'delete' :
		$empCls->deleteStock($params);
	 break;
	 default:
	 $empCls->getStocks($params);
	 return;
	}
	
	class Stock {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getStocks($params) {
		
		$this->data = $this->getRecords($params);
		
		echo json_encode($this->data);
	}
	
	
	function getRecords($params) {
		$rp = isset($params['rowCount']) ? $params['rowCount'] : 10;
		
		if (isset($params['current'])) { $page  = $params['current']; } else { $page=1; };  
        $start_from = ($page-1) * $rp;
		
		$sql = $sqlRec = $sqlTot = $where = '';
		
		if( !empty($params['searchPhrase']) ) {   
			$where .=" WHERE "; 
			$where .=" (  b.part_number LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR b.item_name LIKE '".$params['searchPhrase']."%' "; 
			$where .=" OR b.specification LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR c.maesurename LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR a.totalqty LIKE '".$params['searchPhrase']."%' )"; 	
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .' '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "select *,SUM(qty) as totalqty,b.id_cat as icat,a.item_code as icode from stock a left join master_catalog b on a.item_code=b.item_code left join master_maesurement c on b.maesurement=c.id_mae left join master_site d on a.site=d.id_site left join master_location e on a.location=e.id_location left join master_rack f on a.rack=f.id_Rack left join master_manufacture g on b.manufacture=g.id_manu left join master_brand h on b.brand=h.id_brand group by a.rack,a.item_code";
	
                 $hasil = mysql_query($query);
                 $data = mysql_fetch_array($hasil);
		
		
		$sqlTot .= $sql;
		$sqlRec .= $sql;
		
		//concatenate search sql if value exist
		if(isset($where) && $where != '') {

			$sqlTot .= $where;
			$sqlRec .= $where;
		}
		if ($rp!=-1)
		$sqlRec .= " LIMIT ". $start_from .",".$rp;
		
		
		$qtot = mysqli_query($this->conn, $sqlTot) or die("error to fetch tot employees data");
		$queryRecords = mysqli_query($this->conn, $sqlRec) or die("error to fetch employees data");
		
		while( $row = mysqli_fetch_assoc($queryRecords) ) { 
			$data[] = $row;
		}

		$json_data = array(
			"current"            => intval($params['current']), 
			"rowCount"            => 10, 			
			"total"    => intval($qtot->num_rows),
			"rows"            => $data   // total data array
			);
		
		return $json_data;
	}
	
//	function updateStock($params) {
	//	$data = array();
	//	//print_R($_POST);die;
	//	$sql = "Update `master_catalog` set item_name = '" . $params["edit_name"] . "', specification='" . $params["edit_salary"]."', employee_age='" . $params["edit_age"] . "' WHERE id='".$_POST["edit_id"]."'";
		
	//	echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
//	}
	
	//function deleteStock($params) {
//$data = array();
		//print_R($_POST);die;
	//	$sql = "delete from `master_catalog` WHERE id_cat='".$params["id"]."'";
		
	//	echo $result = mysqli_query($this->conn, $sql) or die("error to delete employee data");
//	}
}
?>
	