<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

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
                        <div class="card-body p-4 auth-card" data-aos="zoom-in" data-aos-duration="500">
                            <h5 class="card-title">Account Verification</h5>
                            <p class="card-text">Enter the 6-digit verification code that was sent to your email account. 3 attempts for 1 minute</p>
                            <form id="otp-form" method="POST" class="" action="../backend/route.php">
                                <div class="d-flex justify-content-center mb-4">
                                    <?php for ($i = 1; $i <= 6; $i++): ?>
                                        <input name="<?= $i ?>" type="text" class="form-control mx-1 text-center" style="height: 3rem; font-size: 1.5rem;" maxlength="1" pattern="\d*" required>
                                    <?php endfor; ?>
                                </div>
                                <button type="submit" name="verify" class="btn btn-success w-100">Verify</button>
                            </form>
                            <div class="mt-3">
                                <small>Didn't receive the code? <a href="#0" class="text-primary">Resend</a></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('otp-form');
            const inputs = [...form.querySelectorAll('input[type=text]')];
            const submit = form.querySelector('button[type=submit]');

            const handleKeyDown = (e) => {
                if (!/^[0-9]{1}$/.test(e.key) && e.key !== 'Backspace' && e.key !== 'Delete' && e.key !== 'Tab') {
                    e.preventDefault();
                }

                if (e.key === 'Delete' || e.key === 'Backspace') {
                    const index = inputs.indexOf(e.target);
                    if (index > 0) {
                        inputs[index - 1].value = '';
                        inputs[index - 1].focus();
                    }
                }
            }

            const handleInput = (e) => {
                const index = inputs.indexOf(e.target);
                if (e.target.value) {
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    } else {
                        submit.focus();
                    }
                }
            }

            const handleFocus = (e) => {
                e.target.select();
            }

            const handlePaste = (e) => {
                e.preventDefault();
                const text = e.clipboardData.getData('text');
                if (!new RegExp(`^[0-9]{${inputs.length}}$`).test(text)) {
                    return;
                }
                const digits = text.split('');
                inputs.forEach((input, index) => input.value = digits[index]);
                submit.focus();
            }

            inputs.forEach((input) => {
                input.addEventListener('input', handleInput);
                input.addEventListener('keydown', handleKeyDown);
                input.addEventListener('focus', handleFocus);
                input.addEventListener('paste', handlePaste);
            });
        });
    </script>


    <?php include '../includes/footer.php' ?>

</body>

</html>