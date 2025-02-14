<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">
<?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>


  <!-- ======= Main ======= -->
  <main class="main" id="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12 main-table">

          <div class="card-body">
          <?php include '../backend/status-messages.php';?>
            <div class="d-sm-flex justify-content-between">
              <h5 class="card-title">View Program</h5>
              <div class="d-sm-flex justify-content-end align-items-center mt-2">
                <a onclick="window.history.back()" class="btn btn-sm btn-danger">Back</a>
              </div>
            </div>
            <!-- Default Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Program Information</button>
              </li>
            </ul>

            <div class="tab-content pt-2" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                <?php
                $paramValue = checkParamId('id');
                if (!is_numeric($paramValue)) {
                  echo '<h5>Not Available</h5>';
                  return false;
                }
                $program = getById('programs', $paramValue);
                // echo '<pre style="color: red; font-weight: bold;">';
                // print_r($program);
                // echo '</pre></div>';

                if ($program['status'] == 200) {
                  $data = $program['data']
                  // 
                ?>


                  <div class="card">

                    <div class="card-body row g-3">

                      <input type="hidden" class="program_id" value="<?= $data['id']; ?>">

                      <div class="col-md-4 mt-5">
                        <div class="form-floating">
                          <input type="text" value="<?= $data['program_name']; ?>" class="form-control nameOfProgram" id="floatingFname" placeholder="" required>
                          <label for="floatingFname">Name of program</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4 mt-5">
                        <div class="form-floating">
                          <input type="text" value="<?= $data['sourcing_agency']; ?>" class="form-control sourcingAgency" id="floatingMname" placeholder="" required>
                          <label for="floatingMname">Sourcing agency</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4 mt-5">
                        <div class="form-floating">
                          <input type="text" value="<?= $data['program_type']; ?>" class="form-control programType" id="floatingLname" placeholder="" required>
                          <label for="floatingLname">Type</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">Start date</label>
                        <input type="date" value="<?= $data['start_date'] == '0000-00-00' ? '' : $data['start_date']; ?>" class="form-control startDate" id="validationCustom05" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>


                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">End date<span class="red-star">*</span></label>
                        <input type="date" value="<?= $data['end_date']  == '0000-00-00' ? '' : $data['end_date']; ?>" class="form-control endDate" id="validationCustom05" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">Total beneficiaries<span class="red-star">*</span></label>
                        <input type="number" value="<?= $data['total_beneficiaries']; ?>" placeholder="" class="form-control totalBeneficiaries no-spin-button" id="validationCustom05" required max="9999999999" min="9000000000" step="1">
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">Beneficiaries Available<span class="red-star">*</span></label>
                        <input type="number" value="<?= $data['beneficiaries_available']; ?>" placeholder="" class="form-control beneficiaries no-spin-button" id="validationCustom05" required max="9999999999" min="9000000000" step="1">
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-4 mt-5 form-floating mb-3">
                        <textarea required class="form-control description" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"><?= $data['description']; ?></textarea>
                        <label for="floatingTextarea">Description</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                        <h5 class="card-title">Resources List</h5>
                        <a id="addResourcesButton" class="btn btn-sm btn-primary <?= $_SESSION['LoggedInUser']['can_create'] == 0 ? 'd-none': '';?>"><i class="fa-solid fa-plus"></i> Resource</a>
                      </div>

                      <div id="resourcesContainer" class="mt-3">


                        <?php
                        $resources = getById('resources', $paramValue, false, true);

                        if ($resources['status'] == 200) {

                          // echo '<pre style="color: red; font-weight: bold;">';
                          // print_r($resources);
                          // echo '</pre>';

                          foreach ($resources['data'] as $item) {
                        ?>

                            <div class="card my-2">
                              <h5 class="card-title ms-3">Resources</h5>
                              <div class="card-body">
                                <div class="row">

                                  <input type="hidden" class="resources_id" value="<?= $item['id']; ?>">

                                  <div class="col-md-3 mt-1">
                                    <label>Name</label>
                                    <input type="text" value="<?= $item['resources_name']; ?>" placeholder="brand/code" class="form-control resourcesName" required>
                                  </div>

                                  <div class="col-md-3 mt-1">
                                    <label>Type</label>
                                    <input type="text" value="<?= $item['resource_type']; ?>" placeholder="seedlings/fertilizers/cash" class="form-control resourcesType" required>
                                  </div>

                                  <div class="col-md-3 mt-1">
                                    <label>Total Quantity/Amount</label>
                                    <input type="number" value="<?= $item['total_quantity']; ?>" class="form-control resourcesNumber no-spin-button" required>
                                  </div>

                                  <div class="col-md-3 mt-1">
                                    <label>Available Quantity/Amount</label>
                                    <input type="number" value="<?= $item['quantity_available']; ?>" class="form-control resourcesAvailable no-spin-button" required>
                                  </div>

                                  <div class="col-md-3 mb-2 mt-1">
                                    <label>Unit of measure</label>
                                    <input type="text" value="<?= $item['unit_of_measure']; ?>" placeholder="kg/bags/php" class="form-control unitOfMeasure" required>
                                  </div>

                                </div>
                                <div class="d-flex justify-content-end">
                                <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) { ?>
                                  <a class="btn btn-sm btn-danger remove-resources"
                                    onclick="return confirm('Are you sure you want to remove it?')"
                                    href="../backend/archive.php?program=<?= $paramValue; ?>&resources=<?= $item['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                  <?php } ?>
                                </div>
                              </div>
                            </div>

                        <?php
                          }
                        } ?>

                      </div>

                      <?php
                      $tableName = "distributions";

                      $sql = "SELECT * FROM $tableName WHERE is_archived = 0 AND program_id = $paramValue";
                      $result = $conn->query($sql);

                      ?>
                      <script>
                        function getTotalEntries() {
                          return <?= $result->num_rows; ?>
                        }
                      </script>

                      <!-- Distributions -->
                      <div class="table-responsive mb-3 mt-3">
                        <table class="table table-bordered table-striped" id="example">
                          <thead class="thead">
                            <tr>
                              <th class="text-start">FPS</th>
                              <th class="text-start">FFRS System Gen.</th>
                              <th class="text-start">Farmer Name</th>
                              <th class="text-start">Program</th>
                              <th class="text-start">Resources</th>
                              <th class="text-start">Quantity</th>
                              <th class="text-start">Action</th>
                            </tr>
                          </thead>
                          <tbody class="tbod">
                            <?php
                            if ($result->num_rows > 0) {
                              while ($row = $result->fetch_assoc()) {
                                $farmerData = getById('farmers', $row['farmer_id']);
                                $program = getById('programs', $row['program_id']);
                                $resources = getById('resources', $row['resource_id']);
                                if ($farmerData['status'] == 200 || $program['status'] == 200 || $resources['status'] == 200) {
                            ?>
                                  <tr>
                                    <td class="text-start"><?= $row['fps_code']; ?></td>
                                    <td class="text-start"><?= $farmerData['data']['ffrs_system_gen']; ?></td>
                                    <td class="text-start"><?= $farmerData['data']['first_name']; ?> <?= $farmerData['data']['last_name']; ?></td>
                                    <td class="text-start"><?= $program['data']['program_name']; ?></td>

                                    <td class="text-start"><strong><?= $resources['data']['resources_name']; ?></strong></td>

                                    <td class="text-start"><strong><?= $row['quantity_distributed']; ?></strong> <?= $resources['data']['unit_of_measure']; ?></td>

                                    <td class="text-start">
                      <?php if ($_SESSION['LoggedInUser']['can_edit'] == 1) {?>
                                    <a href="../farmer/farmer-view.php?id=<?= $farmerData['data']['id'];?>" class="btn btn-sm btn-success"><i class="bi bi-person-square"></i></a>
                                    <?php } ?>
                      <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) {?>
                                      <a onclick="return confirm('Are you sure you want to archive it?')"
                                        class="btn btn-sm btn-danger"
                                        href="../backend/archive.php?program=<?= $paramValue; ?>&distributions=<?= $row['id']; ?>"><i class="bi bi-archive-fill"></i></a>
                          <?php } ?>
                                        <?php if ($_SESSION['LoggedInUser']['role'] == 1) {?>
                                      <a href="../backend/activity-logs.php?id=<?= $row['id']; ?>&distributions=Distributions"
                                        class="btn btn-sm btn-secondary"><i class="bi bi-info-circle-fill"></i></a>
                                        <?php } ?>
                                    </td>
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

                <?php
                }
                ?>

              </div>
            </div>

            <div class="d-flex justify-content-end mb-3 mt-3">
              <button type="reset" class="btn btn-sm btn-secondary me-2">Reset</button>
              <button type="submit" class="btn btn-sm btn-success me-2" id="submitButton"> <i class="fa-solid fa-floppy-disk"></i> Save</button>
            </div>

            <form class="needs-validation" method="POST" action="program-add-code.php" id="programForm" novalidate>
              <input type="hidden" name="update" value="1">
              <input type="hidden" name="program_data" id="programData" style="width: 100%;">
            </form>

          </div>

        </div>

      </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>
  <script src="./program.js"></script>

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
      const columns = [0, 1, 2, 3, 4];
        example.classList.remove("d-none");
        $("#example").DataTable({
          language: {
            emptyTable: `<span class="text-danger"><strong>No Distributions</strong></span>`,
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
        
  if (!canExport()) {
    const dtButtons = document.querySelector('.dt-buttons');
  if (dtButtons) {
    dtButtons.style.display = 'none';
  }
}  
    });
  </script>

</body>

</html>