    
	 
	 <?php 
 
include '../model/db.php';
$db = new database();

 
           $site=$_POST["site"];
           $query = "SELECT * FROM stock_location a left join master_location b on a.location=b.id_location where a.site='$site'";
                 $hasil = mysql_query($query);
                 while ($location = mysql_fetch_array($hasil)){
 
    echo "<option>select </option>";
         echo "<option value='".$location['location']."'>".$location['location_name']."</option>";
		
     }
       
				 
		 
          ?>
		  