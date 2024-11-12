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
                        onclick="window.history.back()">Back</a>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card" data-aos="zoom-out" class="my-4">
                            <div class="card-body text-center">
                                <div class="d-sm-flex justify-content-end align-items-center mt-2">
                                    <a class="btn btn-info">Print</a>
                                    <a class="btn btn-success ms-2">Edit</a>
                                </div>
                                <hr>
                                <img class="rounded-circle" style="background-color: seagreen; padding: 10px;" src="../assets/img/farmer.png" height="150" alt="Farmer">
                                <div class="mt-3">
                                    <span class="d-block mb-2">NAME:</span>
                                    <h1 class="font-weight-bold">Farmer Name</h1>
                                    <span>00-00-00-00000</span>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card my-4" data-aos="fade-up" data-aos-duration="450" data-aos-delay="200">
                            <div class="card-body">
                                <hr>
                                <h4 class="text-center text-success font-weight-bold mt-2">I. Personal Information</h4>
                                <hr>
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
                                <hr>
                                <fieldset class="mt-3">
                                    <h6 class="text-success font-weight-bold">Farmer Address*</h6>
                                    <label class="form-label">Province<input type="text" class="form-control"></label>
                                    <label class="form-label">Municipality<input type="text" class="form-control"></label>
                                    <label class="form-label">Barangay<input type="text" class="form-control"></label>
                                </fieldset>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card my-4" data-aos="fade-up" data-aos-duration="450" data-aos-delay="200">
                            <div class="card-body">
                                <hr>
                                <h4 class="text-center text-success font-weight-bold mt-2">Parcel No.<span class="ml-2">0</span></h4>
                                <hr>
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
                                    <hr>
                                    <div class="row mt-1">
                                        <fieldset>
                                            <h6 class="text-success font-weight-bold">Farm information*</h6>
                                            <label class="form-label">Farm size<input type="text" class="form-control"></label>
                                            <label class="form-label">Farm type<input type="text" class="form-control" placeholder="IRREGATED"></label>
                                        </fieldset>
                                    </div>
                                    <hr>
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
                                            <label class="form-label">No. of heads<input type="number" class="form-control"></label>
                                        </fieldset>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card table-responsive mb-3">
                <h5 class="card-header ms-2">Resources</h5>
                <div class="card-body">
                <table class="table table-bordered table-striped">
                        <thead class="thead">
                            <tr>
                            
                                <th>Date</th>
                                <th>Program</th>
                                <th>Resources</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="tbod">
                            <tr>
                                <td>MM-DD-YYYY</td>
                                <td>Cash Assistance</td>
                                <td>Cash</td>
                                <td>
                                    <div class="input-group qtyBox">
                                        <input disabled type="text" value="200" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                        <p class="ms-1 mb-0">Php</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>MM-DD-YYYY</td>
                                <td>Cash Assistance</td>
                                <td>Cash</td>
                                <td>
                                    <div class="input-group qtyBox">
                                        <input disabled type="text" value="200" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                        <p class="ms-1 mb-0">Php</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>    
                </div>
                </div>

            </div>
        </section>


        <!-- ======= Footer ======= -->
        <?php include '../includes/footer.php' ?>

</body>

</html>