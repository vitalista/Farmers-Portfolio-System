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
            <h5 class="card-header">Edits user</h5>
            <div class="d-flex justify-content-end">
           
            <a href="#" class="btn btn-success  me-2">Edit</a>
            <a href="users-list.php" class="btn btn-primary">Back</a>
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

                      <div class="col-md-12 mt-5">
                        <div class="form-floating">
                          <input type="text" class="form-control" id="floatingFname" placeholder="" value="Juan Pedro Delacruz" required>
                          <label for="floatingFname"><strong>Full Name </strong>(e.g., Juan Pedro Delacruz)</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-6">
                      <label for="yourUsername" class="form-label text-center">Email</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="username">@</span>
                        <input type="text" name="username" class="form-control p-3" id="yourUsername" value="juan@gmail.com" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourPassword" class="form-label text-center">Password</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="password"><i class="bi bi-eye" id="iconPassword"></i></span>
                        <input type="password" name="password" class="form-control p-3" id="yourPassword" value="12345678" required>
                        <div class="invalid-feedback">Please enter your password!</div>
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