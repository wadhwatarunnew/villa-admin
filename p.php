
<?php

error_reporting(0);

if (isset($_POST['sub'])){
	
$a = $_FILES['imag']['name'][0];
$b = $_FILES['imag']['name'][1];
$c = $_FILES['imag']['name'][2];

echo $a;
echo $b;
echo $c;
}

if (isset($_POST['sub1'])){
	
	 /* if (is_array($_POST['check'])) {
		 
    foreach($_POST['check'] as $value){
		
      echo $value;
	  
    }
	
	 } */
	 
	$m =  $_POST['check'][0];
	$n =  $_POST['check'][1];
	echo $m;
	echo $n;
	 
	


}

?>
<html lang="en">
   <head>
      <title>Villatent: Blog Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="stylesheet" href="css/feather.css"/>
      <link rel="stylesheet" href="css/font-awesome.min.css"/>
	  <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
	  
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	  
	  <style>
	  ul {
  list-style-type: none;
}

li {
  display: inline-block;
}

input[type="checkbox"][id^="cb"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: -1;
}
	  </style>
	  
	  </head>
   <body>
   <?php
include "db.php";

$query2= mysqli_query($con,"select * from pic where name ='resort tent' ");

while($d=mysqli_fetch_assoc($query2)){	

?>

 <form action="" method="post" enctype="multipart/form-data">
 
 <ul>
 <li>
 <input type="checkbox" id="<?php echo $d['id']; ?>" value="<?php echo $d['p1']; ?>" name="check[]" /><label for="<?php echo $d['id']; ?>"> <img src=" <?php echo $d['p1']; ?>" ></label>
   </li>
   </ul>

<?php  }  ?>

 <input type="submit" name="sub1" value="Add">
	</form>
 <br><br>
 
 <form action="" method="post" enctype="multipart/form-data">
<input name="imag[]" id="image" type="file"  multiple="multiple"  >

<input type="submit" name="sub" value="submit">

   </form>
   <script>
   
   $("#image").on("change", function() {
    if ($("#image")[0].files.length > 10) {
        alert("You can select only 10 images");
		
		document.getElementById('image').value= "";
    } 
});
   
   </script>
   
   
   
   <br><br><br>
     <?php
include "db.php";

$query2= mysqli_query($con,"select * from pic where name ='resort tent' ");

while($d=mysqli_fetch_assoc($query2)){	

?>
   <form action="" method="post" enctype="multipart/form-data">
 
 <ul>
 <li>
  <img src=" <?php echo $d['p1']; ?>" >
   </li>
   </ul>

<?php  }  ?>

 <input type="submit" name="s" value="kk">
	</form>
   
   </body>
   
   
   </html>
   
   
   
   update
   
   
   