<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>

<body class="login-bg">
   <?php include '../includes/header.php'; ?>
   <?php include '../includes/sidebar.php'; ?>

   <main id="main" class="main">
      <div class="card container-fluid pb-5">
         <div class="d-flex justify-content-between">
         <div>
         <h3 class="card-header mb-4">Barangay Name</h3>
         </div>
         <div class="mt-3">
         <a href="dashboard.php" class="btn btn-primary">Back</a>
         <a href="dashboard.php" class="btn btn-danger">Print</a>
         </div>
         </div>

         <div class="container-fluid">
                  <div class="row">
            
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="50">
                           <div class="card-body">
                              <div class="row g-0 align-items-center">
                                 <div class="col me-2">
                                    <div class="text-uppercase text-success fw-bold mb-1"><span>Number of Farmers</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-info py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="150">
                           <div class="card-body">
                              <div class="row g-0 align-items-center">
                                 <div class="col me-2">
                                    <div class="text-uppercase text-info fw-bold mb-1"><span>Total farms</span></div>
                                    <div class="row g-0 align-items-center">
                                       <div class="col-auto">
                                          <div class="text-dark fw-bold h5 mb-0 me-3"><span>0</span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>



                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-warning py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="150">
                           <div class="card-body">
                              <div class="row g-0 align-items-center">
                                 <div class="col me-2">
                                    <div class="text-uppercase text-warning fw-bold mb-1"><span>Total Farm Size</span></div>
                                    <div class="row g-0 align-items-center">
                                       <div class="col-auto">
                                          <div class="text-dark fw-bold h5 mb-0 me-3"><span>0 Ha</span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="150" style="border-color: red;">
                           <div class="card-body">
                              <div class="row g-0 align-items-center">
                                 <div class="col me-2">
                                    <div class="text-uppercase text-danger fw-bold mb-1"><span>Without Owners</span></div>
                                    <div class="row g-0 align-items-center">
                                       <div class="col-auto">
                                          <div class="text-dark fw-bold h5 mb-0 me-3"><span>0</span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                        </div>

                  </div>

                  <div class="row">

                     <div class="col-lg-6">
                        <div class="card" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50">
                           <div class="card-body">
                              <h5 class="card-title">Farmers population</h5>

                              <!-- Polar Area Chart -->
                              <div id="polarAreaChart"></div>

                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#polarAreaChart"), {
                                       series: [14, 23, 21, 17, 15, 10, 12, 17, 21, 10, 11, 12, 13, 15, 16, 17, 19, 20], // data values
                                       chart: {
                                          type: 'polarArea',
                                          height: 350,
                                          toolbar: {
                                             show: true
                                          }
                                       },
                                       stroke: {
                                          colors: ['#fff']
                                       },
                                       fill: {
                                          opacity: 0.8
                                       },
                                       labels: ['Barangaca', 'Calantipay', 'Catulinan', 'Hinukay', 'Makinabang', 'Matangtubig', 'Pagala', 'Paitan', 'Pinagbarilan', 'Sabang', 'San Roque', 'Sta Barbara', 'Sto Nino', 'Tangos', 'Tilapayong', 'Piel', 'Tarcan', 'Piel'] // custom series names
                                    }).render();
                                 });
                              </script>
                              <!-- End Polar Area Chart -->

                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="card" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50">
                           <div class="card-body">
                              <h5 class="card-title">Crop Chart</h5>

                              <div id="pieChart">
                              </div>

                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#pieChart"), {
                                       series: [44, 55, 13, 43, 22],
                                       chart: {
                                          height: 350,
                                          type: 'pie',
                                          toolbar: {
                                             show: true
                                          }
                                       },
                                       labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E']
                                    }).render();
                                 });
                              </script>
                              <!-- End Pie Chart -->
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="card">
                           <div class="card-body">
                              <h5 class="card-title">Livestock Chart</h5>

                              <!-- Donut Chart -->
                              <div id="donutChart"></div>

                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#donutChart"), {
                                       series: [44, 55, 13, 43, 22],
                                       chart: {
                                          height: 350,
                                          type: 'donut',
                                          toolbar: {
                                             show: true
                                          }
                                       },
                                       labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
                                    }).render();
                                 });
                              </script>
                           </div>
                        </div>
                     </div>
                     <!-- End Donut Chart -->

                     <div class="col-lg-6">
                        <div class="card mx-3 my-2">
                           <div class="card-header text-center">
                              <h3 class="text-bold" style="color: #026a44;">Gender Ratio</h3>
                           </div>
                           <div class="card-body text-center">
                              <div class="d-flex justify-content-center align-items-center mb-2">
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-male" style="font-size: 60px;color: rgb(54,77,249);"></i>
                                    <div class="ms-2">
                                       <span class="fw-bold">Male</span>
                                       <div>0</div>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-female" style="font-size: 60px;color: rgb(232,23,23);"></i>
                                    <div class="ms-2">
                                       <span class="fw-bold">Female</span>
                                       <div>0</div>
                                    </div>
                                 </div>
                              </div>
                              <div>Total: 0</div>
                           </div>
                        </div>
                        <div class="card mx-3 my-2">
                           <div class="card-header text-center">
                              <h3 class="text-bold" style="color: #026a44;">Crop and Livestock</h3>
                           </div>
                           <div class="card-body text-center">
                              <div class="d-flex justify-content-center align-items-center mb-2">
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-pagelines" style="font-size: 60px;color: rgb(29,140,20);"></i>
                                    <div class="ms-2">
                                       <!-- CROP -->
                                       <span class="fw-bold">Crop</span>
                                       <div>0</div>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center mx-3">
                                    <!-- PIG -->
                                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="rgb(193,54,137)">
                              <path d="M15 11v.01"></path>
                              <path d="M16 3l0 3.803a6.019 6.019 0 0 1 2.658 3.197h1.341a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-1.342a6.008 6.008 0 0 1 -1.658 2.473v2.027a1.5 1.5 0 0 1 -3 0v-.583a6.04 6.04 0 0 1 -1 .083h-4a6.04 6.04 0 0 1 -1 -.083v.583a1.5 1.5 0 0 1 -3 0v-2l0 -.027a6 6 0 0 1 4 -10.473h2.5l4.5 -3z"></path>
                           </svg> -->
                                    <div class="ms-2">
                                       <span class="fw-bold">Livestock</span>
                                       <div>0</div>
                                    </div>
                                 </div>
                              </div>
                              <div>Total: 0</div>
                           </div>
                        </div>
                     </div>



                  </div>
               </div>

         <div class="row">
            <?php if(is_dir('../program')){?>
            <div class="col">
               <div class="card mx-3 my-2" data-aos="zoom-in-left">
                  <div class="card-header d-flex justify-content-between">
                     <h4 style="color: #026a44;">Program History</h4>
                     <button class="btn btn-link text-decoration-underline" data-bs-toggle="modal" data-bs-target="#modal-1">View all</button>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                           <thead>
                              <tr>
                                 <th>Program Name</th>
                                 <th>Date Received</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Palay</td>
                                 <td>09/22/2020</td>
                              </tr>
                              <!-- Additional rows can be added here -->
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
            <?php }?>
         </div>

         <div class="row">
            <div class="col">
               <div class="card mx-3 my-2" data-aos="zoom-in-left">
                  <div class="card-header">
                     <h4 style="color: #026a44;">Farmers List</h4>
                  </div>
                  <div class="card-body">
                     <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Operation Type</th>
                                 <th>Farm Area</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td>Jude Kenjay</td>
                                 <td>LIVESTOCK</td>
                                 <td>2ha</td>
                                 <td><a href="../farmer/farmer-view.php" class="btn btn-primary bg-success">View Profile</a></td>
                              </tr>
                              <tr>
                                 <td>Monkey Luffy</td>
                                 <td>CROP</td>
                                 <td>1.5ha</td>
                                 <td><a href="../farmer/farmer-view.php" class="btn btn-primary bg-success">View Profile</a></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="modal-1" tabindex="-1">
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
               <div class="modal-header">
                  <h4 class="modal-title" style="color: #026a44;">Program History</h4>
                  <button class="btn-close" data-bs-dismiss="modal"></button>
               </div>
               <div class="modal-body">
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered">
                        <thead>
                           <tr>
                              <th>Program Name</th>
                              <th>Date Received</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr>
                              <td>Palay</td>
                              <td>09/22/2020</td>
                           </tr>
                           <!-- Additional rows can be added here -->
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </main>

   <?php include '../includes/footer.php'; ?>
</body>
</html>
