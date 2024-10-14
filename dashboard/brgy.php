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
         </div>
         </div>
         <div class="row">
            <!-- Gender Ratio Card -->
            <div class="col">
               <div class="card mx-3 my-2" data-aos="zoom-in">
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
            </div>

            <!-- Crop and Livestock Card -->
            <div class="col">
               <div class="card mx-3 my-2" data-aos="zoom-in">
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
