<!DOCTYPE html>
<html lang="en">
<?php 
include '../includes/head.php';
  if (!isset($_SESSION['LoggedInUser']['email'])) {
    redirect('../logout.php', 404, 'Please login first.');
}
?>

<style>
     .needs-validation .invalid-feedback {
            display: none; /* Hide feedback by default */
        }
        .needs-validation .form-control:invalid ~ .invalid-feedback {
            display: none; /* Show feedback for invalid inputs */
        }
</style>

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
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-15 d-flex flex-column align-items-center justify-content-center">
                <style>
                    @media (min-width: 400px){.card { width: 368px;height: 359.125px;}}
                </style>    
                <div class="card text-center">

                    <input type="hidden" id="email" name="email" value="<?= $_SESSION['LoggedInUser']['email'];?>">

                    <input type="hidden" value="<?= isset($_SESSION['otpTime']) ? date("Y-m-d H:i:s", $_SESSION['otpTime']) : ''; ?>">
                    <input type="hidden" value="<?= isset($_SESSION['otp']) ? $_SESSION['otp'] : ''; ?>">
                    <input type="hidden" value="<?= isset($_SESSION['otp_attempts']) ? $_SESSION['otp_attempts'] : ''; ?>">

                    <?php include '../backend/status-messages.php';?>
                    
                        <div class="card-body p-4 auth-card" data-aos="zoom-in" data-aos-duration="500">
                            <h5 class="card-title">Account Verification</h5>
                            <p class="card-text">Enter the 6-digit verification code that was sent to your email account. 3 attempts for 1 minute</p>
                            <form id="otp-form" method="POST" class="" action="verify.php">
                                <div class="d-flex justify-content-center mb-4">
                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                        <input name="<?= $i ?>" type="text" class="form-control mx-1 text-center" style="height: 3rem; font-size: 1.5rem;" maxlength="1" pattern="\d*" required>
                                    <?php endfor; ?>
                                </div>
                                <button type="submit" name="verify" class="btn btn-success w-100">Verify</button>
                            </form>
                            <pre class="d-none">
                                <?php print_r($_SESSION['LoggedInUser'])?>
                            </pre>
                            <!-- <div class="mt-3">
                                <small>Didn't receive the code? <a href="#0" class="text-primary" id="resend">Resend</a></small>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>
     let seconds = 0; // Initialize counter to track seconds

// Set an interval to log each second
let interval = setInterval(() => {
    console.log(`Time: ${seconds} second(s)`); // Log the elapsed time
    seconds++; // Increment the counter

    if (seconds >= 60) {
        clearInterval(interval); // Stop the interval
        console.log("Time Out!"); // Log the timeout message
    }
}, 1000); // 1000 ms = 1 second
</script>
    <script src="script.js"></script>
    <?php include '../includes/footer.php'; ?>
</body>

</html>