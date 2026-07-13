<?php $PageTitle = "Villatent: Footer Listing"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card mb-30">
                        <div class="card-header">About us</div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="commonSection">
                                    <label>Title</label>
                                    <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Heading">
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="commonSection">
                                    <label>Content</label>
                                    <textarea name="editor1" id="editor1" rows="10" cols="80"></textarea>
                                    <script>
                                       CKEDITOR.editorConfig = function (config) {
                                          config.language = 'es';
                                          config.uiColor = '#F7B42C';
                                          config.height = 300;
                                          config.toolbarCanCollapse = true;
                                          
                                       };
                                       CKEDITOR.replace('editor1');
                                    </script>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card mb-30">
                        <div class="card-header">Quick Links </div>
                        <div class="card-body">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="commonSection">
                                    <label>Title</label>
                                    <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Heading">
                                 </div>
                              </div>
                              <div class="col-sm-12">
                                 <div class="commonSection">
                                  <label>Quick Links </label> 
                                  <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Quick Links">
                               </div>
                            </div>
                            
                            
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="row">
               <div class="col-sm-12">
                  <div class="card mb-30">
                     <div class="card-header">Resort Tents</div>
                     <div class="card-body">
                        <div class="row">
                           <div class="col-sm-12">
                              <div class="commonSection">
                                 <label>Title</label>
                                 <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Heading">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="commonSection">
                               <label>Resort Tents Listing </label> 
                               <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter tents Listing">
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
               <div class="card mb-30">
                  <div class="card-header">Get In Touch</div>
                  <div class="card-body">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="commonSection">
                              <label>Title</label>
                              <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Heading">
                           </div>
                        </div>
                        <div class="col-sm-12">
                           <div class="commonSection">
                            <label>Address </label> 
                            <textarea class="form-control" placeholder="Address"></textarea>
                         </div></div>
                         <div class="col-sm-12">
                           <div class="commonSection">
                            <label>Phone No </label> 
                            <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Phone No">
                         </div></div>
                         <div class="col-sm-12">
                           <div class="commonSection">
                            <label>Email </label> 
                            <input class="form-control" type="text" name="toptitle" id="toptitle" placeholder="Enter Email">
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
       <div class="row">
         <div class="col-sm-2">
            <div class="commonSection">
               <input type="submit" class="btn btn-success btn-lg" name="update-submit" value="Submit">
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
</div>
<?php include_once('common/footer.php'); ?>