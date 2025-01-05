	 <?php 
 
include_once '../../model/config.php';
 

 
           $department=$_POST["department"];
           $query = "select id,pic_name FROM master_pic where department='$department'";
                 $hasil = mysqli_query($conn,$query);
                 while ($depart = mysqli_fetch_array($hasil)){
 
    echo "<option>select </option>";
         echo "<option value='".$depart['id']."'>".$depart['pic_name']."</option>";
		
     }
       
				 
		 
          ?>

		  