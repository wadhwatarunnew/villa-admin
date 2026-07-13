<?php $PageTitle = "Villatent: Contact List Page"; ?>
<?php include_once('common/header.php'); ?>
<body id="pagination-result">
   <div class="pcoded-content">
      <div class="pcoded-inner-content">
         <div class="main-body">
            <div class="page-wrapper">
               <div class="page-body">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">All Queries
                             <div class="addNew">
                               
                             </div>
                          </div>
                          <div class="card-body">
                           <div class="table-responsive">
                              <table class="table table-bordered">
                                 <thead>
                                    <tr>
                                     <th>Sr. No</th>
                                     <th>Date</th>
                                     <th>Name</th>
                                     <th>Email</th>
                                     <th>City</th>
                                     <th>Mobile Number</th>
                                     <th>Message</th>
                                     <th>IP Address</th>
                                     <th>IP City</th>
                                     <th>IP State</th>
                                     <th>IP Country</th>
                                     <th>IP Lat/Long</th>

                                     <th>Action</th>
                                  </tr>
                               </thead>
                               <tbody>
                                 
                                 <?php

                                 include "db.php";
                                 require_once('common/pagination.class.php');
                                 $perPage = new PerPage();

                                 $sql = "select * from contact_query ORDER BY id DESC";
                                 $paginationlink = "contact-us-list.php?page=";    
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

                                if(empty($_GET["rowcount"])) {
                                   $_GET["rowcount"] = mysqli_num_rows($totalCount);
                                }

                                $perpageresult = $perPage->getAllPageLinks($_GET["rowcount"], $paginationlink,$pagination_setting);
                                $i = 1;	
                                if($page > 1)
                                {
                                   $i = 10*($page - 1) + 1;
                                }
                                while($b=mysqli_fetch_assoc($query4)){

                                 ?>
                                 
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo ($b['date'] != '0000-00-00' && $b['date'] != '') ? date("d-m-Y", strtotime($b['date'])) : '-'; ?></td>
                                    <td><?php echo $b['name']; ?></td>
                                    <td><?php echo $b['email']; ?></td>
                                    
                                    <td>
                                       <?php echo $b['city']; ?>
                                    </td>
                                    <td><?php echo $b['mobile']; ?></td>
                                    <td><?php echo $b['message']; ?></td>
                                    <td><?php echo $b['ip']; ?></td>
                                    
                                    <td><?php echo $b['l_city']; ?></td>
                                    
                                    <td><?php echo $b['l_state']; ?></td>
                                    
                                    <td><?php echo $b['l_country']; ?></td>

                                    <td><?php echo $b['latitude']; ?>/<?php echo $b['longitude']; ?></td>
                                    
                                    <td>   
                                       <a href="delete-query.php?id=<?php echo $b['id']; ?>">
                                          <button class="btn btn-danger btn-sm" type="button"><i class="feather icon-trash-2"></i></button>
                                       </a>
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