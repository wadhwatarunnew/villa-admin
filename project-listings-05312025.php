<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Villatent: Projects Listing</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="stylesheet" href="css/feather.css"/>
	  <link rel="stylesheet" href="css/font-awesome.min.css"/>
	  
	   <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
	  
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <body>
      <!---->
      <?php include_once('common/header.php'); ?>
      <!--sidebar-->
      <?php include_once('common/sidebar.php'); ?>
      <!---->
      <div class="pcoded-content">
         <div class="pcoded-inner-content">
            <div class="main-body">
               <div class="page-wrapper">
                  <div class="page-body">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="card">
                              <div class="card-header">Manage Project Listing
							  
							  
							  
                               <div class="addNew">
                                <a href="project-internals.php">
                                        <button class="btn btn-success btn-sm" type="button"><i class="feather icon-plus"></i> Add Internal page </button>
                                </a> 
                                </div>
                              </div><br>
							   <div class="commonSection">
							   
							   <div class="row">
							    <div class="col-md-2"></div>
							   <div class="col-md-6">
                                          
                                          <select class="form-control" name="cat" id="mySelector">
                                            <option value="" >--Select Category--</option>
											<option value="All">All</option>
											<?php
											
											include "db.php";
											
											$queryl= mysqli_query($con,"select * from project_types group by category");
											
											while($l=mysqli_fetch_assoc($queryl)){
											?>
											
                                           <option value="<?php echo $l['category']; ?>"><?php echo $l['category']; ?></option>
										   
											<?php  }  ?>
                                           
                                          </select>
										  </div>
										  
										  </div>
                                       </div>
							  
                              <div class="card-body">
                                 <div class="table-responsive">
                                    <table class="table table-bordered table-fixed" id='myTable'>
                                       <thead>
                                           <tr>
                                            <th>Sr.No</th>
                                            <th>Project Category</th>
                                            <th>Meta Title</th>
                                            <th>Meta Keyword</th>
                                            <th>Meta Descripton</th>
                                            
                                            <th>Tent Name</th>
                                            <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
									   
									   
									    <?php

include "db.php";
$i = 1;	 
$query4= mysqli_query($con,"select * from project_types");
while($b=mysqli_fetch_assoc($query4)){

?>
                                          <tr role="row">
                                             <td><?php echo $i; ?></td>
                                             <td><?php echo $b['category']; ?></td>
                                             <td><?php echo $b['metatitle']; ?></td>
                                            <td><?php echo $b['keyword']; ?></td>
                                            <td><?php echo $b['discription']; ?></td>
											
											<td><?php echo $b['title']; ?></td>
                                            
                                             <td>
                                                <a href="edit-project-types.php?id=<?php echo $b['id']; ?>">
                                                <button class="btn btn-success btn-sm" type="button"><i class="feather icon-edit"></i></button>
                                                </a> 
                                                <a href="delete-project-types.php?id=<?php echo $b['id']; ?>">
                                                <button class="btn btn-danger btn-sm" type="button"><i class="feather icon-trash-2"></i></button>
                                                </a>
                                             </td>
                                          </tr>
										  
										  <?php $i++; }  ?>
										  
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  
	  <script>

$(function() {
    //$('table').hide();
    $('#mySelector').change( function(){
      //$('table').show();
      var selection = $(this).val();
	  
	  if(selection=='All'){
		  document.location="project-listings.php";
		  
	  }else{
	  
	  console.log(selection);
      var dataset = $('#myTable').find('tr');
	  
	  var thead = $('#myTable thead').find('tr');

      dataset.each(function(index) {
        item = $(this);
        item.hide();

        var firstTd = item.find('td:nth-child(2)');
        var text = firstTd.text();
        var ids = text.split(',');

        for (var i = 0; i < ids.length; i++)
        {
            if (ids[i] == selection)
          {
            item.show();
          }
        }
      });
	  
	  thead.show();
	  
	  }
    });
});

</script>
      <!---->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <!---->
   </body>
</html>