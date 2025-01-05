    
	 
	 <?php 

include '../model/db.php';
$db = new database();

 
           $category=$_POST["category"];
           $query = "select * FROM master_subcat where id_cat='$category'";
                 $hasil = mysql_query($query);
                 while ($subcat = mysql_fetch_array($hasil)){
 
  
         echo "<option value='".$subcat['id_subcat']."'>".$subcat['sub_catname']."</option>";
		
;        }
       
				 
		 
          ?>
		  