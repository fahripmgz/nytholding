<?php 

include_once '../../model/config.php';
 
           $location=$_POST["location"];
            $query = "SELECT * FROM  master_rack where id_location='$location'";
                 $hasil = mysqli_query($conn,$query);
                 while ($rack = mysqli_fetch_array($hasil)){
 

         echo "<option value='".$rack['id_rack']."'>".$rack['rack_name']."</option>";
		
;        }
       
				 
		 
          ?>
		  