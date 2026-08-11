<?php
   include "db.php";
   include_once('common/header.php');
   require_once('common/pagination.class.php');
   $PageTitle = "Villatent: YouTube List Page";
   $perPage = new PerPage();

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM youtube_video WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='youtube-list-page.php';</script>";
      exit;
   }

   $sql = "SELECT * FROM youtube_video ORDER BY id DESC";
   $paginationlink = "youtube-list-page.php?page=";    
   $pagination_setting = "all-links";
    
   $page = 1;
   if(!empty($_GET["page"]))
   {
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
?>

<body id="pagination-result">
   <div class="pcoded-content">
      <div class="pcoded-inner-content">
         <div class="main-body">
            <div class="page-wrapper">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>YouTube Videos</h1>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>YouTube Videos</span>
                        </div>
                     </div>

                     <div class="listing-cta">
                        <a href="youtube-inner-page.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Video</a>
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
                        <div class="table-responsive">
                           <table class="table table-bordered listing-table">
                              <thead>
                                 <tr>
                                    <th>Sr. No</th>
                                    <th>Video Name</th>
                                    <th>Youtube Url</th>
                                    <th>Video Image</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php while($b = mysqli_fetch_assoc($query4)) { ?>
                                 <tr role="row">
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $b['title'];?></td>
                                    <td><?php echo $b['youtube_url'];?></td>
                                    
                                    <?php if(!$b['image']) { ?>
                                       <td>
                                          <img src="<?php echo $b['local_path']; ?>" class="img-thumbnail" height="64" width="64">
                                       </td>
                                    <?php	} else { ?>
                                       <td>
                                          <img src="<?php echo $b['image']; ?>" class="img-thumbnail" height="64" width="64">
                                       </td>
                                    <?php  }  ?>
                                    
                                    <?php
                                       $hasTitle = trim((string)$b['title']) !== '';
                                       $hasImage = trim((string)$b['image']) !== '' || trim((string)$b['local_path']) !== '';
                                       $statusLabel = ($hasTitle && $hasImage) ? 'Published' : 'Draft';
                                       $statusClass = ($statusLabel === 'Published') ? 'status-published' : 'status-draft';
                                    ?>

                                    <td><span class="status-badge <?php echo $statusClass; ?>"><?php echo $statusLabel; ?></span></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-youtube.php?id=<?php echo $b['id']; ?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a> 

                                          <a href="youtube-list-page.php?id=<?php echo $b['id']; ?>" onclick="return confirm('Are you sure you want to delete this video?')">
                                             <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                          </a>
                                       </div>
                                    </td>
                                 </tr>
                                 <?php $i++; }  ?>
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
</body>

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