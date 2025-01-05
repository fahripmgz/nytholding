<?php 

include_once '../model/config.php';

           $category=$_POST["category"];
           $query = "select * FROM master_subcat where id_cat='$category'";
                 $hasil = mysqli_query($conn,$query);
                 while ($subcat = mysqli_fetch_array($hasil)){
 
  
         echo "<option value='".$subcat['id_subcat']."'>".$subcat['sub_catname']."</option>";
		
     }
       
				 
		 
          ?>
		  