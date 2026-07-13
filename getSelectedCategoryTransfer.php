
<?php
if(isset($_POST["country"])){
    $state = $_POST["country"];	 
	
	//echo $state;
}

?>
	
	<label><?php echo $state; ?></label><br>
	<select name="category" class="form-control types input category" required>
	  	<option value="">--Select--</option>
		<?php

		include "db.php";
        
		if($state =='Resort Tents'){?>
            <option value="Resort Tent">Resort Tents Main Page</option>
			<?php
        
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
	$query= mysqli_query($con,"select * from project_category "); ?>
	        
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
        $("select.category").change(function(){
            var selectedType = $(".country option:selected").val();
            var selectedCategory = $(".category option:selected").val();
            
            if(selectedCategory == 'Resort Tent' || selectedCategory == 'Projects')
            {
                $.ajax({
	            type: "POST",
	            url: "categoryAjaxOneTransferData.php",
	            data: { country1 : selectedCategory } 
    	        }).done(function(data){
    	            $("#response").html('');
    	            $("#response1").html(data);
    	        });
            }
            else
            {
               $.ajax({
                    type: "POST",
                    url: "categoryAjaxOneTransfer.php",
                    data: { category : selectedCategory, type : selectedType } 
                }).done(function(data){
                    $("#response").html(data);
                    $("#response1").html('');
                }); 
            }
            
        });
    });
</script>