<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">

   <!-- ======= Header ======= -->
   <?php include '../includes/header.php' ?>

   <!-- ======= Sidebar ======= -->
   <?php include '../includes/sidebar.php' ?>

   <main id="main" class="main">

      <?php includes('select-dashboard-content.php'); ?>

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
                  <div class="d-sm-flex justify-content-between align-items-center mb-4">
                     <h3 class="text-dark mb-0">Dashboard</h3>

                     <a class="btn btn-primary btn-sm d-none d-sm-inline-block" role="button" data-aos="fade-left" data-aos-duration="400" data-aos-delay="50" href="#"><i class="fas fa-download fa-sm text-white-50"></i>&nbsp;Generate Report</a>
                  </div>
                  <div class="row">
                     <?php if (is_dir('../program')) { ?>
                        <div class="col-md-6 col-xl-3 mb-4">
                           <div class="card shadow border-left-primary py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="50">
                              <div class="card-body">
                                 <div class="row g-0 align-items-center">
                                    <div class="col me-2">
                                       <div class="text-uppercase text-primary fw-bold mb-1"><span>No. of programs</span></div>
                                       <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     <?php } ?>
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

                     <?php if (is_dir('../program')) { ?>

                        <div class="col-md-6 col-xl-3 mb-4">
                           <div class="card shadow border-left-warning py-2" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="200">
                              <div class="card-body">
                                 <div class="row g-0 align-items-center">
                                    <div class="col me-2">
                                       <div class="text-uppercase text-warning fw-bold mb-1"><span>Pending Porgrams</span></div>
                                       <div class="text-dark fw-bold h5 mb-0"><span>0</span></div>
                                    </div>
                                 </div>
                              </div>
                           </div>

                        <?php } ?>

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
                                       labels: ['Rice/Palay', 'Mango', 'Kangkong', 'Papaya', 'Okra']
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
                                       labels: ['Pigs', 'Turkeys', 'Horses', 'Goats', 'Chickens'],
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

            </div>

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
               <div id="data-container" class="row"></div>
            </div>

         </div>
      </section>

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

         document.getElementById('profile-tab').addEventListener('click', function() {
            fetchData();
         });
      </script>

</body>

</html>