<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>
<?php include '../backend/auth-check.php';?>
<body style="font-family: fangsong;">

         <div class="container mt-5" id="overview">
            <h1 class="text-center mb-4">Dashboard Overview</h1>

            <div class="row">

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Programs Count</h5>
                        <p class="card-text"><?= countRows('programs'); ?></p>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Farmers Count</h5>
                        <p class="card-text"><?= countRows('farmers'); ?></p>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Parcels Count</h5>
                        <p class="card-text"><?= countRows('parcels'); ?></p>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Total Parcel Area</h5>
                        <p class="card-text">
                           <?php
                           $number = sumColumn('parcels', 'parcel_area');
                           $decimalPlaces = 2;
                           $roundedValue = ceil($number * pow(10, $decimalPlaces)) / pow(10, $decimalPlaces);
                           echo $roundedValue;
                           ?> Ha
                        </p>
                     </div>
                  </div>
               </div>
            </div>

            <div class="row">

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Programs Count</h5>
                        <p class="card-text"><?= returnNullRows('parcels'); ?></p>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Farmers Count</h5>
                        <p class="card-text"><?= countRows('programs', 'pending_programs'); ?></p>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Parcels Count</h5>
                        <p class="card-text"><?= countRows('programs', 'expired_programs'); ?></p>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card">
                     <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Total Parcel Area</h5>
                        <p class="card-text">
                        <?= countRows('programs', 'ongoing_programs'); ?>
                        </p>
                     </div>
                  </div>
                  </div>

            </div>
            <div class="row">
            <div class="col-lg-6 box">
                        <div class="card pt-4">
                           <div class="card-body text-center">
                              <div class="d-flex justify-content-center align-items-center mb-2">
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-male" style="font-size: 60px;color: rgb(54,77,249);"></i>
                                    <div class="ms-2">
                                       <span class="fw-bold">Male</span>
                                       <div><?= countRows('farmers', 'MALE'); ?></div>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-female" style="font-size: 60px;color: rgb(232,23,23);"></i>
                                    <div class="ms-2">
                                       <span class="fw-bold">Female</span>
                                       <div><?= countRows('farmers', 'FEMALE'); ?></div>
                                    </div>
                                 </div>
                              </div>
                              <div>Total: <?= countRows('farmers', 'FEMALE') + countRows('farmers', 'MALE'); ?></div>
                           </div>
                        </div>

                     </div>

                     <div class="col-lg-6 box">
                        <div class="card pt-4">
                           <div class="card-body text-center">
                              <div class="d-flex justify-content-center align-items-center mb-2">
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-pagelines" style="font-size: 60px;color: rgb(29,140,20);"></i>
                                    <div class="ms-2">
                                       <!-- CROP -->
                                       <span class="fw-bold">Crops</span>
                                       <div><?= countRows('crops'); ?></div>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center mx-3">
                                    <!-- PIG -->
                                    <div class="ms-2">
                                       <span class="fw-bold">Livestocks</span>
                                       <div><?= countRows('livestocks'); ?></div>
                                    </div>
                                 </div>
                              </div>
                              <div>Total: <?= countRows('livestocks') +  countRows('crops'); ?></div>
                           </div>
                        </div>
                     </div>
            </div>

            <div class="row">
               <div class="col-md-6 mb-3 box">
                  <div class="card table-container">
                     <div class="card-body">
                        <h5 class="card-title">Crops</h5>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">Number</th>
                                 <th class="text-center">Crop</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $count = getCountArray('crops', 'crop_name', 'count');
                              $name = getCountArray('crops', 'crop_name', 'id');

                              for ($i = 0; $i < count($count); $i++) {
                                 echo "<tr><td class='text-center'>" . $count[$i] . "</td><td class='text-center'>" . $name[$i] . "</td></tr>";
                              }
                              ?>
                           </tbody>

                        </table>
                     </div>
                  </div>
               </div>

               <div class="col-md-6 mb-3 box">
                  <div class="card table-container">
                     <div class="card-body">
                        <h5 class="card-title">Livestocks</h5>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">Number</th>
                                 <th class="text-center">Livestock</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $count = getCountArray('livestocks', 'animal_name', 'count');
                              $name = getCountArray('livestocks', 'animal_name', 'id');
                              for ($i = 0; $i < count($count); $i++) {
                                 echo "<tr><td class='text-center'>" . $count[$i] . "</td><td class='text-center'>" . $name[$i] . "</td></tr>";
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         
            <div class="row">
               <div class="col-md-3 mb-3 box">
                  <div class="card table-container">
                     <div class="card-body">
                        <h5 class="card-title">Farmers</h5>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">Farmers</th>
                                 <th class="text-center">Barangay</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $farmersCount = getCountArray('farmers', 'farmer_brgy_address', 'count');
                              $farmersId = getCountArray('farmers', 'farmer_brgy_address', 'id');

                              // Assuming both arrays have the same length
                              for ($i = 0; $i < count($farmersCount); $i++) {
                                 echo "<tr><td class='text-center'>" . $farmersCount[$i] . "</td><td class='text-center'>" . $farmersId[$i] . "</td></tr>";
                              }
                              ?>
                           </tbody>

                        </table>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card table-container">
                     <div class="card-body">
                        <h5 class="card-title">Programs</h5>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">Farmer</th>
                                 <th class="text-center">Program</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $distributionCount = getCountArray('distributions', 'program_id', 'count');
                              $programs = getCountArray('distributions', 'program_id', 'id');
                              for ($i = 0; $i < count($distributionCount); $i++) {
                                 echo "<tr><td class='text-center'>" . $distributionCount[$i] . "</td><td class='text-center'>" . $programs[$i] . "</td></tr>";
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

               <div class="col-md-3 mb-3 box">
                  <div class="card table-container">
                     <div class="card-body">
                        <h5 class="card-title">Resources</h5>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">Remaining</th>
                                 <th class="text-center">Name</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                             $remaining = [];
                             $resources = getAll('resources');
                             if (mysqli_num_rows($resources) > 0) {
                                foreach ($resources as $item) {
                                   $remaining[] = $item['total_quantity'] - $item['quantity_available'];
                                }
                             }
                             $resourcesName = [];
                             $resources = getAll('resources');
                             if (mysqli_num_rows($resources) > 0) {
                                foreach ($resources as $item) {
                                   $resourcesName[] = $item['resources_name'];
                                }
                             }
                              for ($i = 0; $i < count($resourcesName); $i++) {
                                 echo "<tr><td class='text-center'>" . $remaining[$i] . "</td><td class='text-center'>" . $resourcesName[$i] . "</td></tr>";
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

                <div class="col-md-3 mb-3 box">
                  <div class="card table-container">
                     <div class="card-body">
                        <h5 class="card-title">Distributions</h5>
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">Resources</th>
                                 <th class="text-center">Distributions</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                              $resources = getCountArray('distributions', 'resource_id', 'id');
                              $column = [];
                              foreach ($resources as $item) {
                                 $getById = getById('resources', $item);
                                 $column[] = $getById['data']['resources_name'];
                              }
                              $distributions = getCountArray('distributions', 'resource_id', 'count');
                              for ($i = 0; $i < count($distributions); $i++) {
                                 echo "<tr><td class='text-center'>" . $resources[$i] . "</td><td class='text-center'>" . $distributions[$i] . "</td></tr>";
                              }
                              ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>

            </div>

         </div>

   <!-- ======= Footer ======= -->
   <script>
   window.print();
    const boxes = document.querySelectorAll('.box');
    let isCtrlPressed = false;

    // Handle click event on each box
    boxes.forEach((box) => {
      box.addEventListener('click', () => {
        if (isCtrlPressed) {
          const currentWidth = parseInt(window.getComputedStyle(box).width);
          box.style.width = `${currentWidth + 50}px`;
        } else {
          box.style.display = 'none';  // Hide the box
        }
      });
    });

    // Detect if the Ctrl key is being pressed
    window.addEventListener('keydown', (event) => {
      if (event.key === 'Control') {
        isCtrlPressed = true;
      }
    });

    window.addEventListener('keyup', (event) => {
      if (event.key === 'Control') {
        isCtrlPressed = false;
      }
    });
   </script>

</body>

</html>