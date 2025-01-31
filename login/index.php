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

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>

                  <form class="row g-3 needs-validation" method="POST" action="login-code.php" novalidate>

                    <div class="col-10 mx-auto">
                      <label for="yourUsername" class="form-label text-center">Email</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="email">@</span>
                        <input type="text" name="email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your email.</div>
                      </div>
                    </div>

                    <div class="col-10 mx-auto mb-3">
                      <label for="yourPassword" class="form-label text-center">Password</label>
                      <div class="input-group has-validation d-flex justify-content-center">
                        <span class="input-group-text" id="password"><i class="bi bi-eye-slash" id="iconPassword"></i></span>
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    <div class="col-12 mb-2 d-flex justify-content-center">
                      <button class="btn btn-success w-75" name="login" type="submit">Login</button>
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