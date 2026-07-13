
<?php
if(isset($_POST["category"])){
    $state22 = $_POST["category"];	 
}

if(isset($_POST["type"])){
    $type = $_POST["type"];	 
}


?>
	
	<label><?php echo $state22; ?></label><br>
<select name="city22" class="form-control types input" required>
  <option value="">--Select--</option>
	 <option value="<?php echo $state22; ?>"><?php echo $state22; ?></option>					   
								   
								   <?php

include "db.php";

if($type =='Resort Tents'){?>

 
<?php

$query= mysqli_query($con,"select * from resort_types where category='$state22'"); ?>
<!--<option value="Resort Tent">Resort Tents Main Page</option>-->
<?php


while($y1=mysqli_fetch_assoc($query)){?>


 <option value="<?php echo $y1['title']; ?>"><?php echo $y1['title']; ?></option>
									
<?php  
}  

}

?>


<?php
if($type == 'Projects'){?>
	
	
	
	<?php
	$query= mysqli_query($con,"select * from project_types where category='$state22'"); ?>
	        
<!--<option value="Projects">Projects Main Page</option>	-->
<?php


while($y1=mysqli_fetch_assoc($query)){?>


 <option value="<?php echo $y1['title']; ?>"><?php echo $y1['title']; ?></option>
									
<?php  
}  



}

?>
								   
								
                                  
								  </select>	
								  
								  
		 					  
								 