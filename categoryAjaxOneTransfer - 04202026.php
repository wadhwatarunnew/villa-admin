
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
        <!--<option value="Resort Tent">Resort Tents Main Page</option>-->
        <?php
        
        
        while($y1=mysqli_fetch_assoc($query)){?>
        
        
         <option value="<?php echo $y1['title']; ?>"><?php echo $y1['title']; ?></option>
        									
        <?php  
        }  
        
        $query22= mysqli_query($con,"select * from resort_category where category='$state'");
        while($y11=mysqli_fetch_assoc($query22)){?>
        
        
         <option value="<?php echo $y11['title']; ?>"><?php echo $y11['title']; ?></option>
        									
        <?php  
        }  
        }
        
        ?>
        
        
        <?php
        if($type == 'Projects'){?>
        	
        	
        	
        	<?php
        	$query= mysqli_query($con,"select * from project_types where category='$state'"); ?>
        	        
        <!--<option value="Projects">Projects Main Page</option>	-->
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
        $("select.city").change(function(){
            var selectedCountry1 = $(".city option:selected").val();
    		
    		console.log(selectedCountry1);
            $.ajax({
                type: "POST",
                url: "categoryAjaxOneTransferData.php",
                data: { country1 : selectedCountry1 } 
            }).done(function(data){
                $("#response1").html(data);
            });
        });
    });
    
    </script>						  
								 