<?php
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Edit Counter";

   $id = $_GET["id"];
   $Result = mysqli_query($con, "SELECT * FROM counters WHERE id=$id");
   $Counter = mysqli_fetch_assoc($Result);

   if (isset($_POST['save']))
   {
      $Title   = $_POST['counter_title'];
      $Suffix  = $_POST['counter_suffix'];
      $Number  = $_POST['counter_number'];
      $Icon    = $_POST['counter_icon'];
      $Order   = $_POST['display_order'];
      $Status  = $_POST['counter_status'];
      
      $CheckDuplicate = mysqli_query($con, "SELECT * FROM counters WHERE title='$Title' AND id!='$id'");
      if(mysqli_num_rows($CheckDuplicate) > 0)
      {
         $_SESSION['BannerColor'] = "background-color:#FF0000;";
         $_SESSION['Message'] = "Counter already exists!";
         echo "<script>window.location.href='edit-counter.php?id=$id';</script>";
         exit;
      }

      mysqli_query($con, "UPDATE counters SET title='$Title', suffix='$Suffix', number='$Number', icon='$Icon', display_order='$Order', status='$Status' WHERE id=$id");
          
      $_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='edit-counter.php?id=$id';</script>";
      exit;
   }
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action="" enctype="multipart/form-data" method="post">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Edit Counter</h1>
                        <div class="listing-breadcrumb">
                           <span>Home</span><span class="crumb-sep">&gt;</span><span>Counters</span><span class="crumb-sep">&gt;</span><span>Edit Counter</span>
                        </div>
                     </div>

                     <div class="listing-cta">
                        <a href="counters-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Counters</a>
                        <button type="submit" class="btn btn-success btn-sm" name="save"><i class="feather icon-save"></i> Save Counter</button>
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
                        <div class="card">
                           <div class="card-header">Counter Information</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Icon <span class="required">*</span></label>
                                       <div class="counter-icon-box">
                                          <div class="counter-icon-preview">
                                             <span class="material-icons" id="counter_icon_preview"><?php echo $Counter['icon']; ?></span>
                                          </div>
                                          <input type="hidden" name="counter_icon" id="counter_icon_input" required>
                                          <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#iconPickerModal"><i class="feather icon-edit"></i> Change Icon</button>
                                          <div class="counter-icon-help" id="selected_icon_name">Selected: home</div>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Title <span class="required">*</span></label>
                                       <input type="text" class="form-control banner-form-control" name="counter_title" id="counter_title" maxlength="100" placeholder="Enter counter title" value="<?php echo $Counter['title']; ?>" required>
                                       <div class="counter-char-counter"><span id="title_char_count">0</span>/100</div>
                                    </div>
                                 </div>

                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Number <span class="required">*</span></label>
                                       <input type="number" class="form-control banner-form-control" name="counter_number" id="counter_number" placeholder="Enter numeric value only" value="<?php echo $Counter['number']; ?>" required>
                                       <div class="counter-char-counter"><span id="number_char_count">0</span>/10</div>
                                    </div>
                                 </div>

                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Suffix</label>
                                       <input type="text" class="form-control banner-form-control" name="counter_suffix" id="counter_suffix" maxlength="10" placeholder="e.g. +, Years, Projects" value="<?php echo $Counter['suffix']; ?>">
                                       <div class="counter-char-counter"><span id="suffix_char_count">0</span>/10</div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row mt-20">
                     <div class="col-lg-6 col-md-6">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Display Order <span class="required">*</span></label>
                                 <input type="number" class="form-control banner-form-control" name="display_order" id="display_order" min="0" required value="<?php echo $Counter['display_order']; ?>">
                                 <div class="counter-help-text">Lower numbers will display first</div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6 col-md-6">
                        <div class="card">
                           <div class="card-body">
                              <div class="form-group mb-0">
                                 <label class="banner-form-label">Status <span class="required">*</span></label>
                                 <select class="form-control banner-form-control" name="counter_status" id="counter_status" required>
                                    <option value="Active" <?php echo ($Counter["status"] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="Inactive" <?php echo ($Counter["status"] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                 </select>
                                 <div class="counter-help-text">Show or hide this counter on the website</div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $('#counter_title').on('input', function() {
         $('#title_char_count').text($(this).val().length);
      });
      $('#counter_number').on('input', function() {
         $('#number_char_count').text($(this).val().length);
      });
      $('#counter_suffix').on('input', function() {
         $('#suffix_char_count').text($(this).val().length);
      });

      var iconList = [
         'home', 'apartment', 'cottage', 'house', 'hotel',
         'groups', 'people', 'person', 'person_outline', 'face',
         'verified', 'badge', 'workspace_premium', 'emoji_events', 'star',
         'public', 'language', 'location_on', 'map', 'place',
         'construction', 'foundation', 'build', 'architecture', 'engineering',
         'trending_up', 'show_chart', 'timeline', 'insights', 'analytics',
         'favorite', 'thumb_up', 'mood', 'support_agent', 'handshake',
         'calendar_today', 'schedule', 'access_time', 'history', 'event'
      ];

      var $grid = $('#icon_grid');
      $.each(iconList, function(i, name) {
         $grid.append(
            '<button type="button" class="icon-picker-item" data-icon="' + name + '" title="' + name + '">' +
               '<span class="material-icons">' + name + '</span>' +
               '<span class="icon-picker-label">' + name + '</span>' +
            '</button>'
         );
      });

      $(document).on('click', '.icon-picker-item', function() {
         var iconName = $(this).data('icon');
         $('#counter_icon_input').val(iconName);
         $('#counter_icon_preview').text(iconName);
         $('#selected_icon_name').text('Selected: ' + iconName);
         var modalEl = document.getElementById('iconPickerModal');
         var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
         modal.hide();
      });

      $('#icon_search').on('input', function() {
         var term = $(this).val().toLowerCase();
         $('.icon-picker-item').each(function() {
            var name = $(this).data('icon').toLowerCase();
            $(this).toggle(name.indexOf(term) !== -1);
         });
      });
   });
</script>

<div class="modal fade" id="iconPickerModal" tabindex="-1" aria-labelledby="iconPickerModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="iconPickerModalLabel">Select Material Icon</h5>
            <a href="https://fonts.google.com/icons" target="_blank" class="btn btn-link btn-sm">Browse all icons <i class="feather icon-external-link"></i></a>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <input type="text" class="form-control mb-3" id="icon_search" placeholder="Search icons...">
            <div class="icon-picker-grid" id="icon_grid"></div>
         </div>
      </div>
   </div>
</div>

<?php include_once('common/footer.php'); ?>
