
<?php
//error_reporting(0);
if(isset($_POST["country1"])){
    $state1 = $_POST["country1"];	 
	
}



	
	
?>
	
	
        <div>
		
		
		
            <div class="row">
               <div class="col-lg-12">
                  <h4 class="page-header"><?php  echo $state1; ?> Gallery</h4>
                  <div class="demo-gallery dark mrb35">
				  
				 
				  
				  
				  
				  
                     <ul id="lg-share-demo" class="list-unstyled"  >
					 
					 
					 
					 
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


<h4><?php echo $i;?> Addition</h4> &nbsp;&nbsp;<b>Date:</b> <?php echo $date; ?>&nbsp;&nbsp; <b>Time:</b> <?php echo $time; ?><br><br>

<form action="" method="post" enctype="multipart/form-data">
<div>
<div class="row">


<?php 


if(!$d['p1']){
	
}else{
	?>
	
	
	
               <div class="col-md-3">
	
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p1']; ?>">
                           <a href="">
						   
						   <input type="checkbox" value="p1" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p1']; ?>" alt="gallery img1" />
							 
						
							  
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						
						</div>
<?php  }  ?>
                        
						<?php 


if(!$d['p2']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1" data-src="<?php echo $d['p2']; ?>">
                           <a href="">
						   <input type="checkbox" value="p2" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p2']; ?>" alt="gallery img1" />
							
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>


<?php 


if(!$d['p3']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p3']; ?>">
                           <a href="">
						  <input type="checkbox" value="p3" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p3']; ?>" alt="gallery img1" />
							
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>

<?php 


if(!$d['p4']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p4']; ?>">
                           <a href="">
						   <input type="checkbox" value="p4" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p4']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>

<?php 


if(!$d['p5']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p5']; ?>">
                           <a href="">
						   <input type="checkbox" value="p5" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p5']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>



<?php 


if(!$d['p6']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p6']; ?>">
                           <a href="">
						   <input type="checkbox" value="p6" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p6']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>
						
						<?php 


if(!$d['p7']){
	
}else{
	?>
	
	
	<div class="col-md-3">
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1" data-src="<?php echo $d['p7']; ?>">
                           <a href="">
						   <input type="checkbox" value="p7" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p7']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>

<?php 


if(!$d['p8']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p8']; ?>">
                           <a href="">
						   <input type="checkbox" value="p8" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p8']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>


<?php 


if(!$d['p9']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1" data-src="<?php echo $d['p9']; ?>">
                           <a href="">
						   <input type="checkbox" value="p9" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p9']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>

<?php 


if(!$d['p10']){
	
}else{
	?>
	
	<div class="col-md-3">
	
					 
                        <li data-pinterest-text="Pin it1" data-tweet-text="share on twitter 1"  data-src="<?php echo $d['p10']; ?>">
                           <a href="">
						   <input type="checkbox" value="p10" name="check[]" style="width: 30px;height: 24px; "/>
						    <br>
                              <img class="img-responsive" id="galcs" src="<?php echo $d['p10']; ?>" alt="gallery img1" />
                              <div class="demo-gallery-poster" style="display:none;"> <img src="images/zoom.png" alt="zoom"> </div>
                           </a>
                        </li>
						<br>
						</div>
<?php  }  ?>


<input type="hidden" name="id" value="<?php echo $d['id']; ?>">
<input type="hidden" name="types" value="<?php echo $d['types']; ?>">

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


</div>
<br><br>
<input type="submit" class="btn btn-success btn-lg" name="j" value="Delete"><br><br>
						<hr style="height: 5px; 
            background: black;"><br>
			
						</div>
						
						</form>
						
<?php  }  ?>
						
<?php  $i++;}  ?>
						
                     </ul>
					 <hr>
					 
                  </div>
				  
               </div>
            </div>
			
					 
					
					 
					 </div>
     