<?php 
   include "db.php";
   include_once('common/header.php');
   require_once('common/pagination.class.php');
   $PageTitle = "Villatent: Quotes List Page";
   $perPage = new PerPage();

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM quote_requests WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='quotes-list.php';</script>";
      exit;
   }
?>

<body id="pagination-result">
   <div class="pcoded-content">
      <div class="pcoded-inner-content">
         <div class="main-body">
            <div class="page-wrapper">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Quotes</h1>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Quotes</span>
                        </div>
                     </div>
                  </div>

                  <?php if (!empty($_SESSION['Message'])) {
                     echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
                              . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
                              . "</div>";

                     unset($_SESSION['Message']);
                     unset($_SESSION['BannerColor']);
                  } ?>
                  <div class="row">
                     <div class="col-sm-12">
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th>Sr. No</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Mobile Number</th>
                                          <th>Country</th>
                                          <th>Tent Category</th>
                                          <th>Location</th>
                                          <th>Timeline</th>
                                          <th>Quantity</th>
                                          <th>Message</th>
                                          <th>Created At</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php
                                          $sql = "SELECT * FROM quote_requests ORDER BY id DESC";
                                          $paginationlink = "quotes-list.php?page=";    
                                          $pagination_setting = "all-links";
                                          
                                          $page = 1;
                                          if(!empty($_GET["page"])) {
                                            $page = $_GET["page"];
                                          }

                                          $start = ($page-1)*$perPage->perpage;
                                          if($start < 0) $start = 0;

                                          $query =  $sql . " limit " . $start . "," . $perPage->perpage;
                                          $totalCount = mysqli_query($con,$sql);
                                          $query4 = mysqli_query($con,$query);

                                          if(empty($_GET["rowcount"]))
                                          {
                                             $_GET["rowcount"] = mysqli_num_rows($totalCount);
                                          }

                                          $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);
                                          $i = 1;	
                                          if($page > 1)
                                          {
                                             $i = 10*($page - 1) + 1;
                                          }

                                          if(mysqli_num_rows($query4))
                                          {
                                             while($b = mysqli_fetch_assoc($query4)) {
                                       ?>
                                    
                                             <tr role="row">
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $b['name']; ?></td>
                                                <td><?php echo $b['email']; ?></td>
                                                <td><?php echo $b['phone']; ?></td>
                                                <td><?php echo $b['country']; ?></td>
                                                <td><?php echo $b['tent_category']; ?></td>
                                                <td><?php echo $b['project_location']; ?></td>
                                                <td><?php echo ($b['date'] != '0000-00-00' && $b['timeline'] != '') ? date("d-m-Y", strtotime($b['timeline'])) : '-'; ?></td>
                                                <td><?php echo $b['quantity']; ?></td>
                                                <td><?php echo $b['message']; ?></td>
                                                <td><?php echo ($b['created_at'] != '0000-00-00' && $b['timeline'] != '') ? date("d-m-Y g:i A", strtotime($b['created_at'])) : '-'; ?></td>
                                                <td>
                                                   <div class="table-actions">
                                                      <a href="quotes-list.php?id=<?php echo $b['id']; ?>" onclick="return confirm('Are you sure you want to delete this quote?');">
                                                         <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                                      </a>
                                                   </div>
                                                </td>
                                             </tr>
                                          <?php $i++; }
                                       } else { ?>
                                          <tr role="row">
                                             <td colspan="12"><center>No record found.</center></td>
                                          </tr>
                                       <?php } ?>
                                    </tbody>
                                 </table>
                                 <input type="hidden" name="rowcount" id="rowcount" value="<?php echo $_GET["rowcount"]; ?>" />
                           
                                 <?php if(!empty($perpageresult) && $_GET["rowcount"] > 10) { ?>
                                   <div id="pagination"><?php print_r($perpageresult); ?> </div>
                                 <?php } ?>
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
</div>

<!---->
<script>
   function getresult(url) {
      $.ajax({
         url: url,
         type: "GET",
         data:  {rowcount:$("#rowcount").val(),"pagination_setting":"all-links"},
         beforeSend: function(){$("#overlay").show();},
         success: function(data){
            $("#pagination-result").html('');
            $("#pagination-result").html(data);
            setInterval(function() {$("#overlay").hide(); },500);
         },
         error: function() 
         {}       
      });
   }
</script>
<!---->
<?php include_once('common/footer.php'); ?>