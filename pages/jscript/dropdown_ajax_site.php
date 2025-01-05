	 
	 <?php 

include '../model/db.php';
$db = new database();

 
           $txtsite=$_POST["txtsite"];
           $query = "select * FROM master_site where id_site='$txtsite'";
                 $hasil = mysql_query($query);
                 while ($site = mysql_fetch_array($hasil)){
 
  
         echo "<option value='".$site['id_site']."'>".$site['site_name']."</option>";
		  }
       
				 
		 
          ?>
		  