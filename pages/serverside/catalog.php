<?php
	//include connection file 
	include_once("connection.php");
	
	$db = new dbObj();
	$connString =  $db->getConnstring();

	$params = $_REQUEST;
	
	$action = isset($params['action']) != '' ? $params['action'] : '';
	$empCls = new Catalog($connString);

	switch($action) {
	 case  'delete' :
		$empCls->deleteCatalog($params);
	 break;
	 default:
	 $empCls->getCatalogs($params);
	 return;
	}
	
	class Catalog {
	protected $conn;
	protected $data = array();
	function __construct($connString) {
		$this->conn = $connString;
	}
	
	public function getCatalogs($params) {
		
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
			$where .=" ( item_code LIKE '".$params['searchPhrase']."%' ";    
			$where .=" OR part_number LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR item_name LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR specification LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR remark LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR category_name LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR sub_catname LIKE '".$params['searchPhrase']."%' ";	$where .=" OR manufacture_name LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR brand_name LIKE '".$params['searchPhrase']."%' ";
			$where .=" OR maesurename LIKE '".$params['searchPhrase']."%' )";
			$where .=" OR min_stock LIKE '".$params['searchPhrase']."%' )";
	   }
	   if( !empty($params['sort']) ) {  
			$where .=" ORDER By ".key($params['sort']) .'  '.current($params['sort'])." ";
		}
	   // getting total number records without any search
		$sql = "select icat,item_code,part_number,item_name,spec,remark,category_name,sub_catname,manufacture_name,brand_name,maesurename from view_catalog";
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
	
//	function updateCatalog($params) {
	//	$data = array();
	//	//print_R($_POST);die;
	//	$sql = "Update `master_catalog` set item_name = '" . $params["edit_name"] . "', specification='" . $params["edit_salary"]."', employee_age='" . $params["edit_age"] . "' WHERE id='".$_POST["edit_id"]."'";
		
	//	echo $result = mysqli_query($this->conn, $sql) or die("error to update employee data");
//	}
	
	function deleteCatalog($params) {
		$data = array();
		//print_R($_POST);die;
		$sql = "delete from `master_catalog` WHERE id_cat='".$params["id"]."'";
		
		echo $result = mysqli_query($this->conn, $sql) or die("error to delete employee data");
	}
}
?>
	