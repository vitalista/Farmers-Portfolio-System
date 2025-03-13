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
          <?php include '../backend/status-messages.php' ?>
            <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-header">Edits user</h5>
            <div class="d-flex justify-content-end">
           
            <a href="users-list.php" class="btn btn-sm btn-danger">Back</a>
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

                  <div class="card">
                  <form class="needs-validation" id="farmForm" action="user-code.php" method="POST" novalidate>

                    <div class="card-body row g-3">

                    <?php
                    $user = getById('users', $_SESSION['LoggedInUser']['id']);
    
                    if ($user['status'] == 200) {
                      $data = $user['data']
                    ?>
                      <input type="hidden" name="id" value="<?= $data['id'] ?>">
                      <div class="col-md-6 mt-4">
                      <label class="form-label text-center">Full Name</label>
                        <div class="form-floating">
                          <input type="text" class="form-control" id="floatingFname" name="fullname" placeholder="" value="<?= $data['full_name']?>" required>
                          <label for="floatingFname">(e.g., Juan Pedro Delacruz)</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-6 mt-4">
                      <label for="yourUsername" class="form-label text-center">Email</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="username">@</span>
                        <input type="email" class="form-control p-3" name="email" id="yourUsername" value="<?= $data['email']?>" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <label for="yourPassword" class="form-label text-center">Password</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="password"><i class="bi bi-eye-slash" id="iconPassword"></i></span>
                        <input type="password" name="password" class="form-control p-3" id="yourPassword">
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    <div class="col-md-6">
                        <label for="yourPassword1" class="form-label">Re-type Password</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="password1"><i class="bi bi-eye-slash" id="iconPassword1"></i></span>
                          <input type="password" name="retype" class="form-control p-3" id="yourPassword1" required>
                          <div class="invalid-feedback">Please re-type your password!</div>
                        </div>
                      </div>
    
                    </div>

                    <div class="d-flex justify-content-end mb-3 mt-3">
                      <button type="reset" class="btn btn-sm btn-secondary me-2">Reset</button>
                      <button type="submit" name="settings" class="btn btn-sm btn-success me-2"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>

                    </form>
                    <?php
                    }
                    ?>

                    </div>

                  </div>

                </div>
              </div>

          </div>
        </div>

      </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>


</body>

</html>