
<?php
if(isset($_POST["country22"])){
    $state = $_POST["country22"];	 
	
	//echo $state;
}

?>
	
	<label><?php echo $state; ?></label><br>
	<select name="category22" class="form-control types input category22" required>
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
        $("select.category22").change(function(){
            var selectedType = $(".country22 option:selected").val();
            var selectedCategory = $(".category22 option:selected").val();
            
            if(selectedCategory == 'Resort Tent' || selectedCategory == 'Projects')
            {
                $("#response222").html('');
            }
            else
            {
               $.ajax({
                    type: "POST",
                    url: "categoryAjaxOneTransfer22.php",
                    data: { category : selectedCategory, type : selectedType } 
                }).done(function(data){
                    $("#response222").html('');
                    $("#response222").html(data);
                }); 
            }
            
        });
    });
</script>