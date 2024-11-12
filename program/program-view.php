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
            <form class="needs-validation" id="farmForm" novalidate>
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Program Information</button>
                </li>
              </ul>

              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                  <div class="card">

                    <div class="card-body row g-3">

                      <div class="col-md-4 mt-5">
                        <div class="form-floating">
                          <input type="text" class="form-control" id="floatingFname" placeholder="" required>
                          <label for="floatingFname">Name of program</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4 mt-5">
                        <div class="form-floating">
                          <input type="text" class="form-control" id="floatingMname" placeholder="" required>
                          <label for="floatingMname">Sourcing agency</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4 mt-5">
                        <div class="form-floating">
                          <input type="text" class="form-control" id="floatingLname" placeholder="" required>
                          <label for="floatingLname">Type</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">Start date</label>
                        <input type="date" class="form-control" id="validationCustom05" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>


                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">End date<span class="red-star">*</span></label>
                        <input type="date" class="form-control" id="validationCustom05" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Total beneficiaries<span class="red-star">*</span></label>
                        <input type="number" placeholder="" class="form-control no-spin-button" id="validationCustom05" required max="9999999999" min="9000000000" step="1">
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-4 mt-5 form-floating mb-3">
                        <textarea required class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"></textarea>
                        <label for="floatingTextarea">Description</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                        <h5 class="card-title">Resources List</h5>
                        <a id="addResourcesButton" class="btn btn-primary">Add Resource</a>
                      </div>

                      <div id="resourcesContainer" class="mt-3">
                        <div class="card my-2">
                        <h5 class="card-title ms-3">Resource</h5>
                        <div class="card-body">
                          <div class="row">

                            <div class="col-md-3 mt-1">
                              <label>Name</label>
                              <input type="text" placeholder="brand/code" class="form-control farmSize" required>
                            </div>

                            <div class="col-md-3 mt-1">
                              <label>Type</label>
                              <input type="text" placeholder="seedlings/fertilizers/cash" class="form-control farmSize" required>
                            </div>

                            <div class="col-md-3 mt-1">
                              <label>Quantity/Amount</label>
                              <input type="number" class="form-control farmSize no-spin-button" required>
                            </div>

                            <div class="col-md-3 mb-2 mt-1">
                              <label>Unit of measure</label>
                              <input type="text" placeholder="kg/bags/php" class="form-control farmSize" required>
                            </div>

                          </div>
                          <div class="d-flex justify-content-end">
                            <a class="btn btn-danger remove-resources">Remove Resource</a>
                          </div>
                        </div>
                        </div>

                      </div>

                      <div class="table-responsive mb-3">
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
                      </div>

                    </div>

                  </div>

                </div>
              </div>

          </div>


          <div class="d-flex justify-content-end mb-3 mt-3">
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-success me-2">Save</button>
          </div>
          </form>

        </div>

      </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>
  <script>
    let newFarmInput = `
    <h5 class="card-title ms-3">Resource</h5>
      <div class="card-body">
            <div class="row">
            
                <div class="col-md-3 mt-1">
                    <label>Name</label>
                    <input type="text" placeholder="brand/code" class="form-control farmSize" required>
                </div>

                <div class="col-md-3 mt-1">
                    <label>Type</label>
                    <input type="text" placeholder="seedlings/fertilizers/cash" class="form-control farmSize" required>
                </div>

                <div class="col-md-3 mt-1">
                    <label>Quantity/Amount</label>
                    <input type="number" class="form-control farmSize no-spin-button" required>
                </div>

                <div class="col-md-3 mb-2 mt-1">
                    <label>Unit of measure</label>
                    <input type="text" placeholder="kg/bags/php" class="form-control farmSize" required>
                </div>

            </div>
                <div class="d-flex justify-content-end">
                <a class="btn btn-danger remove-resources">Remove Resource</a>
                </div>
            </div>
  `;

    document.getElementById('addResourcesButton').addEventListener('click', function() {
      const resourcesContainer = document.getElementById('resourcesContainer');

      // Create a new farm input card
      const newResourcesCard = document.createElement('div');
      newResourcesCard.className = 'card my-2';
      newResourcesCard.innerHTML = newFarmInput;

      // Append the new card to the container
      resourcesContainer.appendChild(newResourcesCard);

      entryFade(newResourcesCard);
      // Add event listener to the remove farm button
      newResourcesCard.querySelector('.remove-resources').addEventListener('click', function() {
        removalFade(newResourcesCard);
        setTimeout(() => {
          resourcesContainer.removeChild(newResourcesCard);
        }, 250);

      });
    });
  </script>


</body>

</html>