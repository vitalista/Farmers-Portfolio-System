<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>
<body class="login-bg">
<?php include '../includes/header.php' ?>

   <!-- ======= Sidebar ======= -->
   <?php include '../includes/sidebar.php' ?>
   <?php include '../backend/status-messages.php' ?>

   <main id="main" class="main">


      <section class="section main-table p-3">

         <ul class="nav nav-tabs" id="myTab" role="tablist">
            <?php if (is_dir('../map')) { ?>
               <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Main</button>
               </li>

               <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Weather forecast</button>
               </li>
            <?php } ?>
         </ul>

         <div class="tab-content pt-2" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
               <div class="container-fluid">
                  <div class="row">
                     <?php includes('select-dashboard-content.php'); ?>
                     <div class="col-md-4 text-center">
                     <h3 class="text-dark mb-0">Dashboard</h3>
                     </div>
                     <div class="col-md-4 text-end">
                     <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50" href="dashboard-print.php" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                     </div>
                  </div>
                  <div class="row">
                     <?php if (is_dir('../program')) { ?>
                        <div class="col-md-6 col-xl-3 mb-4">
                           <div class="card shadow border-left-primary py-2 d-flex justify-content-between" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="50">
                              <div class="card-body pb-0">
                                 <div class="row g-0 align-items-center">
                                    <div class="col me-2">
                                       <div class="text-uppercase text-primary fw-bold mb-1"><span>No. of programs</span></div>
                                       <div class="text-dark fw-bold h5 mb-0"><span><?= countRows('programs'); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-center"><a href="../program/programs-list.php" class=" text-primary">
                                    More info<i class="bi bi-arrow-right-short"></i>
                                 </a>
                              </div>
                           </div>

                        </div>
                     <?php } ?>
                     <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-success py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="50">
                           <div class="card-body pb-0">
                              <div class="row g-0 align-items-center">
                                 <div class="col me-2">
                                    <div class="text-uppercase text-success fw-bold mb-1"><span>Number of Farmers</span></div>
                                    <div class="text-dark fw-bold h5 mb-0"><span><?= countRows('farmers'); ?></span></div>
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex align-items-center justify-content-center">
                              <a href="../farmer/farmer-list.php" class=" text-success">
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
                                          <div class="text-dark fw-bold h5 mb-0 me-3"><span><?= countRows('parcels'); ?></span></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex align-items-center justify-content-center">
                              <a href="../farmer-assets/parcels.php" class=" text-info">
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
                                                                                             $number = sumColumn('parcels', 'parcel_area');
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
                              <a href="../farmer-assets/parcels.php" class=" text-warning">
                                 More info<i class="bi bi-arrow-right-short"></i>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div class="row">

                  

                     <?php if (is_dir('../prices')) { ?>
                        <div class="col-lg-6">
                           <div class="card" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50">
                              <div class="card-body">
                                 <h5 class="card-title">Palay prices</h5>

                                 <!-- Area Chart -->
                                 <div id="areaChart"></div>

                                 <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                       const series = {
                                          "monthDataSeries1": {
                                             "prices": [
                                                8107.85, 8128.0, 8122.9, 8165.5, 8340.7,
                                                8423.7, 8423.5, 8514.3, 8481.85, 8487.7,
                                                8506.9, 8626.2, 8668.95, 8602.3, 8607.55,
                                                8512.9, 8496.25, 8600.65, 8881.1, 9340.85
                                             ],
                                             "dates": [
                                                "13 Nov 2017", "14 Nov 2017", "15 Nov 2017", "16 Nov 2017",
                                                "17 Nov 2017", "20 Nov 2017", "21 Nov 2017", "22 Nov 2017",
                                                "23 Nov 2017", "24 Nov 2017", "27 Nov 2017", "28 Nov 2017",
                                                "29 Nov 2017", "30 Nov 2017", "01 Dec 2017", "04 Dec 2017",
                                                "05 Dec 2017", "06 Dec 2017", "07 Dec 2017", "08 Dec 2017"
                                             ]
                                          }
                                       };

                                       new ApexCharts(document.querySelector("#areaChart"), {
                                          series: [{
                                             name: "STOCK ABC",
                                             data: series.monthDataSeries1.prices
                                          }],
                                          chart: {
                                             type: 'area',
                                             height: 350,
                                             zoom: {
                                                enabled: false
                                             }
                                          },
                                          dataLabels: {
                                             enabled: true
                                          },
                                          stroke: {
                                             curve: 'smooth'
                                          },
                                          subtitle: {
                                             text: 'Price Movements',
                                             align: 'left'
                                          },
                                          labels: series.monthDataSeries1.dates,
                                          xaxis: {
                                             type: 'datetime',
                                             labels: {
                                                formatter: function(value) {
                                                   return new Date(value).toLocaleDateString('en-GB', {
                                                      day: '2-digit',
                                                      month: 'short',
                                                      year: 'numeric'
                                                   });
                                                }
                                             }
                                          },
                                          yaxis: {
                                             opposite: true
                                          },
                                          legend: {
                                             horizontalAlign: 'left'
                                          }
                                       }).render();
                                    });
                                 </script>

                                 <!-- End Area Chart -->

                              </div>
                           </div>
                        </div>
                     <?php } ?>

                     <div class="col-lg-6">
                        <div class="card">
                           <div class="card-header text-center">
                              <h3 class="fw-bolder text-success" >Gender</h3>
                           </div>
                           <div class="card-body text-center">
                              <div class="d-flex justify-content-center align-items-center mb-2">
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-male" style="font-size: 60px;color: rgb(54,77,249);"></i>
                                    <div class="ms-2">
                                       <a class="fw-bold text-success" href="../farmer/farmer-list.php?ffrs=&farmerComparison=last_name&farmer=&gender=Male&birthday=&farmerAddComparison=farmer_brgy_address&farmerAdd=&numberOfParcelsComp=exact&numberOfParcels=&numOfEntries=">Male<i class="bi bi-arrow-right-short"></i></a>
                                       <div><?= countRows('farmers', '', '', 'MALE'); ?></div>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-female" style="font-size: 60px;color: rgb(232,23,23);"></i>
                                    <div class="ms-2">
                                       <a class="fw-bold text-success" href="../farmer/farmer-list.php?ffrs=&farmerComparison=last_name&farmer=&gender=Female&birthday=&farmerAddComparison=farmer_brgy_address&farmerAdd=&numberOfParcelsComp=exact&numberOfParcels=&numOfEntries=">Female<i class="bi bi-arrow-right-short"></i></a>
                                       <div><?= countRows('farmers', '', '', 'FEMALE'); ?></div>
                                    </div>
                                 </div>
                              </div>
                              <div>Total: <?= countRows('farmers', '', '', 'FEMALE') + countRows('farmers', '', '', 'MALE'); ?></div>
                           </div>
                        </div>

                     </div>

                     <div class="col-lg-6">
                        <div class="card">
                           <div class="card-header text-center">
                              <h3 class="fw-bolder text-success">Crop-Livestock</h3>
                           </div>
                           <div class="card-body text-center">
                              <div class="d-flex justify-content-center align-items-center mb-2">
                                 <div class="d-flex align-items-center mx-3">
                                    <i class="fa fa-pagelines" style="font-size: 60px;color: rgb(29,140,20);"></i>
                                    <div class="ms-2">
                                       <!-- CROP -->
                                       <a class="fw-bold text-success" href="../farmer-assets/crops.php">Crop<i class="bi bi-arrow-right-short"></i></a>
                                       <div><?= countRows('crops'); ?></div>
                                    </div>
                                 </div>
                                 <div class="d-flex align-items-center mx-3">
                                 <i class="fa-solid fa-cow" style="font-size: 60px;color: brown"></i>
                                    <div class="ms-2">
                                       <a class="fw-bold text-success" href="../farmer-assets/livestocks.php">Livestock<i class="bi bi-arrow-right-short"></i></a>
                                       <div><?= countRows('livestocks'); ?></div>
                                    </div>
                                 </div>
                              </div>
                              <div>Total: <?= countRows('livestocks') +  countRows('crops'); ?></div>
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="card">
                           <div class="card-body">
                              <h5 class="card-title">Crop Chart</h5>

                              <div id="pieChart">
                              </div>

                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#pieChart"), {
                                       series: <?= json_encode(array_map('intval', getCountArray('crops', 'crop_name', 'count'))); ?>,
                                       chart: {
                                          height: 350,
                                          type: 'pie',
                                          toolbar: {
                                             show: true
                                          }
                                       },
                                       labels: <?= json_encode(getCountArray('crops', 'crop_name', 'id')); ?>
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
                                       series: <?= json_encode(array_map('intval', getCountArray('livestocks', 'animal_name', 'count'))); ?>,
                                       chart: {
                                          height: 350,
                                          type: 'donut',
                                          toolbar: {
                                             show: true
                                          }
                                       },
                                       labels: <?= json_encode(getCountArray('livestocks', 'animal_name', 'id')); ?>,
                                    }).render();
                                 });
                              </script>
                           </div>
                        </div>
                     </div>
                     <!-- End Donut Chart -->

                     <div class="col-lg-6">
                        <div class="card">
                           <div class="card-body">
                              <h5 class="card-title">Remaining Resources Chart</h5>

                              <!-- Bar Chart -->
                              <div id="barChart2"></div>



                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChart2"), {
                                       series: [{
                                          name: 'Remaining Resources',
                                          data: <?php
                                                $remaining = [];
                                                $resources = getAll('resources');
                                                if (mysqli_num_rows($resources) > 0) {
                                                   foreach ($resources as $item) {
                                                      $remaining[] = $item['quantity_available'];
                                                   }
                                                }
                                                echo json_encode($remaining);
                                                ?>
                                       }],
                                       chart: {
                                          type: 'bar',
                                          height: 338
                                       },
                                       plotOptions: {
                                          bar: {
                                             borderRadius: 4,
                                             horizontal: false,
                                          }
                                       },
                                       dataLabels: {
                                          enabled: true
                                       },
                                       xaxis: {
                                          categories: <?php
                                                      $remaining = [];
                                                      $resources = getAll('resources');
                                                      if (mysqli_num_rows($resources) > 0) {
                                                         foreach ($resources as $item) {
                                                            $remaining[] = $item['resources_name'] . " Total:" . $item['total_quantity'];
                                                         }
                                                      }
                                                      echo json_encode($remaining);
                                                      ?>,
                                       },
                                       colors: ["#00e296"],
                                    }).render();
                                 });
                              </script>
                              <!-- End Bar Chart -->

                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="card">
                           <div class="card-body">
                              <h5 class="card-title">Distributed Resources Chart</h5>

                              <div id="pieChart1"></div>


                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#pieChart1"), {
                                       series: <?= json_encode(array_map('intval', getCountArray('distributions', 'resource_id', 'count'))); ?>

                                          ,
                                       chart: {
                                          height: 350,
                                          type: 'pie',
                                          toolbar: {
                                             show: true
                                          }
                                       },
                                       labels: <?php
                                                $resources = getCountArray('distributions', 'resource_id', 'id');
                                                $column = [];
                                                foreach ($resources as $item) {
                                                   $getById = getById('resources', $item);
                                                   $column[] = $getById['data']['resources_name'];
                                                }
                                                echo json_encode($column);
                                                ?>,
                                       dataLabels: {
                                          enabled: true,
                                          style: {
                                             fontSize: '14px',
                                             fontWeight: 'bold',
                                             colors: ['#fff']
                                          }
                                       },
                                       // tooltip: {
                                       //    enabled: true,
                                       //    y: {
                                       //       formatter: function(val, opts) {
                                       //          programs = ['Cash Assistance', 'Seedling Pamigay', 'Fertilizer Program A', 'Pest Control Program'];
                                       //          const seriesName = opts.seriesIndex;
                                       //          console.log(seriesName)
                                       //          return `${programs[seriesName]}: ${val}%`;
                                       //       }
                                       //    }
                                       // }
                                    }).render();

                                    document.querySelector("#pieChart1 svg").style.filter = "brightness(1.15)";
                                 });
                              </script>
                              <!-- End Pie Chart -->
                           </div>
                        </div>
                     </div>

                     <div class="col-lg-6">
                        <div class="card" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50">
                           <div class="card-body">
                              <h5 class="card-title">Farmers population</h5>

                              <!-- Polar Area Chart -->
                              <div id="polarAreaChart"></div>

                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#polarAreaChart"), {
                                       series: <?= json_encode(array_map('intval', getCountArray('farmers', 'farmer_brgy_address', 'count'))); ?>,
                                       chart: {
                                          type: 'polarArea',
                                          height: 350,
                                          toolbar: {
                                             show: true
                                          }
                                       },
                                       dataLabels: {
                                          enabled: true
                                       },
                                       stroke: {
                                          colors: ['#fff']
                                       },
                                       fill: {
                                          opacity: 0.8
                                       },
                                       labels: <?= json_encode(getCountArray('farmers', 'farmer_brgy_address', 'id')); ?> // custom series names
                                    }).render();
                                 });
                              </script>
                              <!-- End Polar Area Chart -->

                           </div>
                        </div>
                     </div>

                     <div class="d-none">
                        <pre>
                     <?= print_r(array_map('intval', getCountArray('farmers', 'farmer_brgy_address', 'count'))); ?>
                     <?= array_sum(array_map('intval', getCountArray('farmers', 'farmer_brgy_address', 'count'))); ?>
                     </pre>
                     </div>


                     <div class="col-lg-6">
                        <div class="card">
                           <div class="card-body">
                              <h5 class="card-title">Distributions Chart</h5>

                              <!-- Bar Chart -->
                              <div id="barChart"></div>
                              <?php
                              // print_r(getCountArray('distributions', 'program_id', 'id'));
                              // print_r(getCountArray('distributions', 'resource_id', 'count'));
                              // print_r(getCountArray('distributions', 'resource_id', ''));
                              ?>

                              <script>
                                 document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#barChart"), {
                                       series: [{
                                          name: 'No. of Farmers',
                                          data: <?= json_encode(getCountArray('distributions', 'program_id', 'count')); ?>
                                       }],

                                       chart: {
                                          type: 'bar',
                                          height: 329
                                       },
                                       plotOptions: {
                                          bar: {
                                             borderRadius: 4,
                                             horizontal: true,
                                          }
                                       },
                                       dataLabels: {
                                          enabled: true
                                       },
                                       xaxis: {
                                          categories: <?php
                                                      $programs = getCountArray('distributions', 'program_id', 'id');
                                                      $column = [];
                                                      foreach ($programs as $program) {
                                                         $getById = getById('programs', $program);
                                                         $column[] = $getById['data']['program_name'];
                                                      }
                                                      echo json_encode($column);
                                                      ?>,
                                       }
                                    }).render();
                                 });
                              </script>
                              <!-- End Bar Chart -->

                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6 col-xl-3">
                           <div class="card shadow border-left-primary py-2" style="border-color: red;">
                              <div class="card-body pb-0">
                                 <div class="row g-0 align-items-center">
                                    <div class="col me-2">
                                       <div class="text-uppercase text-danger fw-bold mb-1"><span>Without Owners</span></div>
                                       <div class="row g-0 align-items-center">
                                          <div class="col-auto">
                                             <div class="text-dark fw-bold h5 mb-0 me-3"><span>
                                                   <?= returnNullRows('parcels'); ?>
                                                </span></div>
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

                        <div class="col-md-6 col-xl-3">
                           <div class="card shadow border-left-warning py-2">
                              <div class="card-body pb-0">
                                 <div class="row g-0 align-items-center">
                                    <div class="col me-2">
                                       <div class="text-uppercase text-warning fw-bold mb-1"><span>Pending Programs</span></div>
                                       <div class="text-dark fw-bold h5 mb-0"><span><?= countRows('programs', 'pending_programs'); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-center">
                                 <a href="../program/programs-list.php" class=" text-warning">
                                    More info<i class="bi bi-arrow-right-short"></i>
                                 </a>
                              </div>
                           </div>

                        </div>

                        <div class="col-md-6 col-xl-3">
                           <div class="card shadow border-left-primary py-2" style="border-color: red;">
                              <div class="card-body pb-0">
                                 <div class="row g-0 align-items-center">
                                    <div class="col me-2">
                                       <div class="text-uppercase text-danger fw-bold mb-1"><span>Expired Programs</span></div>
                                       <div class="row g-0 align-items-center">
                                          <div class="col-auto">
                                             <div class="text-dark fw-bold h5 mb-0 me-3"><span><?= countRows('programs', 'expired_programs'); ?></span></div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-center">
                                 <a href="../program/programs-list.php" class=" text-danger">
                                    More info<i class="bi bi-arrow-right-short"></i>
                                 </a>
                              </div>
                           </div>
                        </div>

                        <div class="col-md-6 col-xl-3">
                           <div class="card shadow border-left-warning py-2">
                              <div class="card-body pb-0">
                                 <div class="row g-0 align-items-center">
                                    <div class="col me-2">
                                       <div class="text-uppercase text-warning fw-bold mb-1"><span>Ongoing Programs</span></div>
                                       <div class="text-dark fw-bold h5 mb-0"><span><?= countRows('programs', 'ongoing_programs'); ?></span></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="d-flex align-items-center justify-content-center">
                                 <a href="../program/programs-list.php" class=" text-warning">
                                    More info<i class="bi bi-arrow-right-short"></i>
                                 </a>
                              </div>
                           </div>
                        </div>

                     </div>

                  </div>


               </div>

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <div id="data-container" class="row"></div>
            </div>

         </div>
      </section>
   </main>

   <!-- ======= Footer ======= -->
   </script>
   <?php include '../includes/footer.php' ?>
   <script>
      async function fetchData() {
         try {
            const apiKey = '';
            const lat = 14.9333;
            const lon = 120.8833;

            const response = await fetch(`https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`);

            // Check if the response is not ok
            if (!response.ok) {
               if (response.status === 401) {
                  throw new Error('Unauthorized: Check your API key.');
               } else if (response.status === 404) {
                  throw new Error('Data not found: Check your latitude and longitude.');
               } else {
                  throw new Error(`HTTP error! Status: ${response.status}`);
               }
            }

            const data = await response.json();

            // Check if the data structure is as expected
            if (!data.list || !Array.isArray(data.list)) {
               throw new Error('Invalid data format received.');
            }

            const container = document.getElementById('data-container');
            container.innerHTML = ''; // Clear previous data
            const city = data.city.name;
            const population = data.city.population;
            population.toLocaleString();
            document.getElementById('data-container').innerHTML = `<h1>${city}</h1><h3>Population: ${population}</h3>`

            data.list.forEach(item => {
               const div = document.createElement('div');
               div.className = "col-md-5 mx-4 my-2";
               div.style.boxShadow = "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
               const date = item.dt_txt;
               const temp = item.main.temp;
               const description = item.weather[0].description;
               const iconCode = item.weather[0].icon;

               const speed = item.wind.speed;
               const deg = item.wind.deg;
               const gust = item.wind.gust;
               const clouds = item.clouds.all;



               const iconUrl = `https://openweathermap.org/img/wn/${iconCode}@2x.png`;

               div.innerHTML = `<h2>${date}</h2>
               <p>Temperature: ${temp}°C
               </p><p>${description}</p>
               <img src="${iconUrl}" alt="${description}"/>
               <h5>Wind</h5>
               <div style="display: flex; justify-content: space-between;">
                  <div>Speed: ${speed}</div>
                  <div>Direction: ${deg}</div>
                  <div>Gust: ${gust}</div>
               </div>
               <p>Number of clouds: ${clouds}</p>
               `;
               container.appendChild(div);
            });



         } catch (error) {
            console.error('Error fetching data:', error);
            const container = document.getElementById('data-container');
            container.innerHTML = `<p style="color: red;">Error: ${error.message}</p>`;
         }
      }

      // document.getElementById('profile-tab').addEventListener('click', function() {
      //    fetchData();
      // });
   </script>

</body>

</html>