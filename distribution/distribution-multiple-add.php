<!DOCTYPE html>
<html lang="en">

<?php
session_start();
include '../includes/head.php' ?>

<body class="login-bg">

    <!-- ======= Header ======= -->
    <?php include '../includes/header.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../includes/sidebar.php' ?>

    <?php include 'filter.php'; ?>


    <!-- ======= Main ======= -->
    <main class="main" id="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 main-table">

                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Distribution</h5>
                            <div>
                                <a onclick="window.history.back()" class="btn btn-primary">Back</a>
                            </div>
                        </div>

                        <!-- Default Tabs -->
                        
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Single</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Multiple</button>
                                </li>
                            </ul>

                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                    <div class="card mt-4 shadow-sm">

                                        <div class="card-header d-flex justify-content-between">
                                            <h5>Single distribution</h5>
                                        </div>

                                        <div class="card-body">
                                            
                                            <?php
                                            if (isset($_SESSION['resourceItems'])) {
                                                echo '<pre>';
                                                print_r($_SESSION['resourceItems']);
                                                echo '</pre>';
                                                echo '<pre>';
                                                print_r($_SESSION['status']);
                                                echo '</pre>';
                                            }
                                            // session_unset();
                                            ?>

                                            <form action="distribution-code.php" method="POST">
                                                <div class="row">
                                                    <style>
                                                        .select2-container .select2-selection--single {
                                                            padding-bottom: 40px;
                                                        }

                                                        .select2-container--default .select2-selection--single .select2-selection__rendered {
                                                            line-height: 40px;
                                                        }
                                                    </style>

                                                    <div class="col-md-4 mb-3">
                                                        <label for="farmers">Farmers</label>
                                                        <select id="farmers" class="mySelect" name="farmer_id">
                                                            <option selected disabled>-- Select Farmer --</option>
                                                            <?php
                                                            $farmers = getAll('farmers');
                                                            if (mysqli_num_rows($farmers) > 0) {
                                                                foreach ($farmers as $item) {
                                                            ?>
                                                                    <option value="<?= $item['id'] ?>"><?= $item['ffrs_system_gen'] ?> -
                                                                        <?= $item['first_name'] ?>
                                                                        <?= $item['last_name'] ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-4 mb-3">
                                                        <label for="resources">Resources</label>
                                                        <select id="resources" class="mySelect" name="resources_id">
                                                            <option selected disabled>-- Select Resources --</option>
                                                            <?php
                                                            $farmers = getAll('resources');
                                                            if (mysqli_num_rows($farmers) > 0) {
                                                                foreach ($farmers as $item) {
                                                            ?>
                                                                    <option value="<?= $item['id'] ?>"><?= $item['quantity_available'] ?> -
                                                                        <?= $item['unit_of_measure'] ?>
                                                                        <?= $item['resource_type'] ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-1 mb-3">
                                                        <label>Quantity</label>
                                                        <input type="number" name="quantity" min="1" value="1" required class="form-control">
                                                    </div>

                                                    <div class="col-md-3 mb-3 text-end" style="padding-top: 20px;">
                                                        <button type="submit" name="addItem" class="btn btn-warning">Distribute</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="card mt-3">

                                        <div class="card-header">
                                            <h5 class="mb-0"></h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive mb-3">
                                                <table class="table table-bordered table-striped">
                                                    <thead class="thead">
                                                        <tr>
                                                            <th>FFRS System Gen.</th>
                                                            <th>Farmer Name</th>
                                                            <th>Program</th>
                                                            <th>Resources</th>
                                                            <th>Quantity</th>
                                                            <th>Remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tbod">
                                                        <tr>
                                                            <td><strong>03-14-03-003-ABCDE</strong></td>
                                                            <td>Pedro Delacruz</td>
                                                            <td>Cash Assistance</td>
                                                            <td>Cash</td>
                                                            <td>
                                                                <div class="input-group qtyBox">
                                                                    <input disabled type="text" value="200" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                                                    <p class="ms-1 mb-0">Php</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>03-14-03-003-ABCDE</strong></td>
                                                            <td>Juan Luna</td>
                                                            <td>Pamigay binhi</td>
                                                            <td>SEEDLING-0001</td>
                                                            <td>
                                                                <div class="input-group qtyBox">
                                                                    <input disabled type="text" value="1" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                                                    <p class="ms-1 mb-0">Bags</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3"></td>
                                                            <td><b>Total</b></td>
                                                            <td><b>201</b></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <hr>
                                            <div class="mt-2">
                                                <div class="row d-flex justify-content-end">

                                                    <div class="col-md-1">
                                                        <button type="submit" class="btn btn-success" name="saveOrder">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="card mt-4 shadow-sm">


                                        <div class="card-header d-flex justify-content-between">
                                            <h5>Multiple distribution</h5>
                                        </div>

                                        <div class="card-body">
                                            <form action="purchase-orders-code.php" method="POST">
                                                <div class="row">

                                                    <div class="col-md-3 mb-3">
                                                        <label>Program</label>
                                                        <select name="" class="form-select mySelect2">
                                                            <option value="">-- Select Programs --</option>
                                                            <option value="1">P001 - Program Name 1</option>
                                                            <option value="2">P002 - Program Name 2</option>
                                                            <option value="3">P003 - Program Name 3</option>
                                                            <option value="4">P004 - Program Name 4</option>
                                                            <option value="5">P005 - Program Name 5</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-3 mb-3">
                                                        <label>Resources</label>
                                                        <select name="" class="form-select mySelect2">
                                                            <option value="">-- Select Resources --</option>
                                                            <option value="1">P001 - Resource Name 1</option>
                                                            <option value="2">P002 - Resource Name 2</option>
                                                            <option value="3">P003 - Resource Name 3</option>
                                                            <option value="4">P004 - Resource Name 4</option>
                                                            <option value="5">P005 - Resource Name 5</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-1 mb-3">
                                                        <label>Criteria</label>
                                                        <div>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                                                                Select
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label>Quantity</label>
                                                        <input type="number" name="quantity" min="1" value="1" required class="form-control">
                                                    </div>

                                                    <div class="col-md-3 mb-3 text-end" style="padding-top: 20px;">
                                                        <button type="submit" name="addOrder" class="btn btn-warning">Distribute</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="card mt-3">
                                            <div class="card-header">
                                                <h5 class="mb-0"></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive mb-3">
                                                    <table class="table table-bordered table-striped">
                                                        <thead class="thead">
                                                            <tr>
                                                                <th>FFRS System Gen.</th>
                                                                <th>Farmer Name</th>
                                                                <th>Program</th>
                                                                <th>Resources</th>
                                                                <th>Quantity</th>
                                                                <th>Remove</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tbod">
                                                            <tr>
                                                                <td><strong>03-14-03-003-ABCDE</strong></td>
                                                                <td>Pedro Delacruz</td>
                                                                <td>Cash Assistance</td>
                                                                <td>Cash</td>
                                                                <td>
                                                                    <div class="input-group qtyBox">
                                                                        <input disabled type="text" value="200" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                                                        <p class="ms-1 mb-0">Php</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><strong>03-14-03-003-ABCDE</strong></td>
                                                                <td>Juan Luna</td>
                                                                <td>Pamigay binhi</td>
                                                                <td>SEEDLING-0001</td>
                                                                <td>
                                                                    <div class="input-group qtyBox">
                                                                        <input disabled type="text" value="1" class="qty quantityInput" style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;">
                                                                        <p class="ms-1 mb-0">Bags</p>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3"></td>
                                                                <td><b>Total</b></td>
                                                                <td><b>201</b></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <hr>
                                                <div class="mt-2">
                                                    <div class="row d-flex justify-content-end">

                                                        <div class="col-md-1">
                                                            <button type="submit" class="btn btn-success" name="saveOrder">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
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
    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('.mySelect').select2({
                width: '100%' // Ensures Select2 takes up full width
            });
           
        });

        
    </script>


</body>

</html>