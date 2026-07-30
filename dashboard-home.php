<?php $PageTitle = "Villatent: Dashboard Home"; ?>
<?php include_once('common/header.php'); ?>
<div class="pcoded-content">
   <div class="pcoded-inner-content">
      <div class="main-body">
         <div class="page-wrapper">
            <div class="page-body">
               <div class="listing-page-head">
                  <div class="listing-title-wrap">
                     <h1>Dashboard</h1>
                     <p class="listing-subtitle">Welcome back, Tarun! Here is what is happening with your website today.</p>
                  </div>
                  <div class="listing-cta"></div>
               </div>

               <div class="row">
                  <div class="col-lg-3 col-md-6 col-sm-12 mb-20">
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex align-items-center mb-2">
                              <span class="material-icons rounded-circle bg-success text-white p-2 me-2">home_work</span>
                              <div>
                                 <div class="text-muted">Total Tents</div>
                                 <h3 class="mb-0">26</h3>
                              </div>
                           </div>
                           <a href="project-listing.php" class="text-muted">View all tents <i class="feather icon-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12 mb-20">
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex align-items-center mb-2">
                              <span class="material-icons rounded-circle bg-warning text-white p-2 me-2">apartment</span>
                              <div>
                                 <div class="text-muted">Total Projects</div>
                                 <h3 class="mb-0">48</h3>
                              </div>
                           </div>
                           <a href="project-listings.php" class="text-muted">View all projects <i class="feather icon-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12 mb-20">
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex align-items-center mb-2">
                              <span class="material-icons rounded-circle bg-success text-white p-2 me-2">article</span>
                              <div>
                                 <div class="text-muted">Total Blogs</div>
                                 <h3 class="mb-0">32</h3>
                              </div>
                           </div>
                           <a href="blog-list-page.php" class="text-muted">View all blogs <i class="feather icon-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3 col-md-6 col-sm-12 mb-20">
                     <div class="card">
                        <div class="card-body">
                           <div class="d-flex align-items-center mb-2">
                              <span class="material-icons rounded-circle bg-warning text-white p-2 me-2">call</span>
                              <div>
                                 <div class="text-muted">New Leads</div>
                                 <h3 class="mb-0">14</h3>
                              </div>
                           </div>
                           <a href="contact-us-list.php" class="text-muted">View all leads <i class="feather icon-arrow-right"></i></a>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-5 col-md-12 mb-20">
                     <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           <span>Leads Overview</span>
                           <select class="form-control form-control-sm" style="max-width: 140px;">
                              <option>Last 30 Days</option>
                           </select>
                        </div>
                        <div class="card-body">
                           <div class="d-flex gap-3 mb-2 text-muted">
                              <span><i class="feather icon-minus" style="color:#198754;"></i> Contact Leads</span>
                              <span><i class="feather icon-minus" style="color:#f59f00;"></i> Website Calls</span>
                           </div>
                           <canvas id="leadsOverviewChart" class="w-100" height="250"></canvas>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-6 col-md-12 mb-20">
                     <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           <span>Recent Leads</span>
                           <a href="contact-us-list.php" class="btn btn-primary btn-sm">View All</a>
                        </div>
                        <div class="card-body table-responsive">
                           <table class="table table-bordered listing-table mb-0">
                              <thead>
                                 <tr>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>Source</th>
                                    <th>Date</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td>John Smith</td>
                                    <td>USA</td>
                                    <td>/luxury-tents</td>
                                    <td>15 May, 2025</td>
                                 </tr>
                                 <tr>
                                    <td>David Anderson</td>
                                    <td>UAE</td>
                                    <td>/contact-us</td>
                                    <td>15 May, 2025</td>
                                 </tr>
                                 <tr>
                                    <td>Amit Sharma</td>
                                    <td>India</td>
                                    <td>/the-taj-resort-tent</td>
                                    <td>14 May, 2025</td>
                                 </tr>
                                 <tr>
                                    <td>Sarah Williams</td>
                                    <td>UK</td>
                                    <td>/projects</td>
                                    <td>14 May, 2025</td>
                                 </tr>
                                 <tr>
                                    <td>Michael Brown</td>
                                    <td>Australia</td>
                                    <td>/projects</td>
                                    <td>13 May, 2025</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-3 col-md-12 mb-20">
                     <div class="card h-100">
                        <div class="card-header">Quick Actions</div>
                        <div class="card-body">
                           <div class="list-group">
                              <a href="add-project.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                 <span class="material-icons me-2 text-success">add_circle</span> Add New Tent
                              </a>
                              <a href="add-projects.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                 <span class="material-icons me-2 text-warning">apartment</span> Add New Project
                              </a>
                              <a href="blog-inner-page.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                 <span class="material-icons me-2 text-success">description</span> Add New Blog
                              </a>
                              <a href="add-gallery.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                 <span class="material-icons me-2 text-warning">collections</span> Upload to Gallery
                              </a>
                              <a href="counters-inner-page.php" class="list-group-item list-group-item-action d-flex align-items-center">
                                 <span class="material-icons me-2 text-success">quiz</span> Add FAQ
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-lg-6 col-md-12 mb-20">
                     <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           <span>Most Viewed Tents</span>
                           <a href="project-listing.php" class="btn btn-primary btn-sm">View All</a>
                        </div>
                        <div class="card-body">
                           <div class="d-flex align-items-center border-bottom py-2">
                              <span class="material-icons me-2 text-warning">looks_one</span>
                              <img src="images/default-profile.png" alt="tent" class="me-2" style="width:56px;height:40px;object-fit:cover;">
                              <div>
                                 <div class="fw-bold">The Taj Resort Tent</div>
                                 <small class="text-muted">1,248 Views</small>
                              </div>
                           </div>
                           <div class="d-flex align-items-center border-bottom py-2">
                              <span class="material-icons me-2 text-warning">looks_two</span>
                              <img src="images/default-profile.png" alt="tent" class="me-2" style="width:56px;height:40px;object-fit:cover;">
                              <div>
                                 <div class="fw-bold">Luxury Villa Tent</div>
                                 <small class="text-muted">987 Views</small>
                              </div>
                           </div>
                           <div class="d-flex align-items-center py-2">
                              <span class="material-icons me-2 text-warning">looks_3</span>
                              <img src="images/default-profile.png" alt="tent" class="me-2" style="width:56px;height:40px;object-fit:cover;">
                              <div>
                                 <div class="fw-bold">Maharaja Tent</div>
                                 <small class="text-muted">756 Views</small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="col-lg-4 col-md-12 mb-20">
                     <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                           <span>Most Viewed Projects</span>
                           <a href="project-listings.php" class="btn btn-primary btn-sm">View All</a>
                        </div>
                        <div class="card-body">
                           <div class="d-flex align-items-center border-bottom py-2">
                              <span class="material-icons me-2 text-warning">looks_one</span>
                              <img src="images/default-profile.png" alt="project" class="me-2" style="width:56px;height:40px;object-fit:cover;">
                              <div>
                                 <div class="fw-bold">Oberoi Rajgarh, Khajuraho</div>
                                 <small class="text-muted">1,564 Views</small>
                              </div>
                           </div>
                           <div class="d-flex align-items-center border-bottom py-2">
                              <span class="material-icons me-2 text-warning">looks_two</span>
                              <img src="images/default-profile.png" alt="project" class="me-2" style="width:56px;height:40px;object-fit:cover;">
                              <div>
                                 <div class="fw-bold">The Leela Palace, Udaipur</div>
                                 <small class="text-muted">1,102 Views</small>
                              </div>
                           </div>
                           <div class="d-flex align-items-center py-2">
                              <span class="material-icons me-2 text-warning">looks_3</span>
                              <img src="images/default-profile.png" alt="project" class="me-2" style="width:56px;height:40px;object-fit:cover;">
                              <div>
                                 <div class="fw-bold">Jaisalmer Desert Camp</div>
                                 <small class="text-muted">876 Views</small>
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

<script>
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
      var labels = ['Apr 16', 'Apr 21', 'Apr 26', 'May 01', 'May 06', 'May 11', 'May 15'];
      var leadSeries = [12, 20, 30, 24, 30, 34, 44];
      var callSeries = [2, 5, 12, 9, 15, 13, 27];

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
      drawSeries(callSeries, '#f59f00');
   }

   window.addEventListener('resize', drawLeadsOverviewChart);
   document.addEventListener('DOMContentLoaded', drawLeadsOverviewChart);
})();
</script>

<?php include_once('common/footer.php'); ?>