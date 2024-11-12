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
                <h5 class="card-header">Parcels list</h5>
                <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                Filter
              </button>
                <a href="../farmer/farmer-add.php" class="btn btn-secondary"><i class="bi bi-plus-lg"></i></a>
                </div>
              </div>

              <?php
              $tableName = "your_table_name";

              $sql = "SELECT * FROM $tableName LIMIT 200";
              $result = $conn->query($sql);

              ?>
              <script>
                function getTotalEntries() {
                  return <?= $result->num_rows ?>;
                }
              </script>

              <?php include 'filter.php'; ?>

              <div id="loadingDiv" class="d-flex justify-content-center d-none" style="display: none;">
                <div class="spinner-border" style="width: 50px; height: 50px;" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>
              </div>

              <!-- <a href="#" class="btn -btn-success">Completed</a> -->

              <table id="example" class="display nowrap d-none">
                <thead>
                  <tr>
                    <th>FFRS</th>
                    <th>Farm Type</th>
                    <th>Brgy</th>
                    <th>Parcel Area</th>
                    <th>Action</th>
                    <!-- <?php for ($header = 1; $header <= 16; $header++): ?>
                      <th>Header <?php echo $header; ?></th>
                    <?php endfor; ?> -->

                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>
                        <td><?=$row['column1']?></td>
                        <td><?=$row['column24']?></td>
                        <td><?=$row['column16']?></td>
                        <td><strong><?=$row['column19']?> Ha</strong></td>
                        <td>
                        <a href="../farmer/farmer-view.php" class="btn btn-primary"><i class="bi bi-person-square"></i></a>
                        <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                        <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>
                        </td>
                      </tr>
                  <?php
                    }
                  } else {
                    echo '<tr rowspan="9"></tr>';
                  }
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
        // loadingDiv.classList.add("d-none");
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
                // return `<button class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#disablebackdrop">${data}</button>`;
                return `<b>${data}</b>`;
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