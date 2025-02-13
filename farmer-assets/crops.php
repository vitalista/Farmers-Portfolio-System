<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<body class="login-bg">
<?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>
  <!-- Database -->

  <main id="main" class="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body main-table">
            <?php include '../backend/status-messages.php';?>
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-header">Crops list</h5>
                <div>
                  <a href="crops.php" class="btn btn-sm btn-danger"><i class="bi bi-arrow-counterclockwise"></i>
                  </a>
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                  <i class="bi bi-sort-down"></i>
                  </button>
                  <a href="../farmer/farmer-add.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus-lg"></i></a>
                </div>
              </div>

              <?php include 'crops/filter.php'; ?>

              <table id="example" class="display nowrap d-none">
                <thead>
                  <tr>
                    <th class="text-start">FPS</th>
                    <th class="text-start">FFRS</th>
                    <th class="text-start">Crop Name</th>
                    <th class="text-start">Crop Area</th>
                    <th class="text-start">Classification</th>
                    <th class="text-start">Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $farmerData = getById('farmers', $row['farmer_id']);
                      if ($farmerData['status'] == 200) {
                  ?>
                        <tr>
                          <td class="text-start"><?= $row['fps_code']; ?></td>
                          <td class="text-start"><?= $row['ffrs_system_gen']; ?></td>
                          <td class="text-start"><?= $row['crop_name'] ?></td>
                          <td class="text-start"><strong><?= $row['crop_area'] ?>Ha</strong></td>
                          <td class="text-start"><?= $row['classification'] ?></td>
                        <?php if(!isset($_GET['archived'])):?>
                          <td class="text-start">
                            <a href="../farmer/farmer-view.php?id=<?= $row['farmer_id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-person-square"></i></a>
                            <a onclick="return confirm('Are you sure you want to archive it?')"
                             href="../backend/archive.php?crop_id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"><i class="bi bi-archive-fill"></i></a>
                          <?php if ($_SESSION['LoggedInUser']['role'] == 1) {?>
                             <a href="../backend/activity-logs.php?id=<?= $row['id']; ?>&crops=Crop"
                              class="btn btn-sm btn-secondary"><i class="bi bi-info-circle-fill"></i></a>
                            <?php }?>
                          </td>
                          <?php else:?>
                          <td class="text-start">
                          <a onclick="return confirm('Are you sure you want to restore it?')" 
                          href="../backend/restore.php?crop_id=<?= $row['id'];?>" class="btn btn-sm btn-primary"><i class="bi bi-arrow-repeat"></i></a>
                          <?php if ($_SESSION['LoggedInUser']['role'] == 1) {?>
                          <a class="btn btn-sm btn-secondary" href="../backend/archived-log.php?id=<?= $row['id']; ?>&crops=Crop"><i class="bi bi-info-circle-fill"></i></a>
                          <?php }?>
                          </td>
                        <?php endif;?>
                        </tr>
                  <?php
                      }
                    }
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
  <?php include '../includes/footer.php'; ?>
  <script>
    let totalEntries = getTotalEntries();

    // Calculate 25%, 50%, and 75% of the total entries
    let twentyFivePercent = Math.ceil(totalEntries * 0.25);
    let fiftyPercent = Math.ceil(totalEntries * 0.5);
    let seventyFivePercent = Math.ceil(totalEntries * 0.75);

    let lengthMenuValues = [
      10,
      twentyFivePercent,
      fiftyPercent,
      seventyFivePercent,
      -1,
    ];
    let lengthMenuLabels = [
      10,
      `${twentyFivePercent} (25%)`,
      `${fiftyPercent} (50%)`,
      `${seventyFivePercent} (75%)`,
      "Show All",
    ];

    document.addEventListener("DOMContentLoaded", function() {
      const example = document.getElementById("example");
      const columns = [0, 1, 2, 3];
      setTimeout(() => {
        example.classList.remove("d-none");
        $("#example").DataTable({
          language: {
            emptyTable: `<span class="text-danger"><strong>Empty Table</strong></span>`,
          },
          dom: 'B<"table-top"lf>t<"table-bottom"ip>',
          responsive: true,
          buttons: [{
              extend: "copy",
              title: "Baliwag Agriculture Office",
              exportOptions: {
                columns: columns, // Specify the columns you want to copy
                modifier: {
                  page: "current", // Only copy the data on the current page
                },
              },
            },

            {
              extend: "csv",
              title: "Baliwag Agriculture Office",
              action: function(e, dt, node, config) {
                config.exportOptions = {
                  columns: columns,
                  modifier: {
                    page: "current",
                  },
                };

                $.fn.dataTable.ext.buttons.csvHtml5.action(e, dt, node, config);
              },
            },
            {
              extend: "print",
              action: function(e, dt, node, config) {
                config.customize = function(win) {
                  $(win.document.body)
                    .css("font-size", "12pt")
                    .find("h1")
                    .replaceWith(
                      '<h4 style="font-weight: bold;"><img style="width: 30px; margin: 0px 0px 4px 0px" src="../assets/img/Agri Logo.png" alt="">Baliwag Agriculture Office</h4>'
                    );
                };

                config.exportOptions = {
                  columns: columns,
                  modifier: {
                    page: "current",
                  },
                };

                $.fn.dataTable.ext.buttons.print.action(e, dt, node, config);
              },
            },
            {
              extend: "excel",
              title: "Baliwag Agriculture Office",
              action: function(e, dt, node, config) {
                config.exportOptions = {
                  columns: columns,
                  modifier: {
                    page: "current",
                  },
                };

                $.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, node, config);
              },
            },
            {
              extend: "pdf",
              title: "Baliwag Agriculture Office",
              action: function(e, dt, node, config) {
                config.exportOptions = {
                  columns: columns,
                  modifier: {
                    page: "current",
                  },
                };

                $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, node, config);
              },
            },
          ],
          colReorder: true,
          fixedHeader: true,
          rowReorder: false,
          lengthMenu: [lengthMenuValues, lengthMenuLabels],
        });
      }, 500);
    });
  </script>
</body>

</html>