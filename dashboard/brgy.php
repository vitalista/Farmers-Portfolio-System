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
               <h3 class="card-header mb-4"><?= $_GET['brgy']; ?></h3>
            </div>
            <div class="mt-3">
               <a href="dashboard.php" class="btn btn-danger btn-sm d-none d-sm-inline-block" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50">Back</a>
               <?php if ($_SESSION['LoggedInUser']['can_export'] === 1) { ?>
                  <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50" href="brgy-print.php?brgy=<?= $_GET['brgy']; ?>" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
               <?php } ?>
            </div>
         </div>

         <div class="container-fluid">
            <div class="row">
               <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow border-left-success py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="50">
                     <div class="card-body pb-0">
                        <div class="row g-0 align-items-center">
                           <div class="col me-2">
                              <div class="text-uppercase text-success fw-bold mb-1"><span>Number of Farmers</span></div>
                              <div class="text-dark fw-bold h5 mb-0"><span><?= countRows('farmers', '', $_GET['brgy']); ?></span></div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex align-items-center justify-content-center">
                        <a href="../farmer/farmer-list.php?ffrs=&farmerComparison=last_name&farmer=&birthday=&farmerAddComparison=farmer_brgy_address&farmerAdd=<?= $_GET['brgy']; ?>&numberOfParcelsComp=exact&numberOfParcels=&numOfEntries=" class=" text-success">
                           More info<i class="bi bi-arrow-right-short"></i>
                        </a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow border-left-info py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="150">
                     <div class="card-body pb-0">
                        <div class="row g-0 align-items-center">
                           <div class="col me-2">
                              <div class="text-uppercase text-info fw-bold mb-1"><span>Total farms</span></div>
                              <div class="row g-0 align-items-center">
                                 <div class="col-auto">
                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span><?= countRows('parcels', '', $_GET['brgy']); ?></span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex align-items-center justify-content-center">
                        <a href="../farmer-assets/parcels.php?farmerComparison=last_name&farmer=&birthday=&farmerAddComparison=farmer_brgy_address&farmerAdd=<?= $_GET['brgy']; ?>&numberOfParcelsComp=exact&numberOfParcels=&parcelNumComp=exact&parcelNum=&parcelAreaComp=exact&parcelArea=&ownerComparison=owner_last_name&owner=&parcelComparison=parcel_brgy_address&parcelAdd=&ownershipType=&farmType=&numOfEntries=" class=" text-info">
                           More info<i class="bi bi-arrow-right-short"></i>
                        </a>
                     </div>
                  </div>
               </div>



               <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow border-left-warning py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="150">
                     <div class="card-body pb-0">
                        <div class="row g-0 align-items-center">
                           <div class="col me-2">
                              <div class="text-uppercase text-warning fw-bold mb-1"><span>Total Farm Size</span></div>
                              <div class="row g-0 align-items-center">
                                 <div class="col-auto">
                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span><?php
                                                                                       $number = sumColumn('parcels', 'parcel_area', $_GET['brgy']);
                                                                                       $decimalPlaces = 2;
                                                                                       $roundedValue = ceil($number * pow(10, $decimalPlaces)) / pow(10, $decimalPlaces);
                                                                                       echo $roundedValue;
                                                                                       ?> Ha</span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex align-items-center justify-content-center">
                        <a href="../farmer-assets/parcels.php?farmerComparison=last_name&farmer=&birthday=&farmerAddComparison=farmer_brgy_address&farmerAdd=<?= $_GET['brgy']; ?>&numberOfParcelsComp=exact&numberOfParcels=&parcelNumComp=exact&parcelNum=&parcelAreaComp=exact&parcelArea=&ownerComparison=owner_last_name&owner=&parcelComparison=parcel_brgy_address&parcelAdd=&ownershipType=&farmType=&numOfEntries=" class=" text-warning">
                           More info<i class="bi bi-arrow-right-short"></i>
                        </a>
                     </div>
                  </div>
               </div>

               <div class="col-md-6 col-xl-3 mb-4">
                  <div class="card shadow border-left-primary py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="150" style="border-color: red;">
                     <div class="card-body pb-0">
                        <div class="row g-0 align-items-center">
                           <div class="col me-2">
                              <div class="text-uppercase text-danger fw-bold mb-1"><span>Without Owners</span></div>
                              <div class="row g-0 align-items-center">
                                 <div class="col-auto">
                                    <div class="text-dark fw-bold h5 mb-0 me-3"><span><?= returnNullRows('parcels', $_GET['brgy']); ?></span></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="d-flex align-items-center justify-content-center">
                        <a href="../farmer/farmer-list.php" class=" text-danger">
                           More info<i class="bi bi-arrow-right-short"></i>
                        </a>
                     </div>
                  </div>
               </div>

            </div>
         </div>

         <div class="row">

            <div class="col-lg-6">
               <div class="card ">
                  <div class="card-header text-center">
                     <h3 class="text-bold" style="color: #026a44;">Gender</h3>
                  </div>
                  <div class="card-body text-center">
                     <div class="d-flex justify-content-center align-items-center mb-2">
                        <div class="d-flex align-items-center mx-3">
                           <i class="fa fa-male" style="font-size: 60px;color: rgb(54,77,249);"></i>
                           <div class="ms-2">
                              <a class="fw-bold text-success">Male</a>
                              <div><?= countRows('farmers', '', $_GET['brgy'], 'MALE'); ?></div>
                           </div>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                           <i class="fa fa-female" style="font-size: 60px;color: rgb(232,23,23);"></i>
                           <div class="ms-2">
                              <a class="fw-bold text-success">Female</a>
                              <div><?= countRows('farmers', '', $_GET['brgy'], 'FEMALE'); ?></div>
                           </div>
                        </div>
                     </div>
                     <div>Total: <?= countRows('farmers', '', $_GET['brgy'], 'FEMALE') + countRows('farmers', '', $_GET['brgy'], 'MALE'); ?></div>
                  </div>
               </div>

            </div>

            <div class="col-lg-6">
               <div class="card ">
                  <div class="card-header text-center">
                     <h3 class="fw-bolder text-success">Crop-Livestock </h3>
                  </div>
                  <div class="card-body text-center">
                     <div class="d-flex justify-content-center align-items-center mb-2">
                        <div class="d-flex align-items-center mx-3">
                           <i class="fa fa-pagelines" style="font-size: 60px;color: rgb(29,140,20);"></i>
                           <div class="ms-2">
                              <!-- CROP -->
                              <a class="fw-bold text-success" href="../farmer-assets/crops.php?farmerComparison=last_name&farmer=&birthday=&farmerAddComparison=farmer_brgy_address&farmerAdd=<?= $_GET['brgy']; ?>">Crop<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                 </svg></a>
                              <div><?= countRows('crops', '', $_GET['brgy']); ?></div>
                           </div>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                           <i class="fa-solid fa-cow" style="font-size: 60px;color: brown"></i>
                           <div class="ms-2">
                              <a class="fw-bold text-success" href="../farmer-assets/livestocks.php?farmerComparison=last_name&farmer=&birthday=&farmerAddComparison=farmer_brgy_address&farmerAdd=<?= $_GET['brgy']; ?>">Livestock <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                                 </svg></a>
                              <div><?= countRows('livestocks', '', $_GET['brgy']); ?></div>
                           </div>
                        </div>
                     </div>
                     <div>Total: <?= countRows('crops', '', $_GET['brgy']) + countRows('livestocks', '', $_GET['brgy']); ?></div>
                  </div>
               </div>
            </div>


            <div class="col-lg-6">
               <div class="card">
                  <div class="card-body">
                     <h5 class="card-title">Crops Chart</h5>

                     <!-- Donut Chart -->
                     <div id="donutChart"></div>

                     <script>
                        document.addEventListener("DOMContentLoaded", () => {
                           new ApexCharts(document.querySelector("#donutChart"), {
                              series: <?= json_encode(array_map('intval', getCountArray('crops', 'crop_name', 'count', $_GET['brgy']))); ?>,
                              chart: {
                                 height: 350,
                                 type: 'donut',
                                 toolbar: {
                                    show: true
                                 }
                              },
                              labels: <?= json_encode(getCountArray('crops', 'crop_name', 'id', $_GET['brgy'])); ?>
                           }).render();
                        });
                     </script>
                  </div>
               </div>
            </div>
            <!-- End Donut Chart -->

            <div class="col-lg-6">
               <div class="card" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50">
                  <div class="card-body">
                     <h5 class="card-title">Livestocks Chart</h5>

                     <div id="pieChart">
                     </div>

                     <script>
                        document.addEventListener("DOMContentLoaded", () => {
                           new ApexCharts(document.querySelector("#pieChart"), {
                              series: <?= json_encode(array_map('intval', getCountArray('livestocks', 'animal_name', 'count', $_GET['brgy']))); ?>,
                              chart: {
                                 height: 350,
                                 type: 'pie',
                                 toolbar: {
                                    show: true
                                 }
                              },
                              labels: <?= json_encode(getCountArray('livestocks', 'animal_name', 'id', $_GET['brgy'])); ?>
                           }).render();
                        });
                     </script>
                     <!-- End Pie Chart -->
                  </div>
               </div>
            </div>

         </div>
      </div>

      <div class="row">

         <?php
         $brgy = validate($_GET['brgy']);
         $sql = "SELECT * FROM farmers WHERE farmer_brgy_address = '$brgy' AND is_archived = 0";
         $result = $conn->query($sql);

         ?>
         <script>
            function getTotalEntries() {
               return <?= $result->num_rows ?>;
            }
         </script>

         <div class="col-lg-12">
            <div class="card" data-aos="zoom-in-left">
               <div class="card-body main-table pb-4">
                  <h5 class="card-header">Farm list</h5>

                  <table id="example" class="display nowrap d-none">
                     <thead>
                        <tr>
                           <th>Registration</th>
                           <th>FFRS</th>
                           <th>First Name</th>
                           <th>Middle Name</th>
                           <th>Last Name</th>
                           <th>Barangay</th>
                           <th>Gender</th>
                           <th>Birthday</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                           while ($data = $result->fetch_assoc()) {
                        ?>
                              <tr>

                                 <td><?= $data['ffrs_system_gen'] ?></td>
                                 <td><?= $data['ffrs_system_gen'] ?></td>
                                 <td><?= $data['first_name'] ?></td>
                                 <td><?= $data['middle_name'] ?></td>
                                 <td><?= $data['last_name'] ?></td>
                                 <td><?= $data['farmer_brgy_address'] ?></td>
                                 <td><?= $data['gender'] ?></td>
                                 <td><?= $data['birthday'] ?></td>


                                 <td>
                                    <?php if ($_SESSION['LoggedInUser']['can_edit'] == 1) { ?>
                                       <a href="../farmer/farmer-view.php?id=<?= $data['id'] ?>" class="btn btn-sm btn-success"><i class="bi bi-person-square"></i></a>
                                    <?php } ?>

                                 </td>
                              </tr>
                        <?php }
                        } ?>

                     </tbody>

                  </table>

               </div>
            </div>

         </div>
      </div>
      </div>
   </main>

   <?php include '../includes/footer.php'; ?>
   <script>
      let totalEntries = getTotalEntries();

      let twentyFivePercent = Math.ceil(totalEntries * 0.25);
      let fiftyPercent = Math.ceil(totalEntries * 0.50);
      let seventyFivePercent = Math.ceil(totalEntries * 0.75);

      let lengthMenuValues = [10, twentyFivePercent, fiftyPercent, seventyFivePercent, -1];
      let lengthMenuLabels = [10,
         `${twentyFivePercent} (25%)`,
         `${fiftyPercent} (50%)`,
         `${seventyFivePercent} (75%)`,
         "Show All"
      ];

      document.addEventListener("DOMContentLoaded", function() {
         const example = document.getElementById("example");

         setTimeout(() => {
            example.classList.remove("d-none");
            $('#example').DataTable({

               dom: 'B<"table-top"lf>t<"table-bottom"ip>',
               responsive: true,
               buttons: [
                  'copy', 'csv', 'print', 'excel', 'pdf'
               ],
               colReorder: true,
               fixedHeader: true,
               rowReorder: false,
               lengthMenu: [
                  lengthMenuValues, // Values for entries
                  lengthMenuLabels // Labels for entries
               ],
               columnDefs: [{
                  targets: 0,
                  render: function(data, type, row) {
                     if (type === 'display' || type === 'filter') {
                        if (data === "") {
                           return `<b class="text-danger">UNREGISTERED</b>`
                        }
                        return `<b  class="text-success">REGISTERED</b>`
                     }
                     return null;
                  }
               }]
            });
         }, 500);
      });
   </script>
</body>

</html>