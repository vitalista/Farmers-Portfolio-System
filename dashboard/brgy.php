<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">

   <!-- ======= Header ======= -->
   <?php include '../includes/header.php' ?>

   <!-- ======= Sidebar ======= -->
   <?php include '../includes/sidebar.php' ?>

   <main id="main" class="main">

   <?php includes('brgy-dashboard.php'); ?>

   <div id="wrapper">

    <div class="d-flex flex-column" id="content-wrapper">
      <div id="content" style="font-size: 21px;">

        <div class="container-fluid">
          <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Barangay Name</h3>
          </div>
        </div>
        <div class="container" style="padding-right: 24px;padding-left: 24px;">
          <div class="row">
            <div class="col">
              <div class="card" data-aos="zoom-in" data-aos-duration="300" data-aos-delay="50" style="margin: 20px;">
                <div class="card-header">
                  <h3 class="text-center"
                    style="margin-top: 0px;margin-left: 0px;font-weight: bold;color: #026a44;font-family: Nunito, sans-serif;padding-bottom: 0px;border-bottom-width: 2px;margin-bottom: 0px;">
                    Gender Ratio</h3>
                </div>
                <div class="card-body text-center justify-content-center align-items-center">
                  <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                      <div class="col-md-1 d-grid"><i class="fa fa-male"
                          style="font-size: 60px;color: rgb(54,77,249);"></i></div>
                      <div class="col d-grid"><span
                          style="font-size: 20px;font-weight: bold;font-family: Roboto, sans-serif;color: var(--bs-emphasis-color);margin-left: 11px;">Male</span>
                        <div><span style="margin-left: 14px;color: var(--bs-emphasis-color);">0</span></div>
                      </div>
                    </div><span
                      style="background: #9a8f8f;width: 10px;margin-right: 15px;margin-left: 6px;height: 100%;color: rgb(131,132,139);"></span>
                    <div class="row">
                      <div class="col-md-1 d-grid"><i class="fa fa-female"
                          style="font-size: 60px;color: rgb(232,23,23);"></i></div>
                      <div class="col d-grid"><span
                          style="font-size: 20px;margin-left: 5px;margin-top: 0px;font-weight: bold;font-family: Roboto, sans-serif;color: var(--bs-emphasis-color);">Female</span>
                        <div><span style="margin-left: 14px;color: var(--bs-emphasis-color);">0</span></div>
                      </div>
                    </div>
                  </div>
                  <div style="margin-top: 15px;"><span style="font-size: 25px;">Total:&nbsp;&nbsp;</span><span
                      style="font-size: 24px;">0</span></div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card" data-aos="zoom-in" data-aos-duration="50" data-aos-delay="50" style="margin: 20px;">
                <div class="card-header">
                  <h3 class="text-center"
                    style="margin-top: 0px;margin-left: 0px;font-weight: bold;color: #026a44;font-family: Nunito, sans-serif;padding-bottom: 0px;border-bottom-width: 2px;margin-bottom: 0px;">
                    Gender Ratio</h3>
                </div>
                <div class="card-body text-center justify-content-center align-items-center">
                  <div class="d-flex justify-content-center align-items-center">
                    <div class="row">
                      <div class="col-md-1 d-grid"><i class="fa fa-pagelines"
                          style="font-size: 60px;color: rgb(29,140,20);"></i></div>
                      <div class="col d-grid"><span
                          style="font-size: 20px;font-weight: bold;font-family: Roboto, sans-serif;color: var(--bs-emphasis-color);margin-left: 11px;">Crop</span>
                        <div><span style="margin-left: 14px;color: var(--bs-emphasis-color);">0</span></div>
                      </div>
                    </div><span
                      style="background: #9a8f8f;width: 10px;margin-right: 15px;margin-left: 6px;height: 100%;color: rgb(131,132,139);"></span>
                    <div class="row">
                      <div class="col-md-1 d-grid"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                          viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                          stroke-linejoin="round" class="icon icon-tabler icon-tabler-pig"
                          style="font-size: 60px;color: rgb(193,54,137);">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M15 11v.01"></path>
                          <path
                            d="M16 3l0 3.803a6.019 6.019 0 0 1 2.658 3.197h1.341a1 1 0 0 1 1 1v2a1 1 0 0 1 -1 1h-1.342a6.008 6.008 0 0 1 -1.658 2.473v2.027a1.5 1.5 0 0 1 -3 0v-.583a6.04 6.04 0 0 1 -1 .083h-4a6.04 6.04 0 0 1 -1 -.083v.583a1.5 1.5 0 0 1 -3 0v-2l0 -.027a6 6 0 0 1 4 -10.473h2.5l4.5 -3z">
                          </path>
                        </svg></div>
                      <div class="col d-grid"><span
                          style="font-size: 20px;margin-left: 5px;margin-top: 0px;font-weight: bold;font-family: Roboto, sans-serif;color: var(--bs-emphasis-color);">Livestock</span>
                        <div><span style="margin-left: 14px;color: var(--bs-emphasis-color);">0</span></div>
                      </div>
                    </div>
                  </div>
                  <div style="margin-top: 15px;"><span style="font-size: 25px;">Total:&nbsp;&nbsp;</span><span
                      style="font-size: 24px;">0</span></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row" style="margin-top: 0px;">
            <div class="col">
              <div class="card" data-aos="zoom-in-right" data-aos-duration="500" data-aos-delay="150"
                style="margin: 20px;margin-top: 0px;">
                <div class="card-header">
                  <h4 style="color: #026a44;font-weight: bold;">Total Distribution Overview</h4>
                </div>
                <div class="card-body">
                  <div><canvas
                      data-bss-chart="{&quot;type&quot;:&quot;bar&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;2018&quot;,&quot;2019&quot;,&quot;2020&quot;,&quot;2021&quot;,&quot;2022&quot;,&quot;2023&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;Revenue&quot;,&quot;backgroundColor&quot;:&quot;#4e73df&quot;,&quot;borderColor&quot;:&quot;#4e73df&quot;,&quot;data&quot;:[&quot;4500&quot;,&quot;5300&quot;,&quot;6250&quot;,&quot;7800&quot;,&quot;9800&quot;,&quot;15000&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:true,&quot;legend&quot;:{&quot;display&quot;:false,&quot;labels&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}},&quot;title&quot;:{&quot;fontStyle&quot;:&quot;bold&quot;},&quot;scales&quot;:{&quot;xAxes&quot;:[{&quot;ticks&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}],&quot;yAxes&quot;:[{&quot;ticks&quot;:{&quot;fontStyle&quot;:&quot;normal&quot;}}]}}}"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card" data-aos="zoom-in-left" data-aos-duration="500" data-aos-delay="150"
                style="margin: 20px;margin-top: 0px;">
                <div class="card-header d-flex justify-content-between">
                  <h4 style="color: #026a44;font-weight: bold;">Program History</h4><button class="btn btn-primary"
                    type="button"
                    style="height: 34.9px;background: rgba(78,115,223,0);border-style: none;border-bottom-style: none;color: #026a44;text-decoration:  underline;"
                    data-bs-toggle="modal" data-bs-target="#modal-1">Veiw all</button>
                </div>
                <div class="card-body">
                  <div class="table-responsive" style="font-size: 18px;">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>Program Name</th>
                          <th>Date Recieved</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr></tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div class="card" data-aos="zoom-in-left" data-aos-duration="30" data-aos-delay="150" style="margin: 20px;">
                <div class="card-header">
                  <h4 style="color: #026a44;font-weight: bold;">Farmers List</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Farm Area</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Jude Kenjay</td>
                          <td>Male</td>
                          <td>2</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Jude Kenjay</td>
                          <td>Female</td>
                          <td>4</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Jude Kenjay</td>
                          <td>Female</td>
                          <td>2</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Jude Kenjay</td>
                          <td>Male</td>
                          <td>1</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Vergel Jhon</td>
                          <td>Male</td>
                          <td>3</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Aron Liorca</td>
                          <td>Male</td>
                          <td>5</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Jude Kenjay</td>
                          <td>Male</td>
                          <td>1</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Aron Llorca</td>
                          <td>Female</td>
                          <td>2</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                        <tr>
                          <td>Ace Vergel</td>
                          <td>Male</td>
                          <td>1</td>
                          <td><button class="btn btn-primary" type="button" style="background: rgb(50,142,7);">View
                              Profile</button></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" role="dialog" tabindex="-1" id="modal-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" style="color: #026a44;font-weight: bold;">Program History</h4><button
                class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col">
                  <div class="table-responsive" style="font-size: 18px;">
                    <table class="table table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>Program Name</th>
                          <th>Date Recieved</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr>
                          <td>Palay</td>
                          <td>09/22/2020</td>
                        </tr>
                        <tr></tr>
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

      <!-- ======= Footer ======= -->

      <?php include '../includes/footer.php' ?>

</body>

</html>