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

    <style>
      .load-div {
        width: 971.200;
        height: 649.200;
      }
    </style>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Farmers list</h5>
                <div>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                    Filter
                  </button>
                  <a href="../farmer/farmer-add.php" class="btn btn-secondary"><i class="bi bi-plus-lg"></i></a>
                </div>
              </div>
              <?php include 'filter.php'; ?>

              <!-- <a href="#" class="btn -btn-success">Completed</a> -->

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
                    <th>Action</th>
                    <th>Birthday</th>
                    <th>Municipality</th>
                    <!-- <?php for ($header = 1; $header <= 18; $header++): ?>
                      <th>Header <?php echo $header; ?></th>
                    <?php endfor; ?> -->

                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>BUTTON</td>
                    <td>None</td>
                    <td>Aries</td>
                    <td>Vitalista</td>
                    <td>Gonzales</td>
                    <td>Pagala</td>
                    <td>F</td>
                    <td>
                      <a href="farmer-view.php" class="btn btn-primary"><i class="bi bi-person-square"></i></a>
                      <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                      <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>
                    </td>
                    <td>09/23/02</td>
                    <td>Bulacan</td>
                  </tr>

                  <?php
                  if ($result->num_rows > 0) {
                    // Fetching each row and displaying data
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>
                        <td></td>
                        <td><?= $row['column1'] ?></td>
                        <td><?= $row['column3'] ?></td>
                        <td><?= $row['column4'] ?></td>
                        <td><?= $row['column5'] ?></td>
                        <td><?= $row['column9'] ?></td>
                        <td><?= $row['column7'] ?></td>
                        <td>
                          <a href="farmer-view.php" class="btn btn-primary"><i class="bi bi-person-square"></i></a>
                          <a href="#" class="btn btn-danger"><i class="bi bi-archive-fill"></i></a>
                          <a class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#activityModal"><i class="bi bi-info-circle-fill"></i></a>
                        </td>
                        <td><?= $row['column8'] ?></td>
                        <td><?= $row['column10'] ?></td>
                        <!-- <td><?= $row['column11'] ?></td>
                        <td><?= $row['column12'] ?></td>
                        <td><?= $row['column13'] ?></td>
                        <td><?= $row['column14'] ?></td>
                        <td><?= $row['column15'] ?></td>
                        <td><?= $row['column16'] ?></td>
                        <td><?= $row['column17'] ?></td>
                        <td><?= $row['column18'] ?></td>
                        <td><?= $row['column19'] ?></td>
                        <td><?= $row['column20'] ?></td>
                        <td><?= $row['column21'] ?></td>
                        <td><?= $row['column22'] ?></td>
                        <td><?= $row['column23'] ?></td>
                        <td><?= $row['column24'] ?></td>
                        <td><?= $row['column25'] ?></td>
                        <td><?= $row['column26'] ?></td>
                        <td><?= $row['column27'] ?></td>
                        <td><?= $row['column28'] ?></td> -->
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

                if (data === "BUTTON") {
                  return `<button type="button" class="btn btn-danger ms-4" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-question-diamond-fill"></i>
  </button>`;
                }
                return `<button class="btn btn-success ms-4"><i class="bi bi-check-circle-fill"></i></button>`;
                //               return `  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#basicModal">
                //   Unregistered
                // </button>`;
                // return `<button class="btn btn-secondary"  data-bs-toggle="modal" data-bs-target="#disablebackdrop">${data}</button>`;
              }
              return null;
            }
          }]
        });
      }, 500);
    });
  </script>
  <div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Provide FFRS code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 mb-3">

            <label for="cropname" class="form-label">Enter <strong>FFRS</strong> code</label>
            <input type="text" id="cropname" class="form-control" placeholder="Type here...">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div><!-- End Unregistered Modal-->

</body>

</html>