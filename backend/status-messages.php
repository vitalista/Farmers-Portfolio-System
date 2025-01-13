<?php if (isset($_SESSION['status']) && $_SESSION['status'] == 200) { ?>
    <div
        data-aos="fade-up" data-aos-delay="100"
        class="alert alert-success alert-dismissible fade show mt-3 d-flex justify-content-center align-items-center" role="alert">
        <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['status']);
    unset($_SESSION['message']);
} ?>

<?php if (isset($_SESSION['status']) && $_SESSION['status'] == 404) { ?>
    <div
        data-aos="fade-up" data-aos-delay="100"
        class="alert alert-danger alert-dismissible fade show mt-3 d-flex justify-content-center align-items-center" role="alert">
        <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['status']);
    unset($_SESSION['message']);
} ?>

<?php if (isset($_SESSION['status']) && $_SESSION['status'] == 500) { ?>
    <div
        data-aos="fade-up" data-aos-delay="100"
        class="alert alert-warning alert-dismissible fade show mt-3 d-flex justify-content-center align-items-center" role="alert">
        <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['status']);
    unset($_SESSION['message']);
} ?>

<script>
    setTimeout(function() {
        var alertBoxes = document.querySelectorAll('.alert-dismissible');
        alertBoxes.forEach(function(alertBox) {
            alertBox.remove();
        });
    }, 5000);
</script>