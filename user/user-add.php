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
            <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Add user</h5>
            <a href="users-list.php" class="btn btn-primary">Back</a>
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

                      <div class="col-md-12 mt-5">
                        <div class="form-floating">
                          <input type="text" class="form-control" id="floatingFname" placeholder="" required>
                          <label for="floatingFname"><strong>Full Name </strong>(e.g., Juan Pedro Delacruz)</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-6">
                      <label for="yourUsername" class="form-label text-center">Email</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="username">@</span>
                        <input type="text" name="username" class="form-control p-3" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourPassword" class="form-label text-center">Password</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="password"><i class="bi bi-eye" id="iconPassword"></i></span>
                        <input type="password" name="password" class="form-control p-3" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    <div class="row mt-4">
                      <label class="col-sm-3 col-form-label"><strong>Restriction Options:</strong></label>
                      <div class="col-sm-4 mt-2">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                          <label class="form-check-label" for="flexSwitchCheckDefault">Can Create?</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                          <label class="form-check-label" for="flexSwitchCheckChecked">Can Edit?</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked1">
                          <label class="form-check-label" for="flexSwitchCheckChecked1">Can Delete?</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault2">
                          <label class="form-check-label" for="flexSwitchCheckDefault2">Can Export?</label>
                        </div>
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault1" checked>
                          <label class="form-check-label" for="flexSwitchCheckDefault1">Banned?</label>
                        </div>
                      </div>
                      <label class="col-sm-2 col-form-label"><strong>Authorization:</strong></label>
                      <div class="col-sm-3">
                      <div class="form-check form-switch mt-2">
                          <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault1">
                          <label class="form-check-label" for="flexSwitchCheckDefault1">Promote to admin?</label>
                        </div>
                      </div>
                    </div>


    
                    </div>

                    <div class="d-flex justify-content-end mb-3 mt-3">
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-success me-2">Save</button>
          </div>

                    </div>

                  </div>

                </div>
              </div>

          </div>

          </form>

        </div>

      </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>


</body>

</html>