    
	 
	 <?php 

include '../model/db.php';
$db = new database();

 
           $location=$_POST["location"];
            $query = "SELECT * FROM stock_location a left join master_rack b on a.rack=b.id_rack where a.location='$location'";
                 $hasil = mysql_query($query);
                 while ($rack = mysql_fetch_array($hasil)){
 

         echo "<option value='".$rack['rack']."'>".$rack['rack_name']."</option>";
		
;        }
       
				 
		 
          ?>
		  