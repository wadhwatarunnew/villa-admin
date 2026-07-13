<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Villatent: Manage gallery</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="stylesheet" href="css/feather.css"/>
      <link rel="stylesheet" href="css/font-awesome.min.css"/>
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
                              <div class="card-header">Manage Gallery
                  
                              </div>
                              <div class="card-body">
                                 <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                            <th>Sr. No</th>
                                            <th>Image Title</th>
                                            <th>Image</th>
                                            <th>Url</th>
                                            <th>Gallery Order</th>
                                            <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr role="row">
                                             <td>1</td>
                                             <td>Resort-Tent-Manufacturer-in-Maldive</td>
                                             <td>
                                                <img src="../uploads/pageimages/Bali-resort-tents.JPG" class="img-thumbnail" height="64" width="64">
                                             </td>
                                             <td>
                                             <td>2</td>
                                             <td>
                                                <a href="#">
                                                <button class="btn btn-success btn-sm" type="button"><i class="feather icon-edit"></i></button>
                                                </a> 
                                                <a href="#">
                                                <button class="btn btn-danger btn-sm" type="button"><i class="feather icon-trash-2"></i></button>
                                                </a>
                                             </td>
                                          </tr>
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
      <!---->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <!---->
   </body>
</html>