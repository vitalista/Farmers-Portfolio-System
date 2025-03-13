<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body style="overflow: hidden;">

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../" class="logo d-flex align-items-center">
        <img src="../assets/img/agri-logo.png" alt="">
        <span class="d-none d-lg-block">BaliwagAgriOffice</span>
      </a>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <main class="login-bg">
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <style>
                    @media (min-width: 400px){.card { width: 368px;height: 359.125px;}}
                </style> 
              <div class="card mb-3" style="background-color: transparent;">

                <?php include '../backend/status-messages.php';?>

                <div class="card-body auth-card" data-aos="zoom-in" data-aos-duration="500">

                  <div class="pt-2">
                    <h5 class="card-title text-center pb-0 fs-4">Register</h5>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="registration-code.php" novalidate>

                    <div class="col-10 mx-auto">
                      <label for="yourUsername" class="form-label text-center">Email</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="email">@</span>
                        <input type="email" name="email" class="form-control" id="yourUsername" placeholder="Enter your email" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-10 mx-auto">
                      <label for="yourPassword" class="form-label text-center">Password</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text"><i class="bi bi-eye-slash" id="iconPassword"></i></span>
                        <input type="password" name="password" class="form-control inputPassword" id="yourPassword" placeholder="Enter your password" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    <div class="col-10 mx-auto">
                      <label for="yourPassword1" class="form-label text-center">Re-Type Password</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text"><i class="bi bi-eye-slash" id="iconPassword1"></i></span>
                        <input type="password" name="retype" class="form-control inputPassword" id="yourPassword1" placeholder="Re-type your password" required>
                        <div class="invalid-feedback">Please re-type your password!</div>
                      </div>
                    </div>

                    <div class="col-10 mx-auto">
                      <button class="btn btn-success w-100" name="add" type="submit">Register</button>
                    </div>

                    <div class="col-10 mx-auto">
                      <a href="../login/">Already have account? Login.</a>
                    </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <?php include '../includes/footer.php' ?>

</body>

</html>