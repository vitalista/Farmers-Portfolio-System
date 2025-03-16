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
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Add Program</h5>
              <div>
                <a href="programs-list.php" class="btn btn-sm btn-danger">Back</a>
              </div>
            </div>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Program Information</button>
              </li>
            </ul>

            <div class="tab-content pt-2" id="myTabContent">

             <?php include '../backend/status-messages.php';?>

              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="card">

                  <div class="card-body row g-3">

                    <div class="col-md-4 mt-5">
                      <div class="form-floating">
                        <input type="text" class="form-control nameOfProgram" id="nameOfProgram" placeholder="" required>
                        <label for="nameOfProgram">Name of program</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                    </div>

                    <div class="col-md-4 mt-5">
                      <div class="form-floating">
                        <input type="text" class="form-control sourcingAgency" id="sourcingAgency" placeholder="" required>
                        <label for="sourcingAgency">Sourcing agency</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                    </div>

                    <div class="col-md-4 mt-5">
                      <div class="form-floating">
                        <input type="text" class="form-control programType" id="programType" placeholder="" required>
                        <label for="programType">Type</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <label for="startDate" class="form-label">Start date</label>
                      <input type="date" class="form-control startDate" id="startDate" required>
                      <div class="invalid-feedback">Please enter.</div>
                    </div>


                    <div class="col-md-2">
                      <label for="endDate" class="form-label">End date<span class="red-star red-star"></span></label>
                      <input type="date" class="form-control endDate" id="endDate" required>
                      <div class="invalid-feedback">Please enter.</div>
                    </div>

                    <div class="col-md-2">
                      <label for="totalBeneficiaries" class="form-label">Total beneficiaries<span class="red-star red-star"></span></label>
                      <input type="number" placeholder="" class="form-control no-spin-button totalBeneficiaries" id="totalBeneficiaries" required max="9999999999" min="9000000000" step="1">
                      <div class="invalid-feedback">Please enter.</div>
                    </div>

                    
                    <div class="col-md-1">
                      <label for="programColor" class="form-label">Color<span class="red-star red-star"></span></label>
                      <input type="color" placeholder="" class="form-control programColor" id="programColor">
                    </div>

                    <div class="col-md-5 mt-5 form-floating mb-3">
                      <textarea required class="form-control description" placeholder="Leave a comment here" id="description" style="height: 100px;"></textarea>
                      <label for="description">Description</label>
                      <div class="invalid-feedback">Please enter.</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                      <h5 class="card-title">Resources List</h5>
                      <a id="addResourcesButton" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Resource</a>
                    </div>

                    <div id="resourcesContainer" class="mt-3"></div>

                  </div>

                </div>

              </div>
            </div>

          </div>


          <div class="d-flex justify-content-end mb-3 mt-3">
            <button type="submit" class="btn btn-sm btn-success me-2" id="submitButton"><i class="fa-solid fa-floppy-disk"></i> Save</button>
          </div>

          <form class="needs-validation" method="POST" action="program-add-code.php" id="programForm" novalidate>
          <input type="hidden" name="add" value="0">
          <input type="hidden" name="program_data" id="programData" style="width: 100%;">
          </form>

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