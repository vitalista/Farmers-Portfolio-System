<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<body class="login-bg">

  <!-- ======= Header ======= -->
  <?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>
  <!-- Database -->

  <main id="main" class="main">

    <div class="pagetitle">
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Resources list</h5>
                <div>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                    Filter
                  </button>
                  <a href="program-add.php" class="btn btn-secondary"><i class="bi bi-plus-lg"></i></a>
                </div>
              </div>
              <?php include 'filter.php'; ?>
              <div id="loadingDiv" class="d-flex justify-content-center d-none">
                <div class="spinner-border" style="width: 50px; height: 50px;" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>

              <!-- <a href="#" class="btn -btn-success">Completed</a> -->

              <table id="example" class="display nowrap d-none">
                <thead>
                  <tr>
                    <th>Program Name</th>
                    <th>Resources Type</th>
                    <th>Total Quantity</th>
                    <th>Quantity Available</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  // if ($result->num_rows > 0) {
                  //   while ($row = $result->fetch_assoc()) {
                  ?>


                  <tr>
                    <td>Sustainable Farming 101</td>
                    <td>Seeds</td>
                    <td>500</td>
                    <td>450</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Organic Crop Development</td>
                    <td>Fertilizers</td>
                    <td>300</td>
                    <td>250</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Water Conservation Project</td>
                    <td>Drip Irrigation Kits</td>
                    <td>150</td>
                    <td>100</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Pest Management Training</td>
                    <td>Pesticides</td>
                    <td>200</td>
                    <td>180</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Cash Assistance Program A</td>
                    <td>Cash</td>
                    <td>50,000 Php</td>
                    <td>50,000 Php</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Youth in Agriculture</td>
                    <td>Mentorship Resources</td>
                    <td>50</td>
                    <td>50</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Cash Assistance Program B</td>
                    <td>Cash</td>
                    <td>30,000 Php</td>
                    <td>30,000 Php</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Farmer Cooperative Setup</td>
                    <td>Cooperative Tools</td>
                    <td>200</td>
                    <td>180</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Agroforestry Practices</td>
                    <td>Trees</td>
                    <td>1,000</td>
                    <td>900</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>
                  <tr>
                    <td>Climate Resilience Program</td>
                    <td>Research Materials</td>
                    <td>500</td>
                    <td>400</td>
                    <td>
                      <a href="program-view.php" class="btn btn-success"><i class="bi bi-three-dots"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>

                    </td>
                  </tr>



                  <?php

                  //   }
                  // } else {
                  //   echo '<tr rowspan="9"></tr>';
                  // }
                  ?>

                </tbody>

              </table>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>
  <script>
    let totalEntries = getTotalEntries();

    // Calculate 25%, 50%, and 75% of the total entries
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
      const loadingDiv = document.getElementById("loadingDiv");
      const example = document.getElementById("example");

      // Show the loading div
      // loadingDiv.classList.remove("d-none");

      // Hide it after 3 seconds
      setTimeout(() => {
        loadingDiv.classList.add("d-none");
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
                // return `<button class="btn btn-success">Registered</button>`;
                // return `<button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disablebackdrop">Unregistered</button>`;
                return `<strong>${data}</strong>`;
                // return `<button class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#disablebackdrop">${data}</button>`;
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