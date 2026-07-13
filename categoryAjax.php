
<?php
if(isset($_POST["category"])){
    $state = $_POST["category"];	 
}

if(isset($_POST["type"])){
    $type = $_POST["type"];	 
}
?>
	
<label><?php echo $state; ?></label><br>
<select name="city" class="form-control types input city" required>
<option value="">--Select--</option>
<option value="<?php echo $state; ?>"><?php echo $state; ?></option>
<?php

	include "db.php";
    
	if($type =='Resort Tents'){?>
		<?php
        
		$query= mysqli_query($con,"select * from resort_types where category='$state'"); ?>
		
		<?php


		while($y1=mysqli_fetch_assoc($query)){?>

		 	<option value="<?php echo $y1['title']; ?>"><?php echo $y1['title']; ?></option>
											
		<?php  
		}  

	} ?>


	<?php
	if($type == 'Projects'){?>
		<?php
		$query= mysqli_query($con,"select * from project_types "); ?>
		        
			
		<?php

		while($y1=mysqli_fetch_assoc($query)){?>

		 	<option value="<?php echo $y1['title']; ?>"><?php echo $y1['title']; ?></option>
											
		<?php  
		}  
	} ?>
</select>	
								  
								  
								  
<script>
	$(document).ready(function(){
	    $("select.city").change(function(){
	        var selectedCountry1 = $(".city option:selected").val();
			
			console.log(selectedCountry1);
	        $.ajax({
	            type: "POST",
	            url: "categoryAjaxOne.php",
	            data: { country1 : selectedCountry1 } 
	        }).done(function(data){
	            $("#response1").html(data);
	        });
	    });
	});
</script>