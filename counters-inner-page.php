<?php $PageTitle = "Villatent: Add Counter"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <form action="" enctype="multipart/form-data" method="post">
               <div class="page-body">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Add Counter</h1>
                        <p class="listing-subtitle">Add a new counter item to be displayed on the homepage.</p>
                        <div class="listing-breadcrumb">
                           <span>Home</span><span class="crumb-sep">&gt;</span><span>Counters</span><span class="crumb-sep">&gt;</span><span>Add Counter</span>
                        </div>
                     </div>
                     <div class="listing-cta">
                        <a href="counters-list-page.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back to Counters</a>
                        <input type="submit" class="btn btn-success btn-sm" name="save_counter" value="Save Counter">
                     </div>
                  </div>

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
                                             <span class="material-icons" id="counter_icon_preview">home</span>
                                          </div>
                                          <input type="hidden" name="counter_icon" id="counter_icon_input" value="home" required>
                                          <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#iconPickerModal"><i class="feather icon-edit"></i> Change Icon</button>
                                          <div class="counter-icon-help" id="selected_icon_name">Selected: home</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Title <span class="required">*</span></label>
                                       <input type="text" class="form-control banner-form-control" name="counter_title" id="counter_title" maxlength="100" placeholder="Enter counter title" required>
                                       <div class="counter-char-counter"><span id="title_char_count">0</span>/100</div>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Number <span class="required">*</span></label>
                                       <input type="number" class="form-control banner-form-control" name="counter_number" id="counter_number" placeholder="Enter numeric value only" required>
                                       <div class="counter-char-counter"><span id="number_char_count">0</span>/10</div>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-6">
                                    <div class="form-group">
                                       <label class="banner-form-label">Suffix</label>
                                       <input type="text" class="form-control banner-form-control" name="counter_suffix" id="counter_suffix" maxlength="10" placeholder="e.g. +, Years, Projects">
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
                                 <select class="form-control banner-form-control" name="counter_status" id="counter_status" required>
                                    <option value="active" selected>Active</option>
                                    <option value="inactive">Inactive</option>
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
