<?php
	error_reporting(0);

 	if($page && !$FileExists) { ?>
		<div class="alert" id="mydiv" style="background-color:#4BB543 ;">
	  		<p style="color:white"> Update Successfully!</p>
		</div>
	<?php } else if($FileExists) { ?>
	    <div class="alert" id="mydiv" style="background-color:#FF0000 ;">
          	<p style="color:white"> Selected image already exists!</p>
        </div> 
	<?php } else { 
	}
?>
 
<script>
	$(document).ready(function() {
		$('#mydiv').delay(2000).hide(0);
	});
</script>