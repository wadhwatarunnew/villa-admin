<?php
   include "db.php";
   session_start();

   $TotalProjects = $BlogsCount = $YoutubeVideosCount = 0;
   $ResortTentsArray = $ProjectsArray = array();
   $ResortTentsResult = mysqli_query($con, "SELECT category, COUNT(*) AS TotalCount FROM `resort_types` GROUP BY category");
   if(mysqli_num_rows($ResortTentsResult) > 0)
   {
      $i = 0;
      while($ResortTentsRow = mysqli_fetch_object($ResortTentsResult))
      {
         $ResortTentsArray[$ResortTentsRow->category] = $ResortTentsRow->TotalCount;
         $i++;
      }
   }

   $ProjectsResult = mysqli_query($con, "SELECT category, COUNT(*) AS TotalCount FROM `project_types` GROUP BY category");
   if(mysqli_num_rows($ProjectsResult) > 0)
   {
      $i = 0;
      while($ProjectRow = mysqli_fetch_object($ProjectsResult))
      {
         $ProjectsArray[$ProjectRow->category] = $ProjectRow->TotalCount;
         $TotalProjects += $ProjectRow->TotalCount;
         $i++;
      }
   }

   $BlogsResult = mysqli_query($con, "SELECT COUNT(*) AS TotalCount FROM blog_inner_content");
   $BlogsCount = mysqli_fetch_object($BlogsResult)->TotalCount;

   $YoutubeResult = mysqli_query($con, "SELECT COUNT(*) AS TotalCount FROM youtube_video");
   $YoutubeVideosCount = mysqli_fetch_object($YoutubeResult)->TotalCount;

?>

<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                     <div class="col-sm-12 col-xs-12 mb-4">
                         <div class="heading-wrapper">
                             Resort Tents
                         </div>
                     </div> 
                </div>
               <div class="row">
                  <?php 
                     $ResortTentsCategory = mysqli_query($con, "SELECT title, color FROM resort_category GROUP BY title ORDER BY order_no");
                     if(mysqli_num_rows($ResortTentsCategory) > 0)
                     {
                        while($CategoryRow = mysqli_fetch_object($ResortTentsCategory))
                        { 
                           $CategoryID = str_replace(" ", "_", $CategoryRow->title);
                        ?>
                           <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mb-4 <?php echo $CategoryID; ?>">
                              <div class="card card-raised widget-flat" style="color: <?php echo ($CategoryRow->color!='') ? $CategoryRow->color : '#6c757d'; ?>;">
                                 <div class="card-body">
                                   <h5 class="text-muted fw-normal mt-0" title="Resort Tents"><?php echo $CategoryRow->title; ?></h5>
                                   <h3 class="mt-3 mb-3" id="<?php echo $CategoryID; ?>" style="color: <?php echo ($CategoryRow->color!='') ? $CategoryRow->color : '#6c757d'; ?>;"><?php echo isset($ResortTentsArray[$CategoryRow->title]) ? $ResortTentsArray[$CategoryRow->title] : 0; ?></h3>
                                    </div> 
                              </div> 
                           </div>
                     <?php } 
                     }
                  ?>
               </div>

                <div class="row">
                     <div class="col-sm-12 col-xs-12 mb-4">
                         <div class="heading-wrapper">
                             Projects
                         </div>
                     </div> 
                </div>
               <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4">
                     <div class="card card-raised widget-flat text-muted">
                        <div class="card-body">
                           <h5 class="text-muted fw-normal mt-0" title="Total Projects">Total Projects</h5>
                           <h3 class="mt-3 mb-3"><?php echo $TotalProjects; ?></h3>  
                        </div> 
                     </div> 
                  </div>

                  <?php 
                     $ProjectsCategory = mysqli_query($con, "SELECT title, color FROM project_category GROUP BY title ORDER BY order_no");
                     if(mysqli_num_rows($ProjectsCategory) > 0)
                     {
                        while($CategoryRow = mysqli_fetch_object($ProjectsCategory))
                        { 
                           $CategoryID = str_replace(" ", "_", $CategoryRow->title);
                        ?>
                           <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 mb-4 <?php echo $CategoryID; ?>">
                              <div class="card card-raised widget-flat"  style="color: <?php echo ($CategoryRow->color!='') ? $CategoryRow->color : '#6c757d'; ?>;">
                                 <div class="card-body">
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers"><?php echo $CategoryRow->title; ?></h5>
                                    <h3 class="mt-3 mb-3" id="<?php echo $CategoryID; ?>" style="color: <?php echo ($CategoryRow->color!='') ? $CategoryRow->color : '#6c757d'; ?>;"><?php echo isset($ProjectsArray[$CategoryRow->title]) ? $ProjectsArray[$CategoryRow->title] : 0; ?></h3>  
                                  </div> 
                              </div> 
                           </div>
                     <?php } 
                     }
                  ?>
               </div>
                 <div class="row">
                     <div class="col-sm-12 col-xs-12 mb-4">
                         <div class="heading-wrapper">
                             Others
                         </div>
                     </div> 
                </div>
               <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 blogs">
                    <div class="card card-raised widget-flat text-info">
                        <div class="card-body">
                          <h5 class="text-muted fw-normal mt-0" title="Blogs">Blogs</h5>
                          <h3 class="mt-3 mb-3" id="BlogsCount"><?php echo $BlogsCount; ?></h3>
                        </div> 
                     </div> 
                  </div>
                  
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 youtube">
                     <div class="card card-raised widget-flat text-info">
                        <div class="card-body">
                          <h5 class="text-muted fw-normal mt-0" title="Youtube Videos">Youtube Videos</h5>
                          <h3 class="mt-3 mb-3" id="YoutubeVideosCount"><?php echo $YoutubeVideosCount; ?></h3>
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
<?php include_once('common/footer.php'); ?>
<script type="text/javascript">
   $(document).ready(function(){
     $(".br-menu-link11").click(function(){
        alert('sss');
        $(".br-menu-sub").toggleClass('show')
     });

     $('#myfile').change(function(){
        var file_data = $('#myfile').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('file', file_data);
        $.ajax({
          url: "index.php",
          type: "POST",
          data: form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(data){
            var result = JSON.parse(data);
            var $messageDiv = $('#message')
            $messageDiv.hide().html(result.message);
            if(result.status) {
              $("#profileImage").attr("src",result.image);
              $messageDiv.show();
              $messageDiv.addClass('alert alert-success').fadeIn(1500);
           } else {
              $messageDiv.show();
              $messageDiv.addClass('alert alert-danger').fadeIn(1500);
           }
           setTimeout(function(){
              $messageDiv.fadeOut(1500);
           }, 3000);
        }
     });
     });
  });

   function fetchData() {
      $.ajax({
         url: 'AjaxCall.php',  // Replace with your actual URL
         type: 'GET',               // or 'POST'
         data: {
                 Action: 'GetDashboardInfo'        // Another example parameter
               },
         dataType: 'json',          // or 'html', etc.
         success: function(response) {
           var Resorts = response.Resorts;
           var Projects = response.Projects;
           var BlogsCount = response.BlogsCount;
           var YoutubeVideosCount = response.YoutubeVideosCount;

            $.each(Resorts, function(Category, Value) {
               $("#"+Category).text(Value);
            });

             $.each(Projects, function(Category, Value) {
               $("#"+Category).text(Value);
            });

           $("#BlogsCount").text(BlogsCount);
           $("#YoutubeVideosCount").text(YoutubeVideosCount);
           // Handle the response
         },
         error: function(xhr, status, error) {
           console.error('AJAX error:', status, error);
         }
      });
   }

   // Run on page load
   fetchData();

   // Run every 5 seconds (5000 ms)
   setInterval(fetchData, 5000);
</script>