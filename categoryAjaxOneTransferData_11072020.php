<?php
if(isset($_POST["country1"])){
    $state1 = $_POST["country1"];	 
	
}


?>

<div>

<h4 class="page-header"><?php  echo $state1; ?> Gallery</h4><br><br>




<div class="row">

 <?php 

include "db.php";
$i = 1;
$query25= mysqli_query($con,"select * from add_gallery where title='$state1' ");
											
while($d=mysqli_fetch_assoc($query25)){
	
	//$id = $d['id'];
	
	//$types = $d['types'];
	
	$splitTimeStamp = explode(" ",$d['dateTime']);
			$date = $splitTimeStamp[0];
			$time = $splitTimeStamp[1];

?>

<?php

if(!$d['p1'] && !$d['p2'] && !$d['p3'] && !$d['p4'] && !$d['p5'] && !$d['p6'] && !$d['p7'] && !$d['p8'] && !$d['p9'] && !$d['p10']){

}else{
	
?>



<?php 


if(!$d['p1']){
	
}else{
	?>
	
	
               <div class="col-md-3">
	
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1" data-src="<?php echo $d['p1']; ?>">
                           <a href="">
						   
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p1']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p1']; ?>" alt="gallery img1"/>
							  
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p1']; ?>" >
                        </li>
						
						
						</div><br>
<?php  }  ?>
                        
						<?php 


if(!$d['p2'] || $d['p2'] == $d['p1']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1" data-src="<?php echo $d['p2']; ?>">
                           <a href="">
						   
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p2']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p2']; ?>" alt="gallery img1"/>
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   
						   <input class="form-control" type="text" value="<?php echo $d['p2']; ?>" >
                        </li>
					
						</div><br>
<?php  }  ?>


<?php 


if(!$d['p3'] || $d['p3'] == $d['p2']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p3']; ?>">
                           <a href="">
						   
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p3']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p3']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p3']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>

<?php 


if(!$d['p4'] || $d['p4'] == $d['p3']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p4']; ?>">
                           <a href="">
						   
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p4']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p4']; ?>" alt="gallery img1"/>
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p4']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>

<?php 


if(!$d['p5'] || $d['p5'] == $d['p4']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1" data-src="<?php echo $d['p5']; ?>">
                           <a href="">
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p5']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p5']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p5']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>



<?php 


if(!$d['p6'] || $d['p6'] == $d['p5']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p6']; ?>">
                           <a href="">
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p6']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p6']; ?>" alt="gallery img1"/>
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p6']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>
						
						<?php 


if(!$d['p7'] || $d['p7'] == $d['p6']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p7']; ?>">
                           <a href="">
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p7']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p7']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p7']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>

<?php 


if(!$d['p8'] || $d['p8'] == $d['p7']){
	
}else{
	?>
	
	<div class="col-md-3">
	<br>
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p8']; ?>">
                           <a href="">
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p8']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p8']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p8']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>


<?php 


if(!$d['p9'] || $d['p9'] == $d['p8']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 <br>
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p9']; ?>">
                           <a href="">
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p9']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p9']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p9']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>

<?php 


if(!$d['p10'] || $d['p10'] == $d['p9']){
	
}else{
	?>
	
	<div class="col-md-3">
	<br>
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p10']; ?>">
                           <a href="">
						   <input type="checkbox" class="single-checkbox" value="<?php echo $d['p10']; ?>" name="check[]" id="check" style="width: 30px;height: 24px; "/>
						    <br><br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p10']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a><br><br>
						   <input class="form-control" type="text" value="<?php echo $d['p10']; ?>" >
                        </li>
						
						</div><br>
<?php  }  ?>


<input type="hidden" name="id" value="<?php echo $d['id']; ?>">


<input type="hidden" name="p1" value="<?php echo $d['p1']; ?>">
<input type="hidden" name="p2" value="<?php echo $d['p2']; ?>">
<input type="hidden" name="p3" value="<?php echo $d['p3']; ?>">
<input type="hidden" name="p4" value="<?php echo $d['p4']; ?>">
<input type="hidden" name="p5" value="<?php echo $d['p5']; ?>">
<input type="hidden" name="p6" value="<?php echo $d['p6']; ?>">
<input type="hidden" name="p7" value="<?php echo $d['p7']; ?>">
<input type="hidden" name="p8" value="<?php echo $d['p8']; ?>">
<input type="hidden" name="p9" value="<?php echo $d['p9']; ?>">
<input type="hidden" name="p10" value="<?php echo $d['p10']; ?>">

 
	  


<?php  }  ?>
						
<?php  $i++;}  ?>

</div>
<br><br>
<h5 class="page-header">Add To:</h5>

<select name="state22" class="form-control country22" required>
                                   <option value="">--Select--</option>
								   
								                                    
								  <option value="Resort Tents">Resort Tents</option>
									<option value="Projects">Projects</option>
								   
								   
								
                                  
								  </select>



<script>

$(document).ready(function(){
    $("select.country22").change(function(){
        var selectedCountry22 = $(".country22 option:selected").val();
		
		console.log(selectedCountry22);
        $.ajax({
            type: "POST",
            url: "categoryAjaxOneTransfer22.php",
            data: { country22 : selectedCountry22 } 
        }).done(function(data){
            $("#response22").html(data);
        });
    });
});

</script>
<br><br>
<div id="response22">


</div>

			<br><br>			



<input type="submit" class="btn btn-success btn-lg" name="sub" value="Transfer"><br><br>
						
			
						</div>
						
						 