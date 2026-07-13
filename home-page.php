<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Villatent: Home Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="css/style.css"/>
      <link rel="stylesheet" href="css/font-awesome.min.css"/>
      <link rel="stylesheet" href="css/feather.css"/>
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
                           <div class="card mb-30">
                              <div class="card-header">Seo Meta Data</div>
                              <div class="card-body">
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <div class="commonSection">
                                          <label>Meta Title</label>
                                          <textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"></textarea>
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="commonSection">
                                          <label>Meta Keyword</label>
                                          <textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Keyword"></textarea>
                                       </div>
                                    </div>
                                    <div class="col-sm-4">
                                       <div class="commonSection">
                                          <label>Meta Description</label>
                                          <textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Description"></textarea>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="card">
                              <div class="card-header">Manage Home Page</div>
                              <div class="card-body">
                                 <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>Sr.No</th>
                                             <th>Top Title</th>
                                             <th>Top Desciption</th>
                                             <th>Action</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr role="row">
                                             <td>1</td>
                                             <td class="text-capitalize">Our Luxurious Paradise!</td>
                                             <td class="text-capitalize">
                                                <p>A precise choice, we are one of the top and exclusive Luxury resort tents manufacturers and expor... </p>
                                             </td>
                                             <td>
                                                <a href="home-edit-page.php">
                                                <button class="btn btn-success" type="button"><i class="feather icon-edit"></i></button>
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