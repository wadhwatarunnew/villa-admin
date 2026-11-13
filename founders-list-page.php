<?php
   include_once('db.php');
   $PageTitle = "Villatent: Our Founders";
   include_once('common/header.php');

   if(isset($_GET["id"]) && $_GET["id"] != '')
   {
      $id = $_GET["id"];
      mysqli_query($con, "DELETE FROM founders WHERE id='$id'");
      $_SESSION['BannerColor'] = "background-color:#FF0000;";
      $_SESSION['Message'] = "Deleted successfully!";
      echo "<script>window.location.href='founders-list-page.php';</script>";
      exit;
   }

   $CheckIfExists = mysqli_query($con, "SELECT * FROM founders_section");
   $FounderInfo = mysqli_fetch_assoc($CheckIfExists);
   if (isset($_POST['save_info']))
   {
      $Subtitle      = mysqli_real_escape_string($con, $_POST['sub_heading']);
      $Title         = mysqli_real_escape_string($con, $_POST['main_heading']);
      $Description   = mysqli_real_escape_string($con, $_POST['short_description']);

      if(mysqli_num_rows($CheckIfExists) > 0)
      {
         mysqli_query($con, "UPDATE founders_section SET subtitle='$Subtitle', title='$Title', description='$Description'");
      }
      else
      {
         mysqli_query($con, "INSERT INTO founders_section (subtitle, title, description) VALUES ('$Subtitle', '$Title', '$Description')");
      }

      $_SESSION['BannerColor'] = "background-color:#4BB543;";
      $_SESSION['Message'] = "Updated Successfully!";
      echo "<script>window.location.href='founders-list-page.php';</script>";
      exit;
   }
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Vision Behind The Villa Tent</h1>
                     <p class="listing-subtitle">Manage team/vision members displayed in this section.</p>
                     <div class="listing-breadcrumb">
                        <span>Dashboard</span><span class="crumb-sep">&gt;</span><span>About Us</span><span class="crumb-sep">&gt;</span><span>Our Founders</span>
                     </div>
                  </div>
                  <div class="listing-cta">
                     <a href="add-founder.php" class="btn btn-success btn-sm"><i class="feather icon-plus"></i> Add Member</a>
                  </div>
               </div>

               <?php if (!empty($_SESSION['Message'])) {
                  echo "<div class='alert' id='mydiv' style='" . $_SESSION['BannerColor'] . "'>"
                           . "<p style='color:white;'>" . htmlspecialchars($_SESSION['Message']) . "</p>"
                           . "</div>";

                  unset($_SESSION['Message']);
                  unset($_SESSION['BannerColor']);
               } ?>

               <form action="" method="post" id="foundersSectionForm">
                  <div class="card mb-4" style="background: #edf4ee; border: 1px solid #d5e3d8; border-radius: 18px; box-shadow: none;">
                     <div class="card-body" style="padding: 22px 22px 18px;">
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:20px; flex-wrap:wrap;">
                           <div style="display:flex; align-items:center; gap:14px;">
                              <div>
                                 <h3 style="margin:0; font-size: 30px; line-height:1.2; font-weight:700; color:#2e3b34;">Section Settings</h3>
                                 <p style="margin:4px 0 0; color:#4d5d53; font-size: 15px;">Manage the heading, subheading and description for this section.</p>
                              </div>
                           </div>
                           <button type="submit" class="btn btn-success btn-sm" name="save_info" style="border-color:#0f6d59; border-radius:12px; font-weight:700; padding:12px 22px; min-width:170px;">
                              <i class="feather icon-save"></i> Save Section
                           </button>
                        </div>

                        <div class="row mt-4" style="margin-top:24px;">
                           <div class="col-md-6">
                              <div class="form-group" style="margin-bottom: 0;">
                                 <label for="eyebrow" style="display:block; font-weight:700; margin-bottom:10px; color:#1d2b25; font-size:18px;">
                                    Eyebrow / Small Heading <span style="color:#d92d20;">*</span>
                                 </label>
                                 <!-- <input type="text" name="eyebrow" id="eyebrow" class="form-control" maxlength="100" value="Meet the Founders" required style="height:52px; border:1px solid #d7dfd9; border-radius:12px; padding:12px 14px; font-size:20px; color:#23312b; box-shadow:none;" oninput="updateCounter(this, 'eyebrowCounter', 100)"> -->
                                 <textarea name="sub_heading" id="sub_heading" class="form-control banner-form-control" rows="6" maxlength="300" placeholder="Enter sub heading..." required><?php echo $FounderInfo['subtitle']; ?></textarea>
                                 <script type="text/javascript">
                                    CKEDITOR.editorConfig = function (config) {
                                       config.language = 'es';
                                       config.uiColor = '#F7B42C';
                                       config.height = 300;
                                       config.toolbarCanCollapse = true;
                                    };
                                    CKEDITOR.replace('sub_heading');
                                 </script>
                                 <div style="display:flex; justify-content:flex-end; margin-top:8px; color:#8a938d; font-size:14px;">
                                    <span id="eyebrowCounter">17/100</span>
                                 </div>
                              </div>
                           </div>

                           <div class="col-md-6">
                              <div class="form-group" style="margin-bottom: 0;">
                                 <label for="main_heading" style="display:block; font-weight:700; margin-bottom:10px; color:#1d2b25; font-size:18px;">
                                    Main Heading <span style="color:#d92d20;">*</span>
                                 </label>
                                 <!-- <input type="text" name="main_heading" id="main_heading" class="form-control" maxlength="100" value="The Vision Behind The Villa Tent" required style="height:52px; border:1px solid #d7dfd9; border-radius:12px; padding:12px 14px; font-size:20px; color:#23312b; box-shadow:none;" oninput="updateCounter(this, 'mainHeadingCounter', 100)"> -->
                                 <textarea name="main_heading" id="main_heading" class="form-control banner-form-control" rows="6" maxlength="300" placeholder="Enter main heading..." required><?php echo $FounderInfo['title']; ?></textarea>
                                 <script type="text/javascript">
                                    CKEDITOR.editorConfig = function (config) {
                                       config.language = 'es';
                                       config.uiColor = '#F7B42C';
                                       config.height = 300;
                                       config.toolbarCanCollapse = true;
                                    };
                                    CKEDITOR.replace('main_heading');
                                 </script>
                                 <div style="display:flex; justify-content:flex-end; margin-top:8px; color:#8a938d; font-size:14px;">
                                    <span id="mainHeadingCounter">30/100</span>
                                 </div>
                              </div>
                           </div>

                           <!-- <div class="col-md-4">
                              <div class="form-group" style="margin-bottom: 0;">
                                 <label for="short_description" style="display:block; font-weight:700; margin-bottom:10px; color:#1d2b25; font-size:18px;">
                                    Short Description (Optional)
                                 </label>
                                 <textarea name="short_description" id="short_description" class="form-control" maxlength="300" rows="4" style="border:1px solid #d7dfd9; border-radius:12px; padding:12px 14px; font-size:18px; color:#23312b; box-shadow:none; resize:none;" oninput="updateCounter(this, 'shortDescriptionCounter', 300)"><?php echo $FounderInfo['description']; ?></textarea>
                                 <script type="text/javascript">
                                    CKEDITOR.editorConfig = function (config) {
                                       config.language = 'es';
                                       config.uiColor = '#F7B42C';
                                       config.height = 300;
                                       config.toolbarCanCollapse = true;
                                    };
                                    CKEDITOR.replace('short_description');
                                 </script>
                                 <div style="display:flex; justify-content:flex-end; margin-top:8px; color:#8a938d; font-size:14px;">
                                    <span id="shortDescriptionCounter">143/300</span>
                                 </div>
                              </div>
                           </div> -->
                        </div>
                     </div>
                  </div>
               </form>

               <div class="row">
                  <div class="col-sm-12">
                     <div class="table-responsive">
                        <table class="table table-bordered listing-table">
                           <thead>
                              <tr>
                                 <th>#</th>
                                 <th>Photo</th>
                                 <th>Name</th>
                                 <th>Designation</th>
                                 <th>Short Description</th>
                                 <th>Display Order</th>
                                 <th>Status</th>
                                 <th>Actions</th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php
                              $Result = mysqli_query($con, "SELECT * FROM founders");
                              $i=1;
                              while($Row = mysqli_fetch_assoc($Result)) { ?>
                                 <tr role="row">
                                    <td><?php echo $i; ?></td>
                                    <td><img src="<?php echo $Row['image']; ?>" alt="Ajay Garg" class="founder-thumb" width="200" height="50"></td>
                                    <td><?php echo $Row['name']; ?></td>
                                    <td><?php echo $Row['designation']; ?></td>
                                    <td><?php echo $Row['bio']; ?></td>
                                    <td><?php echo $Row['display_order']; ?></td>
                                    <td><span class="status-badge status-active"><?php echo $Row['status']; ?></span></td>
                                    <td>
                                       <div class="table-actions">
                                          <a href="edit-founder.php?id=<?php echo $Row['id']; ?>">
                                             <button class="btn btn-outline-success btn-sm table-action-btn" type="button"><i class="feather icon-edit"></i></button>
                                          </a>
                                          <a href="founders-list-page.php?id=<?php echo $Row['id']; ?>" onclick="return confirm('Are you sure you want to delete this?');">
                                             <button class="btn btn-outline-danger btn-sm table-action-btn" type="button"><i class="feather icon-trash-2"></i></button>
                                          </a>
                                       </div>
                                    </td>
                                 </tr>
                           <?php $i++; } ?>
                           </tbody>
                        </table>
                     </div>
                     <!-- <div class="listing-info-text">Showing 1 to 2 of 2 members</div> -->
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   function updateCounter(element, counterId, maxLength) {
      const value = element.value.length;
      document.getElementById(counterId).innerText = value + '/' + maxLength;
   }
</script>
<?php include_once('common/footer.php'); ?>
