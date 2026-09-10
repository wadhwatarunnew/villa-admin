<?php
   include_once('db.php');
   include_once('common/header.php');
   $PageTitle = "Villatent: Dashboard Home";

   function dashboard_e($value) {
      return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
   }

   function dashboard_format_number($value) {
      return number_format((int)$value);
   }

   function dashboard_format_percent($value, $total) {
      if ((int)$total <= 0) {
         return '0.0';
      }

      return number_format(((int)$value / (int)$total) * 100, 1);
   }

   function dashboard_fetch_category_counts($con, $tableName) {
      $counts = array();
      $sql = "SELECT category, COUNT(*) AS total_count FROM {$tableName} WHERE TRIM(IFNULL(title,'')) <> '' AND TRIM(IFNULL(category,'')) <> '' AND status='Published' GROUP BY category";
      $result = mysqli_query($con, $sql);

      if ($result) {
         while ($row = mysqli_fetch_assoc($result)) {
            $category = trim((string)$row['category']);
            if ($category !== '') {
               $counts[$category] = (int)$row['total_count'];
            }
         }
      }

      return $counts;
   }

   function dashboard_find_category_count($counts, $includeToken, $excludeToken = '') {
      foreach ($counts as $category => $count) {
         $normalized = strtolower(preg_replace('/\s+/', '', (string)$category));
         if (strpos($normalized, $includeToken) !== false) {
            if ($excludeToken !== '' && strpos($normalized, $excludeToken) !== false) {
               continue;
            }
            return (int)$count;
         }
      }

      return 0;
   }

   function dashboard_fetch_latest_rows($con, $tableName, $limit = 4) {
      $rows = array();
      $limit = (int)$limit;
      if ($limit <= 0) {
         $limit = 4;
      }

      $sql = "SELECT id, title, category, local_path, image FROM {$tableName} WHERE TRIM(IFNULL(title,'')) <> '' AND TRIM(IFNULL(category,'')) <> '' ORDER BY id DESC LIMIT {$limit}";
      $result = mysqli_query($con, $sql);

      if ($result) {
         while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
         }
      }

      return $rows;
   }

   function dashboard_row_image($row) {
      if (!is_array($row)) {
         return 'images/default-profile.png';
      }

      $localPath = isset($row['local_path']) ? trim((string)$row['local_path']) : '';
      if ($localPath !== '') {
         return $localPath;
      }

      $imageUrl = isset($row['image']) ? trim((string)$row['image']) : '';
      if ($imageUrl !== '') {
         return $imageUrl;
      }

      return 'images/default-profile.png';
   }

   function dashboard_badge_class($category) {
      $normalized = strtolower((string)$category);

      if (strpos($normalized, 'ultra') !== false) {
         return 'pill-blue';
      }
      if (strpos($normalized, 'lux') !== false) {
         return 'pill-green';
      }
      if (strpos($normalized, 'indi') !== false) {
         return 'pill-cyan';
      }
      if (strpos($normalized, 'camp') !== false) {
         return 'pill-orange';
      }

      return 'pill-blue';
   }

   $resortCounts = dashboard_fetch_category_counts($con, 'resort_types');
   $projectCounts = dashboard_fetch_category_counts($con, 'project_types');

   $tentUltraCount = dashboard_find_category_count($resortCounts, 'ultra');
   $tentLuxuryCount = dashboard_find_category_count($resortCounts, 'luxury', 'ultra');
   $tentIndianCount = dashboard_find_category_count($resortCounts, 'indian');
   $tentCampingCount = dashboard_find_category_count($resortCounts, 'camp');

   $projectInternationalCount = dashboard_find_category_count($projectCounts, 'international');
   $projectNationalCount = dashboard_find_category_count($projectCounts, 'national', 'international');

   $blogsCount = 0;
   $blogsResult = mysqli_query($con, "SELECT COUNT(*) AS total_count FROM blog_inner_content");
   if ($blogsResult) {
      $blogsRow = mysqli_fetch_assoc($blogsResult);
      if (is_array($blogsRow) && isset($blogsRow['total_count'])) {
         $blogsCount = (int)$blogsRow['total_count'];
      }
   }

   $projectAllTotal = array_sum($projectCounts);
   $projectBaseCount = $projectAllTotal - $projectInternationalCount - $projectNationalCount;
   if ($projectBaseCount < 0) {
      $projectBaseCount = 0;
   }

   $tentTotal = $tentUltraCount + $tentLuxuryCount + $tentIndianCount + $tentCampingCount;
   $projectTotal = $projectBaseCount + $projectInternationalCount + $projectNationalCount;

   $latestTents = dashboard_fetch_latest_rows($con, 'resort_types', 4);
   $latestProjects = dashboard_fetch_latest_rows($con, 'project_types', 4);

   $latestLeads = array();
   $leadResult = mysqli_query($con, "SELECT id, name, mobile, date FROM contact_query ORDER BY id DESC LIMIT 4");
   if ($leadResult) {
      while ($leadRow = mysqli_fetch_assoc($leadResult)) {
         $latestLeads[] = $leadRow;
      }
   }

   $dashboardUserName = '';
   $profileResult = mysqli_query($con, "SELECT fname, lname FROM profile_info LIMIT 1");
   if ($profileResult && mysqli_num_rows($profileResult) > 0) {
      $profileRow = mysqli_fetch_assoc($profileResult);
      $firstName = isset($profileRow['fname']) ? trim((string)$profileRow['fname']) : '';
      $lastName = isset($profileRow['lname']) ? trim((string)$profileRow['lname']) : '';
      $dashboardUserName = trim($firstName . ' ' . $lastName);
   }

   if ($dashboardUserName === '' && isset($_SESSION['u'])) {
      $sessionUser = trim((string)$_SESSION['u']);
      if ($sessionUser !== '') {
         $emailParts = explode('@', $sessionUser);
         $dashboardUserName = trim((string)$emailParts[0]);
      }
   }

   if ($dashboardUserName === '') {
      $dashboardUserName = 'Admin';
   }
?>

<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head dashboard-head-wrap">
                  <div class="listing-title-wrap">
                     <h1>Dashboard</h1>
                     <p class="listing-subtitle">Welcome back, <?php echo dashboard_e($dashboardUserName); ?>! Here's what's happening with your business.</p>
                  </div>
               </div>
               <div class="dashboard-kpi-grid mb-20">
                  <div class="dashboard-kpi-card kpi-accent-blue">
                     <div class="dashboard-kpi-icon"><span class="material-icons">villa</span></div>
                     <div class="dashboard-kpi-content">
                        <p>Ultra Luxury Resort Tent</p>
                        <h3><?php echo dashboard_format_number($tentUltraCount); ?></h3>
                     </div>
                  </div>
                  <div class="dashboard-kpi-card kpi-accent-green">
                     <div class="dashboard-kpi-icon"><span class="material-icons">holiday_village</span></div>
                     <div class="dashboard-kpi-content">
                        <p>Luxury Resort Tent</p>
                        <h3><?php echo dashboard_format_number($tentLuxuryCount); ?></h3>
                     </div>
                  </div>
                  <div class="dashboard-kpi-card kpi-accent-cyan">
                     <div class="dashboard-kpi-icon"><span class="material-icons">cabin</span></div>
                     <div class="dashboard-kpi-content">
                        <p>Indian Resort Tent</p>
                        <h3><?php echo dashboard_format_number($tentIndianCount); ?></h3>
                     </div>
                  </div>
                  <div class="dashboard-kpi-card kpi-accent-orange">
                     <div class="dashboard-kpi-icon"><span class="material-icons">terrain</span></div>
                     <div class="dashboard-kpi-content">
                        <p>Camping Tents</p>
                        <h3><?php echo dashboard_format_number($tentCampingCount); ?></h3>
                     </div>
                  </div>
                  <div class="dashboard-kpi-card kpi-accent-green">
                     <div class="dashboard-kpi-icon"><span class="material-icons">public</span></div>
                     <div class="dashboard-kpi-content">
                        <p>International Projects</p>
                        <h3><?php echo dashboard_format_number($projectInternationalCount); ?></h3>
                     </div>
                  </div>
                  <div class="dashboard-kpi-card kpi-accent-blue">
                     <div class="dashboard-kpi-icon"><span class="material-icons">map</span></div>
                     <div class="dashboard-kpi-content">
                        <p>National Projects</p>
                        <h3><?php echo dashboard_format_number($projectNationalCount); ?></h3>
                     </div>
                  </div>
                     <div class="dashboard-kpi-card kpi-accent-slate">
                        <div class="dashboard-kpi-icon"><span class="material-icons">article</span></div>
                        <div class="dashboard-kpi-content">
                           <p>Blogs</p>
                           <h3><?php echo dashboard_format_number($blogsCount); ?></h3>
                        </div>
                     </div>
               </div>

               <div class="row">
                  <div class="col-lg-6 col-md-12 mb-20">
                     <div class="card dashboard-analytic-card h-100">
                        <div class="card-header">
                           <span>Tents Overview (By Category)</span>
                        </div>
                        <div class="card-body">
                           <div class="dashboard-donut-layout">
                              <div class="dashboard-donut donut-tents">
                                 <div class="dashboard-donut-center">
                                    <span>Total</span>
                                    <strong><?php echo dashboard_format_number($tentTotal); ?></strong>
                                    <small>Tents</small>
                                 </div>
                              </div>
                              <div class="dashboard-donut-legend">
                                 <div><span class="dot dot-blue"></span>Ultra Luxury Resort Tent <strong><?php echo dashboard_format_number($tentUltraCount); ?> (<?php echo dashboard_format_percent($tentUltraCount, $tentTotal); ?>%)</strong></div>
                                 <div><span class="dot dot-green"></span>Luxury Resort Tent <strong><?php echo dashboard_format_number($tentLuxuryCount); ?> (<?php echo dashboard_format_percent($tentLuxuryCount, $tentTotal); ?>%)</strong></div>
                                 <div><span class="dot dot-cyan"></span>Indian Resort Tent <strong><?php echo dashboard_format_number($tentIndianCount); ?> (<?php echo dashboard_format_percent($tentIndianCount, $tentTotal); ?>%)</strong></div>
                                 <div><span class="dot dot-orange"></span>Camping Tents <strong><?php echo dashboard_format_number($tentCampingCount); ?> (<?php echo dashboard_format_percent($tentCampingCount, $tentTotal); ?>%)</strong></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-6 col-md-12 mb-20">
                     <div class="card dashboard-analytic-card h-100">
                        <div class="card-header">
                           <span>Projects Overview (By Type)</span>
                        </div>
                        <div class="card-body">
                           <div class="dashboard-donut-layout">
                              <div class="dashboard-donut donut-projects">
                                 <div class="dashboard-donut-center">
                                    <span>Total</span>
                                    <strong><?php echo dashboard_format_number($projectTotal); ?></strong>
                                    <small>Projects</small>
                                 </div>
                              </div>
                              <div class="dashboard-donut-legend">
                                 <div><span class="dot dot-charcoal"></span>International Projects <strong><?php echo dashboard_format_number($projectInternationalCount); ?> (<?php echo dashboard_format_percent($projectInternationalCount, $projectTotal); ?>%)</strong></div>
                                 <div><span class="dot dot-gray"></span>National Projects <strong><?php echo dashboard_format_number($projectNationalCount); ?> (<?php echo dashboard_format_percent($projectNationalCount, $projectTotal); ?>%)</strong></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-4 col-md-12 mb-20">
                     <div class="card dashboard-list-card h-100">
                        <div class="card-header dashboard-list-header">
                           <div class="dashboard-list-title-wrap">
                              <span>Most Viewed Tents</span>
                           </div>
                        </div>
                        <div class="card-body p-0">
                           <div class="table-responsive">
                              <table class="table dashboard-mini-table mb-0">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Tent Name</th>
                                       <th>Category</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php for ($i = 0; $i < 4; $i++) { ?>
                                       <?php $row = isset($latestTents[$i]) ? $latestTents[$i] : null; ?>
                                       <tr>
                                          <td><?php echo $i + 1; ?></td>
                                          <td>
                                             <div class="dashboard-item-cell">
                                                <img src="<?php echo dashboard_e(dashboard_row_image($row)); ?>" alt="Tent" onerror="this.src='images/default-profile.png';">
                                                <span><?php echo $row ? dashboard_e($row['title']) : '-'; ?></span>
                                             </div>
                                          </td>
                                          <td>
                                             <?php if ($row) { ?>
                                                <span class="dashboard-pill <?php echo dashboard_badge_class($row['category']); ?>"><?php echo dashboard_e($row['category']); ?></span>
                                             <?php } else { ?>
                                                -
                                             <?php } ?>
                                          </td>
                                       </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-4 col-md-12 mb-20">
                     <div class="card dashboard-list-card h-100">
                        <div class="card-header dashboard-list-header">
                           <div class="dashboard-list-title-wrap">
                              <span>Most Viewed Projects</span>
                           </div>
                        </div>
                        <div class="card-body p-0">
                           <div class="table-responsive">
                              <table class="table dashboard-mini-table mb-0">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Project Name</th>
                                       <th>Category</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php for ($i = 0; $i < 4; $i++) { ?>
                                       <?php $row = isset($latestProjects[$i]) ? $latestProjects[$i] : null; ?>
                                       <tr>
                                          <td><?php echo $i + 1; ?></td>
                                          <td>
                                             <div class="dashboard-item-cell">
                                                <img src="<?php echo dashboard_e(dashboard_row_image($row)); ?>" alt="Project" onerror="this.src='images/default-profile.png';">
                                                <span><?php echo $row ? dashboard_e($row['title']) : '-'; ?></span>
                                             </div>
                                          </td>
                                          <td>
                                             <?php if ($row) { ?>
                                                <span class="dashboard-pill <?php echo dashboard_badge_class($row['category']); ?>"><?php echo dashboard_e($row['category']); ?></span>
                                             <?php } else { ?>
                                                -
                                             <?php } ?>
                                          </td>
                                       </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-4 col-md-12 mb-20">
                     <div class="card dashboard-list-card h-100">
                        <div class="card-header dashboard-list-header">
                           <div class="dashboard-list-title-wrap">
                              <span>Recent Leads</span>
                           </div>
                        </div>
                        <div class="card-body p-0">
                           <div class="table-responsive">
                              <table class="table dashboard-mini-table mb-0">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Name</th>
                                       <th>Phone</th>
                                       <th>Date</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php for ($i = 0; $i < 4; $i++) { ?>
                                       <?php $row = isset($latestLeads[$i]) ? $latestLeads[$i] : null; ?>
                                       <tr>
                                          <td><?php echo $i + 1; ?></td>
                                          <td><?php echo $row ? dashboard_e($row['name']) : '-'; ?></td>
                                          <td><?php echo $row ? dashboard_e($row['mobile']) : '-'; ?></td>
                                          <td>
                                             <?php
                                             if ($row && !empty($row['date']) && $row['date'] !== '0000-00-00') {
                                                echo dashboard_e(date('d M Y', strtotime($row['date'])));
                                             } else {
                                                echo '-';
                                             }
                                             ?>
                                          </td>
                                       </tr>
                                    <?php } ?>
                                 </tbody>
                              </table>
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

<script>
var labels = <?php echo json_encode($ChartLabels); ?>;
var leadSeries = <?php echo json_encode($LabelSeries); ?>;

(function () {

   function drawLeadsOverviewChart() {
      var canvas = document.getElementById('leadsOverviewChart');
      if (!canvas) {
         return;
      }

      var parentWidth = canvas.parentElement.clientWidth;
      if (parentWidth < 320) {
         parentWidth = 320;
      }

      canvas.width = parentWidth;
      canvas.height = 250;
      
      var ctx = canvas.getContext('2d');
      // var callSeries = [2, 5, 12, 9, 15, 13, 27];

      var padding = { top: 18, right: 16, bottom: 28, left: 30 };
      var chartW = canvas.width - padding.left - padding.right;
      var chartH = canvas.height - padding.top - padding.bottom;
      var maxY = 50;

      ctx.clearRect(0, 0, canvas.width, canvas.height);

      ctx.strokeStyle = '#e9ecef';
      ctx.lineWidth = 1;
      for (var g = 0; g <= 5; g++) {
         var gy = padding.top + (chartH / 5) * g;
         ctx.beginPath();
         ctx.moveTo(padding.left, gy);
         ctx.lineTo(padding.left + chartW, gy);
         ctx.stroke();
      }

      ctx.fillStyle = '#6c757d';
      ctx.font = '11px Arial';
      ctx.textAlign = 'center';
      for (var i = 0; i < labels.length; i++) {
         var lx = padding.left + (chartW / (labels.length - 1)) * i;
         ctx.fillText(labels[i], lx, canvas.height - 8);
      }

      function drawSeries(data, color) {
         ctx.strokeStyle = color;
         ctx.lineWidth = 2;
         ctx.beginPath();
         for (var j = 0; j < data.length; j++) {
            var x = padding.left + (chartW / (data.length - 1)) * j;
            var y = padding.top + chartH - (data[j] / maxY) * chartH;
            if (j === 0) {
               ctx.moveTo(x, y);
            } else {
               ctx.lineTo(x, y);
            }
         }
         ctx.stroke();

         for (var k = 0; k < data.length; k++) {
            var px = padding.left + (chartW / (data.length - 1)) * k;
            var py = padding.top + chartH - (data[k] / maxY) * chartH;
            ctx.beginPath();
            ctx.fillStyle = color;
            ctx.arc(px, py, 3, 0, Math.PI * 2);
            ctx.fill();
         }
      }

      drawSeries(leadSeries, '#198754');
      // drawSeries(callSeries, '#f59f00');
   }

   window.addEventListener('resize', drawLeadsOverviewChart);
   document.addEventListener('DOMContentLoaded', drawLeadsOverviewChart);
})();
</script>

<?php include_once('common/footer.php'); ?>