<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">

   <!-- ======= Header ======= -->
   <?php include '../includes/header.php' ?>

   <!-- ======= Sidebar ======= -->
   <?php include '../includes/sidebar.php' ?>

   <main id="main" class="main">

<section class="main-table">
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="card-header">Farmer Profile</h3>
            <a class="btn btn-primary" 
            href="#"
            onclick="window.history.back()"
            >Back</a>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card" data-aos="zoom-out" class="my-4">
                    <div class="card-body text-center">
                    <div class="d-sm-flex justify-content-end align-items-center mt-1">
                        <a class="btn btn-info">Print</a>
                        <a class="btn btn-success ms-2">Edit</a>
                    </div>
                        <img class="rounded-circle" style="background-color: seagreen; padding: 10px;" src="../assets/img/farmer.png" height="150" alt="Farmer">
                        <div class="mt-3">
                            <span class="d-block mb-2">NAME:</span>
                            <h1 class="font-weight-bold">Farmer Name</h1>
                            <span>00-00-00-00000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card my-4" data-aos="fade-up" data-aos-duration="450" data-aos-delay="200">
                    <div class="card-body">
                        <h4 class="text-center text-success font-weight-bold">I. Personal Information</h4>
                        <div class="row">
                            <div class="col">
                                <fieldset>
                                    <label class="form-label">Lastname<input type="text" class="form-control"></label>
                                    <label class="form-label">First name<input type="text" class="form-control"></label>
                                    <label class="form-label">Middle name<input type="text" class="form-control"></label>
                                </fieldset>
                            </div>
                            <div class="col">
                                <fieldset>
                                    <label class="form-label">Birthday<input type="text" class="form-control"></label>
                                    <label class="form-label">Gender<input type="text" class="form-control"></label>
                                    <label class="form-label">Extension name<input type="text" class="form-control"></label>
                                </fieldset>
                            </div>
                        </div>
                        <fieldset class="mt-3">
                            <h6 class="text-success font-weight-bold">Farmer Address*</h6>
                            <label class="form-label">Province<input type="text" class="form-control"></label>
                            <label class="form-label">Municipality<input type="text" class="form-control"></label>
                            <label class="form-label">Barangay<input type="text" class="form-control"></label>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card my-4" data-aos="fade-up" data-aos-duration="450" data-aos-delay="200">
                    <div class="card-body">
                        <h4 class="text-center text-success font-weight-bold">Parcel No.<span class="ml-2">0</span></h4>
                        <div class="row">

                            <div class="col-md-6 mt-2">
                                <fieldset>
                                    <h6 class="text-success font-weight-bold">Farm Owner*</h6>
                                    <label class="form-label">Owner Lastname<input type="text" class="form-control"></label>
                                    <label class="form-label">Owner First name<input type="text" class="form-control"></label>
                                    <label class="form-label">Ownership type<input type="text" class="form-control"></label>
                                </fieldset>
                            </div>

                            <div class="col-md-6 mt-2">
                                <fieldset>
                                    <h6 class="text-success font-weight-bold">Farm Address*</h6>
                                    <label class="form-label">Province<input type="text" class="form-control"></label>
                                    <label class="form-label">Municipality<input type="text" class="form-control"></label>
                                    <label class="form-label">Barangay<input type="text" class="form-control"></label>
                                </fieldset>
                            </div>

                            <div class="row mt-1">
                            <fieldset>
                                <h6 class="text-success font-weight-bold">Farm information*</h6>
                                <label class="form-label">Farm size<input type="text" class="form-control"></label>
                                <label class="form-label">Farm type<input type="text" class="form-control" placeholder="IRREGATED"></label>
                                </fieldset>
                            </div>

                            <div class="col mt-1">
                            <fieldset>
                                <h5 class="mt-2 text-success font-weight-bold">Crop list</h5>
                                <label class="form-label">High Value Crop<input type="text" placeholder="YES" class="form-control"></label>
                                <label class="form-label">Crop Area<input type="text" class="form-control" placeholder="in hectares"></label>
                                <label class="form-label">Classification<input type="text" class="form-control"></label>
                                </fieldset>
                            </div>

                            
                            <div class="col mt-1">
                            <fieldset>
                                <h5 class="mt-2 text-success font-weight-bold">Livestock list</h5>
                                <label class="form-label">Animal type<input type="text" class="form-control"></label>
                                <label class="form-label">No. og heads<input type="number" class="form-control"></label>
                                </fieldset>
                            </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


      <!-- ======= Footer ======= -->
      <?php include '../includes/footer.php' ?>

</body>

</html>