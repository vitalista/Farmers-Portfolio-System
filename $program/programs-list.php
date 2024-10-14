<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<body class="login-bg">

  <!-- ======= Header ======= -->
  <?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>
  <?php require '../backend/database.php' ?>

  <main id="main" class="main">

    <div class="pagetitle">
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Programs list</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                  Filter
                </button>
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
                    <th>Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Beneficiaries</th>
                    <th>Sourcing Agency</th>
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
            <td>Training</td>
            <td>2024-01-15</td>
            <td>2024-03-15</td>
            <td>150</td>
            <td>AgriTech Institute</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Organic Crop Development</td>
            <td>Grant</td>
            <td>2024-02-01</td>
            <td>2024-05-01</td>
            <td>200</td>
            <td>Green Earth Fund</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Water Conservation Project</td>
            <td>Workshop</td>
            <td>2024-03-10</td>
            <td>2024-04-20</td>
            <td>100</td>
            <td>Eco Water Solutions</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Pest Management Training</td>
            <td>Training</td>
            <td>2024-01-20</td>
            <td>2024-02-20</td>
            <td>120</td>
            <td>Crop Care Agency</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Cash Assistance Program A</td>
            <td>Cash Assistance</td>
            <td>2024-04-15</td>
            <td>2024-06-15</td>
            <td>300</td>
            <td>Relief Ag Network</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Youth in Agriculture</td>
            <td>Mentorship</td>
            <td>2024-02-15</td>
            <td>2024-06-15</td>
            <td>50</td>
            <td>Future Farmers Org.</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Cash Assistance Program B</td>
            <td>Cash Assistance</td>
            <td>2024-05-01</td>
            <td>2024-08-01</td>
            <td>250</td>
            <td>Community Support Fund</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Farmer Cooperative Setup</td>
            <td>Workshop</td>
            <td>2024-06-01</td>
            <td>2024-08-01</td>
            <td>300</td>
            <td>Community Ag Group</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Agroforestry Practices</td>
            <td>Training</td>
            <td>2024-05-15</td>
            <td>2024-09-15</td>
            <td>180</td>
            <td>Forest & Farm Initiative</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
           </td>
        </tr>
        <tr>
            <td>Climate Resilience Program</td>
            <td>Research</td>
            <td>2024-07-01</td>
            <td>2024-10-01</td>
            <td>90</td>
            <td>Climate Ag Agency</td>
            <td>
            <a href="#" class="btn btn-info">view</a>
          <a href="#" class="btn btn-danger">delete</a>
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