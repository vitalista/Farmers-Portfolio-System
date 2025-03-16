<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>
<?php
if($_SESSION['LoggedInUser']['role'] != 1){
  header('Location: ../logout.php');
}
?>
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
              <h5 class="card-header">Edit user</h5>
              <a href="users-list.php" class="btn btn-sm btn-danger">Back</a>
            </div>

            <!-- Default Tabs -->
            <form class="needs-validation" novalidate action="user-code.php" method="POST">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">User Information</button>
                </li>
              </ul>

              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="card">
                    <div class="card-body row g-3">

                    <?php
                    $paramValue = checkParamId('id');
                    if (!is_numeric($paramValue)) {
                      echo '<h5>Not Available</h5>';
                      return false;
                    }
                    $user = getById('users', $paramValue);
                    // echo '<pre style="color: red; font-weight: bold;">';
                    // print_r($user);
                    // echo '</pre></div>';
    
                    if ($user['status'] == 200) {
                      $data = $user['data']
                      // 
                    ?>

                    <input type="hidden" value="<?= $user['data']['id']; ?>" name="id">

                    <div class="col-md-6 mt-4">
                    <label class="form-label text-center">Full Name</label>
                      <div class="form-floating">
                        <input type="text" class="form-control" id="floatingFname" placeholder="" required value="<?= $user['data']['full_name']; ?>" name="fullname">
                        <label for="floatingFname">(e.g., Juan Pedro Delacruz)</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                    </div>

                      <div class="col-md-6 mt-4">
                        <label for="yourUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="email">@</span>
                          <input type="email" name="email" value="<?= $user['data']['email']; ?>" class="form-control p-3" id="yourUsername" required autocomplete="off">
                          <div class="invalid-feedback">Please enter your email.</div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="yourPassword" class="form-label">Password</label>
                        <div class="input-group has-validation">
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

                      <div class="row mt-4">
                        <p class="col-sm-3 col-form-label" id="restrictions"><strong>Restriction Options:</strong></p>
                        <div class="col-sm-4 mt-2">
                       <?php if ($user['data']['role'] == 1) { ?>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="createSwitch" name="create" <?= $user['data']['can_create'] == 1? 'checked': ''; ?>>
                            <label class="form-check-label" for="createSwitch">Can Create?</label>
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="editSwitch" name="edit" <?= $user['data']['can_edit'] == 1? 'checked': ''; ?>>
                            <label class="form-check-label" for="editSwitch">Can Edit?</label>
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="deleteSwitch" name="delete" <?= $user['data']['can_archive'] == 1? 'checked': ''; ?>>
                            <label class="form-check-label" for="deleteSwitch">Can archive?</label>
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="exportSwitch" name="export" <?= $user['data']['can_export'] == 1? 'checked': ''; ?>>
                            <label class="form-check-label" for="exportSwitch">Can Export?</label>
                          </div>
                        <?php } ?>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="bannedSwitch" <?= $user['data']['is_banned'] == 1? 'checked': ''; ?> name="bannedSwitch">
                            <label class="form-check-label" for="bannedSwitch">Banned?</label>
                          </div>
                        </div>
                       <?php if ($user['data']['role'] == 1) { ?>
                        <p class="col-sm-2 col-form-label"><strong>Authorization:</strong></p>
                        <div class="col-sm-3">
                          <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" id="promoteSwitch" <?= $user['data']['role'] == 1? 'checked': ''; ?> name="promoteSwitch">
                            <label class="form-check-label" for="promoteSwitch">Promote to admin?</label>
                          </div>
                        </div>
                        <?php } ?>
                      </div>

                      <?php
                    }
                      ?>

                    </div>

                    <div class="d-flex justify-content-end mb-3 mt-3">
                      <button type="reset" class="btn btn-sm btn-secondary me-2">Reset</button>
                      <button type="submit" name="update" class="btn btn-sm btn-success me-2"><i class="fa-solid fa-floppy-disk"></i> Save</button>
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
