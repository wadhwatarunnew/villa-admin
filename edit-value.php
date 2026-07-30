<?php $PageTitle = "Villatent: Edit Feature"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action="" enctype="multipart/form-data" method="post">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Edit Feature</h1>
                        <p class="listing-subtitle">Update feature details displayed in the Why Choose Us section.</p>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Our Values</span><span class="crumb-sep">&gt;</span><span>Edit Feature</span>
                        </div>
                     </div>
                     <div class="listing-cta">
                        <a href="values-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to List</a>
                        <input type="submit" class="btn btn-success btn-sm" name="update_feature" value="Update Feature">
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">Feature Information</div>
                           <div class="card-body">
                              <div class="row align-items-center">
                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Icon <span class="required">*</span></label>
                                       <div class="counter-icon-box">
                                          <div class="counter-icon-preview">
                                             <span class="material-icons" id="value_icon_preview">verified</span>
                                          </div>
                                          <input type="hidden" name="value_icon" id="value_icon_input" value="verified" required>
                                          <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#iconPickerModal"><i class="feather icon-edit"></i> Change Icon</button>
                                          <div class="counter-icon-help" id="selected_icon_name">Selected: verified</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Title <span class="required">*</span></label>
                                       <input type="text" class="form-control banner-form-control" name="title" id="title" maxlength="50" value="Quality First" placeholder="Enter feature title" required>
                                       <div class="counter-char-counter"><span id="title_char_count">13</span>/50</div>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-md-12">
                                    <div class="form-group">
                                       <label class="banner-form-label">Description <span class="required">*</span></label>
                                       <textarea name="description" id="description" class="form-control banner-form-control" rows="3" maxlength="150" placeholder="Enter description..." required>We use premium fabrics and materials to ensure unmatched durability.</textarea>
                                       <div class="counter-char-counter"><span id="desc_char_count">72</span>/150</div>
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
                                 <input type="number" class="form-control banner-form-control" name="display_order" id="display_order" value="1" min="0" required>
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
                                 <select class="form-control banner-form-control" name="status" id="status" required>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
                                 </select>
                                 <div class="counter-help-text">Show or hide this feature on the website</div>
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
   $(document).ready(function(){
      $('#title').on('input', function(){
         $('#title_char_count').text($(this).val().length);
      });

      $('#description').on('input', function(){
         $('#desc_char_count').text($(this).val().length);
      });

      var iconList = [
         'verified', 'gpp_good', 'check_circle', 'shield', 'workspace_premium',
         'brush', 'design_services', 'palette', 'format_paint', 'architecture',
         'eco', 'energy_savings_leaf', 'recycling', 'spa', 'nature',
         'diversity_3', 'groups', 'people', 'support_agent', 'handshake',
         'access_time_filled', 'schedule', 'timer', 'event_available', 'alarm',
         'support', 'headset_mic', 'live_help', 'person_pin', 'call'
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
         $('#value_icon_input').val(iconName);
         $('#value_icon_preview').text(iconName);
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
