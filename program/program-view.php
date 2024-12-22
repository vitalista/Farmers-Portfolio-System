<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">

  <!-- ======= Header ======= -->
  <?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>


  <!-- ======= Main ======= -->
  <main class="main" id="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12 main-table">

          <div class="card-body">
            <div class="d-sm-flex justify-content-between">
              <h5 class="card-title">View Program</h5>
              <div class="d-sm-flex justify-content-end align-items-center mt-2">
                <a onclick="window.history.back()" class="btn btn-info">Back</a>
                <a class="btn btn-success ms-2">Edit</a>
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
                        <input type="date" value="<?= $data['start_date'] == '0000-00-00' ? '': $data['start_date'];?>" class="form-control startDate" id="validationCustom05" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>


                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">End date<span class="red-star">*</span></label>
                        <input type="date" value="<?= $data['end_date']  == '0000-00-00' ? '': $data['end_date']; ?>" class="form-control endDate" id="validationCustom05" required>
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
                        <a id="addResourcesButton" class="btn btn-primary">Add Resource</a>
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
                                  <a class="btn btn-danger remove-resources"
                                  onclick="return confirm('Are you sure you want to remove it?')"
                                  href="../backend/archive.php?program=<?= $paramValue; ?>&resources=<?= $item['id'];?>"
                                  >Remove</a>
                                </div>
                              </div>
                            </div>

                        <?php
                          }
                        } ?>

                      </div>

                      <!-- Distributions -->
                      <!-- <div class="table-responsive mb-3">
                        <table class="table table-bordered table-striped">
                          <thead class="thead">
                            <tr>
                              <th>FFRS System Gen.</th>
                              <th>Farmer Name</th>
                              <th>Program</th>
                              <th>Resources</th>
                              <th>Quantity</th>
                              <th>Remove</th>
                            </tr>
                          </thead>
                          <tbody class="tbod">
                            <tr>
                              <td><strong>03-14-03-003-ABCDE</strong></td>
                              <td>Pedro Delacruz</td>
                              <td>Cash Assistance</td>
                              <td>Cash</td>
                              <td>
                                <div class="input-group qtyBox">
                                  <input disabled type="text" value="200" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                  <p class="ms-1 mb-0">Php</p>
                                </div>
                              </td>
                              <td>
                                <a href="#" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                              </td>
                            </tr>
                            <tr>
                              <td><strong>03-14-03-003-ABCDE</strong></td>
                              <td>Pedro Delacruz</td>
                              <td>Cash Assistance</td>
                              <td>Cash</td>
                              <td>
                                <div class="input-group qtyBox">
                                  <input disabled type="text" value="200" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                  <p class="ms-1 mb-0">Php</p>
                                </div>
                              </td>
                              <td>
                                <a href="#" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                              </td>
                            </tr>
                            <tr>
                              <td colspan="3"></td>
                              <td><b>Total</b></td>
                              <td><b>201</b></td>
                            </tr>
                          </tbody>
                        </table>
                      </div> -->

                    </div>

                  </div>

                <?php
                }
                ?>

              </div>
            </div>

            <div class="d-flex justify-content-end mb-3 mt-3">
              <button type="reset" class="btn btn-secondary me-2">Reset</button>
              <button type="submit" class="btn btn-success me-2" id="submitButton">Save</button>
            </div>

            <form class="needs-validation" method="POST" action="program-add-code.php" id="programForm" novalidate>
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

</body>

</html>