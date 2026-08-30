<?php 
   include "db.php";
   include_once('common/header.php');
   $PageTitle = "Villatent: Home Edit Page";

   $query4 = mysqli_query($con,"SELECT * FROM home_top_section");
   $b = mysqli_fetch_assoc($query4);

   $query2 = mysqli_query($con,"SELECT * FROM home_seo_meta_data");
   $d = mysqli_fetch_assoc($query2);	

   if (isset($_POST['update-submit']))
   {
   	$page      = "Update";
      $metaTitle = $_POST['metaTitle'];
      $keyword   = $_POST['keyword'];
      $disc      = $_POST['disc'];
   	$toptitle  = mysqli_real_escape_string($con, $_POST['toptitle']);
   	$editor1   = mysqli_real_escape_string($con, $_POST['editor1']);
      $imageUrl  = $_POST["image"];
      $myFile    = $_FILES["myFile"]["name"];

      $path = "uploads/pageimages/";
      $path_original = "uploads/pageimages/";

   	if($metaTitle != '' && $keyword != '' && $disc != '')
      {
         mysqli_query($con, "UPDATE home_seo_meta_data SET title='$metaTitle', keyword='$keyword', discription='$disc' ");
      }
   	
      $Updated = false;
      if (isset($_FILES['myFile']['name']) && $_FILES['myFile']['name'] != '')
      {
         if (
            $myFile != "" &&
            (file_exists("uploads/pageimages/" . $myFile) ||
                file_exists("uploads/pageimages/addgallery/" . $myFile) ||
                file_exists(
                    "uploads/pageimages/addgallery/project/" . $myFile
                ) ||
                file_exists(
                    "uploads/pageimages/addgallery/resort/" . $myFile
                ) ||
                file_exists("uploads/pageimages/blogs/" . $myFile) ||
                file_exists("uploads/pageimages/blogs/single/" . $myFile) ||
                file_exists("uploads/pageimages/contact/" . $myFile) ||
                file_exists("uploads/pageimages/nav/" . $myFile) ||
                file_exists("uploads/pageimages/nav/category/" . $myFile) ||
                file_exists("uploads/pageimages/nav/types/" . $myFile) ||
                file_exists("uploads/pageimages/project/" . $myFile) ||
                file_exists("uploads/pageimages/project/category/" . $myFile) ||
                file_exists("uploads/pageimages/project/types/" . $myFile) ||
                file_exists("uploads/pageimages/resort/" . $myFile) ||
                file_exists("uploads/pageimages/resort/category/" . $myFile) ||
                file_exists("uploads/pageimages/resort/types/" . $myFile) ||
                file_exists("uploads/pageimages/slider/" . $myFile) ||
                file_exists("uploads/pageimages/youtube/" . $myFile))
            )
         {
            $FileExists = true;
            $_SESSION['BannerColor'] = "background-color:#FF0000;";
            $_SESSION['Message'] = "Selected image already exists!";
            echo "<script>window.location.href='home-edit-page.php';</script>";
            exit;
         }
         else
         {
            if(isset($_FILES['myFile']['name']) && $_FILES['myFile']['name'] != '')
            {
               move_uploaded_file($_FILES["myFile"]["tmp_name"], $path . $myFile);
               $ImagePath = $path_original . $myFile;
            }

   	      mysqli_query($con, "UPDATE home_top_section SET title='$toptitle', content='$editor1', image='', local_path='$ImagePath'");
            $Updated = true;
         }
      }
      else
      {
         mysqli_query($con, "UPDATE home_top_section SET title='$toptitle', content='$editor1', image='$imageUrl', local_path=''");
         $Updated = true;
      }

      if($Updated)
      {
         if (isset($_POST['quick_info']) && !empty($_POST['quick_info']))
         {
            mysqli_query($con, "DELETE FROM home_features");
            $titles = $_POST['quick_info']['title'];

            foreach ($titles as $key => $specTitle)
            {
               $title = mysqli_real_escape_string($con, $titles[$key]);
               mysqli_query($con, "INSERT INTO home_features (title) VALUES ('$title')");
            }
         }

         $_SESSION['BannerColor'] = "background-color:#4BB543;";
         $_SESSION['Message'] = "Updated Successfully!";
         echo "<script>window.location.href='home-edit-page.php';</script>";
         exit;
      }
   }
?>

<!---->
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body"> 
               <form action="" enctype="multipart/form-data" method="post" id="homeAboutForm">
                  <div class="listing-page-head">
                     <div class="listing-title-wrap">
                        <h1>Home Edit Page</h1>
                        <div class="listing-breadcrumb">
                           <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>Pages</span><span class="crumb-sep">&gt;</span><span>Home Edit</span>
                        </div>
                     </div>

                     <div class="listing-cta">
                        <a href="index.php" class="btn btn-primary btn-sm"><i class="feather icon-arrow-left"></i> Back</a>
                        <input type="submit" class="btn btn-success btn-sm" name="update-submit" value="Save" form="homeAboutForm">
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
                     <div class="col-lg-4 col-md-12">
                        <div class="card mb-30">
                           <div class="card-header">Seo Meta Data</div>
                           <div class="card-body">
                              <div class="commonSection">
                                 <label>Meta Title</label>
                                 <textarea name="metaTitle" id="metaTitle" class="form-control" required placeholder="Enter Meta Title"><?php echo $d['title']; ?></textarea>
                              </div>

                              <div class="commonSection">
                                 <label>Meta Keyword</label>
                                 <textarea name="keyword" id="metaKeyword" class="form-control" required placeholder="Enter Keyword"><?php echo $d['keyword']; ?></textarea>
                              </div>

                              <div class="commonSection">
                                 <label>Meta Description</label>
                                 <textarea name="disc" id="metaDescription" class="form-control" required placeholder="Enter Description"><?php echo $d['discription']; ?></textarea>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-8 col-md-12">
                        <div class="row">
                           <div class="col-lg-6 col-md-12">
                           <div class="card mb-30">
                              <div class="card-header">Banner Image <span class="required">*</span></div>
                                 <div class="card-body">
                                    <div class="banner-image-upload">
                                       <?php
                                          $middlePreviewImage = "images/default-profile.png";
                                          if (!empty($b['local_path'])) {
                                             $middlePreviewImage = $b['local_path'];
                                          } elseif (!empty($b['image'])) {
                                             $middlePreviewImage = $b['image'];
                                          }
                                       ?>
                                       <img src="<?php echo $middlePreviewImage; ?>" class="banner-image-preview" id="imgPreview" alt="Banner Image" onerror="this.src='images/default-profile.png';">
                                       <div class="banner-recommended-size">Recommended size: 1920x800px</div>

                                       <div class="radio-inline-group" style="margin-top: 12px;">
                                          <label for="id_radio1"><input id="id_radio1" type="radio" name="img" onclick="show1();" <?php echo ($b['image'] != '') ? 'checked' : ''; ?>>Image URL</label>
                                          <label for="id_radio2"><input id="id_radio2" type="radio" name="img" onclick="show2();" <?php echo ($b['local_path'] != '') ? 'checked' : ''; ?>>Select Image</label>
                                       </div>
                                       <div id="image_url" style="margin-top: 12px; display: <?php echo ($b['image'] != '') ? 'block' : 'none'; ?>;">
                                          <input class="form-control banner-form-control" type="text" name="image" id="image" value="<?php echo $b['image']; ?>" placeholder="Enter image URL">
                                       </div>
                                       <div id="select_image1" style="display: none; margin-top: 12px; display: <?php echo ($b['local_path'] != '') ? 'block' : 'none'; ?>">
                                          <input type="hidden" name="banner_image" value="<?php echo $b['local_path']; ?>">
                                          <input type="file" name="myFile" id="myFile" style="display: none;" accept="image/*">
                                          <div class="banner-upload-actions">
                                             <button type="button" class="btn btn-outline-secondary btn-sm" onclick="document.getElementById('myFile').click();">
                                                <i class="feather icon-upload"></i> Change Image
                                             </button>
                                             <!-- <button type="button" class="btn btn-sm btn-danger" onclick="res();">Reset Image</button> -->
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                           <div class="col-lg-6 col-md-12">
                              <div class="card mb-30">
                                 <div class="card-header">About Page</div>
                                 <div class="card-body">
                                    <div class="commonSection">
                                       <label>Title</label>
                                       <input class="form-control" type="text" name="toptitle" id="toptitle" value="<?php echo $b['title']; ?>" placeholder="Enter Heading">
                                    </div>

                                    <div class="commonSection">
                                       <label>Content</label>
                                       <textarea name="editor1" id="editor1" rows="10" cols="80"><?php echo $b['content']; ?></textarea>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">
                     <div class="col-lg-4 col-md-12">
                        <div class="card mb-30">
                           <div class="card-header d-flex justify-content-between align-items-center">
                              <span>Features List</span>
                              <button type="button" class="btn btn-outline-secondary btn-sm btn-add-entry" data-bs-toggle="modal" data-bs-target="#addItemModal">+ Add Item</button>
                           </div>
                           <div class="card-body">
                              <div class="table-responsive">
                                 <table class="table table-bordered table-sm mb-0 listing-table">
                                    <thead>
                                       <tr>
                                          <th>Title</th>
                                          <th style="width:120px;">Actions</th>
                                       </tr>
                                    </thead>
                                    <tbody id="quickInfoTableBody" data-empty-cols="3">
                                       <?php
                                          $SpecsResult = mysqli_query($con, "SELECT * FROM home_features");
                                          while($SpecsRow = mysqli_fetch_assoc($SpecsResult)) {
                                       ?>
                                          <tr>
                                             <td><input type="text" class="form-control form-control-sm" name="quick_info[title][]" value="<?php echo $SpecsRow['title']; ?>"></td>
                                             <td>
                                                <div class="action-btn-group">
                                                   <button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button>
                                                </div>
                                             </td>
                                          </tr>
                                       <?php $i++; } ?>
                                    </tbody>
                                 </table>
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
</div>

<div class="modal fade" id="addItemModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header"><h5 class="modal-title">Add Item</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
         <div class="modal-body">
            <div class="commonSection"><label>Title</label><input type="text" class="form-control" id="quickItemTitle" placeholder="Enter title"></div>
         </div>
         <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button><button type="button" class="btn btn-success" id="saveQuickItem">Add Item</button></div>
      </div>
   </div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title">Confirm Delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
         </div>
         <div class="modal-body">
            <p class="confirm-delete-text mb-0">Are you sure you want to delete?</p>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">No</button>
            <button type="button" class="btn btn-danger" id="confirmDeleteYes">Yes</button>
         </div>
      </div>
   </div>
</div>
<!---->
<?php include_once('common/footer.php'); ?>

<script type="text/javascript">
   CKEDITOR.editorConfig = function (config) {
      config.language = 'es';
      config.uiColor = '#F7B42C';
      config.height = 300;
      config.toolbarCanCollapse = true;

   };
   CKEDITOR.replace('editor1');

   (function() {
      var fileInput = document.getElementById('myFile');
      var filePreview = document.getElementById('imgPreview');
      if (!fileInput || !filePreview) {
         return;
      }

      fileInput.addEventListener('change', function() {
         if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
               filePreview.src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);
         }
      });

      var editingRowByModal = {};
      var modalConfig = {
         addItemModal: {
            tbodyId: 'quickInfoTableBody',
            saveBtnId: 'saveQuickItem',
            modeTitle: 'Add Item',
            modeEditTitle: 'Edit Item'
         }
      };

      function actionButtons() {
         return '<div class="action-btn-group"><button type="button" class="btn btn-sm btn-outline-primary btn-action-edit" title="Edit"><i class="feather icon-edit-2"></i></button><button type="button" class="btn btn-sm btn-outline-danger js-delete-row btn-action-delete" title="Delete"><i class="feather icon-trash-2"></i></button></div>';
      }

      function getDataRows(tbody) {
         if (!tbody) {
            return [];
         }
         return Array.prototype.slice.call(tbody.querySelectorAll('tr')).filter(function(row) {
            return !row.classList.contains('no-record-row');
         });
      }

      function ensureEmptyState(tbodyId) {
         var tbody = document.getElementById(tbodyId);
         if (!tbody) {
            return;
         }
         var rows = getDataRows(tbody);
         var emptyRow = tbody.querySelector('.no-record-row');
         if (rows.length === 0) {
            if (!emptyRow) {
               emptyRow = document.createElement('tr');
               emptyRow.className = 'no-record-row';
               emptyRow.innerHTML = '<td colspan="' + (tbody.getAttribute('data-empty-cols') || '3') + '">No record found. Click on Add.</td>';
               tbody.appendChild(emptyRow);
            }
         } else if (emptyRow) {
            emptyRow.remove();
         }
      }

      function createHiddenInput(name, value) {
         var input = document.createElement('input');
         input.type = 'hidden';
         input.name = name;
         input.value = value;
         return input;
      }

      function appendRow(tbodyId, title) {

          var tbody = document.getElementById(tbodyId);
          if (!title) {
              return;
          }

          var emptyRow = tbody.querySelector('.no-record-row');

          if (emptyRow) {
              emptyRow.remove();
          }

          var prefix = '';

          if (tbodyId === 'quickInfoTableBody') {
              prefix = 'quick_info';
          }

          var row = document.createElement('tr');

          // TITLE
          var titleTd = document.createElement('td');
          titleTd.textContent = title;

          titleTd.appendChild(
              createHiddenInput(prefix + '[title][]', title)
          );

          // ACTIONS
          var actionTd = document.createElement('td');
          actionTd.innerHTML = actionButtons();

          row.appendChild(titleTd);
          row.appendChild(actionTd);

          tbody.appendChild(row);

          ensureEmptyState(tbodyId);
      }

      function closeModal(id) {
         var el = document.getElementById(id);
         if (!el) {
            return;
         }
         var modal = bootstrap.Modal.getInstance(el);
         if (modal) {
            modal.hide();
         }
      }

      function openModal(id) {
         var el = document.getElementById(id);
         if (!el) {
            return;
         }
         bootstrap.Modal.getOrCreateInstance(el).show();
      }

      function setModalHeading(modalId, isEdit) {
         var modalEl = document.getElementById(modalId);
         var cfg = modalConfig[modalId];
         if (!modalEl || !cfg) {
            return;
         }
         var titleEl = modalEl.querySelector('.modal-title');
         var saveBtn = document.getElementById(cfg.saveBtnId);
         if (titleEl) {
            titleEl.textContent = isEdit ? cfg.modeEditTitle : cfg.modeTitle;
         }
         if (saveBtn) {
            saveBtn.textContent = isEdit ? 'Update' : cfg.modeTitle.replace('Add ', 'Add ');
         }
      }

      function clearAndResetModal(modalId) {
         setModalHeading(modalId, false);
         document.getElementById('quickItemTitle').value = '';
         editingRowByModal[modalId] = null;
      }

      function handleSimpleSave(modalId, title) {

          var editingRow = editingRowByModal[modalId];

          if (!title) {
              alert('Please fill all fields.');
              return;
          }

          if (editingRow) {
              var titleHidden = editingRow.cells[1].querySelector(
                  'input[type="hidden"]'
              );

              if (titleHidden) {
                  titleHidden.value = title;
              }

              editingRow.cells[2].childNodes[0].textContent = description;
          } else {

              appendRow(
                  modalConfig[modalId].tbodyId,
                  title,
              );
          }

          closeModal(modalId);
          clearAndResetModal(modalId);
      }

      document.getElementById('saveQuickItem').addEventListener('click', function() {
         handleSimpleSave(
                          'addItemModal',
                          document.getElementById('quickItemTitle').value.trim()
                      );
      });

      document.addEventListener('click', function(event) {
         var editBtn = event.target.closest('.btn-action-edit');
         if (editBtn) {
            var editRow = editBtn.closest('tr');
            var tbody = editRow ? editRow.closest('tbody') : null;
            if (!editRow || !tbody) {
               return;
            }

            if (tbody.id === 'quickInfoTableBody') {
                editingRowByModal.addItemModal = editRow;

                var title = editRow.cells[1]
                    .childNodes[0]
                    .textContent
                    .trim();

                document.getElementById('quickItemTitle').value = title;

                setModalHeading('addItemModal', true);
                openModal('addItemModal');
            }
         }

         var deleteBtn = event.target.closest('.js-delete-row');
         if (deleteBtn) {
            rowToDelete = deleteBtn.closest('tr');
            openModal('confirmDeleteModal');
         }
      });

      document.getElementById('confirmDeleteYes').addEventListener('click', function() {
         if (rowToDelete) {
            var parentTbody = rowToDelete.closest('tbody');
            rowToDelete.remove();
            if (parentTbody && parentTbody.id) {
               ensureEmptyState(parentTbody.id);
            }
         }
         rowToDelete = null;
         closeModal('confirmDeleteModal');
      });

      document.getElementById('confirmDeleteModal').addEventListener('hidden.bs.modal', function() {
         rowToDelete = null;
      });

      ['addItemModal'].forEach(function(modalId) {
         var modalEl = document.getElementById(modalId);
         if (!modalEl) {
            return;
         }
         modalEl.addEventListener('hidden.bs.modal', function() {
            clearAndResetModal(modalId);
         });
      });

      ['quickInfoTableBody'].forEach(function(tbodyId) {
         ensureEmptyState(tbodyId);
      });
   })();

   function show2()
   {
      document.getElementById('image_url').style.display = 'none';
      document.getElementById('select_image1').style.display = 'block';
   }

   function show1()
   {
      document.getElementById('select_image1').style.display = 'none';  
      document.getElementById('image_url').style.display = 'block';
   }

   function res()
   {
      document.getElementById('myFile').value= "";
   }
</script>