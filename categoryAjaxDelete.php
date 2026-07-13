
<?php
if(isset($_POST["country"])){
    $state = $_POST["country"];	 
	
	//echo $state;
}

?>
	
	<label><?php echo $state; ?></label><br>
<select name="city" class="form-control types input" required>
  <option value="">--Select--</option>
								   
								   
								 <?php

include "db.php";

if($state =='Resort Tents'){?>

 
<?php

$query= mysqli_query($con,"select * from resort_types "); ?>
<option value="Resort Tent">Resort Tents Main Page</option>
<?php


while($y1=mysqli_fetch_assoc($query)){?>


 <option value="<?php echo $y1['title']; ?>"><?php echo $y1['title']; ?></option>
									
<?php  
}  

$query22= mysqli_query($con,"select * from resort_category ");
while($y11=mysqli_fetch_assoc($query22)){?>


 <option value="<?php echo $y11['title']; ?>"><?php echo $y11['title']; ?></option>
									
<?php  
}  
}

?>


<?php
if($state == 'Projects'){?>
	
	
	
	<?php
	$query= mysqli_query($con,"select * from project_types "); ?>
	        
<option value="Projects">Projects Main Page</option>	
<?php


while($y1=mysqli_fetch_assoc($query)){?>


 <option value="<?php echo $y1['title']; ?>"><?php echo $y1['title']; ?></option>
									
<?php  
}  



}

?>		
                                  
								  </select>	
								  
								  
								  
								  <script>

$(document).ready(function(){
    $("select.types").change(function(){
        var selectedCountry1 = $(".types option:selected").val();
		
		console.log(selectedCountry1);
        $.ajax({
            type: "POST",
            url: "categoryAjaxOneDelete.php",
            data: { country1 : selectedCountry1 } 
        }).done(function(data){
            $("#response1").html(data);
        });
    });
});

</script>