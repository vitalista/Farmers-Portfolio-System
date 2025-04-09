<!DOCTYPE html>
<html lang="en">

<?php
include '../includes/head.php';

if (!isset($_SESSION['resourceItems'])) {
    $_SESSION['resourceItems'] = [];
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
                    <?php include '../backend/status-messages.php'; ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Distribution</h5>
                            <div>
                                <a href="distributions-list.php" class="btn btn-sm btn-danger">Back</a>
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

                                        // if (isset($_SESSION['resourceItems'])) {
                                        //     echo '<pre>';
                                        //     print_r($_SESSION['resourceItems']);
                                        //     echo '</pre>';
                                        // }
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
                                                                <option value="<?= $item['id'] ?>"><span class="fw-bold"><?= number_format($item['quantity_available'], 2) ?></span> -
                                                                <?= $item['resources_name'] ?>
                                                                <?= $item['resource_type'] ?> 
                                                                    <?= $item['unit_of_measure'] ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-1 mb-3">
                                                    <label>Quantity</label>
                                                    <input type="number" step="0.01" name="quantity" value="1" required class="form-control">
                                                </div>

                                                <div class="col-md-3 mb-3 text-end mt-4">
                                                    <button type="submit" name="addItem" class="btn btn-sm btn-warning">Distribute</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                                <div class="card mt-4 shadow-sm">

                                    <div class="card-header d-flex justify-content-between">
                                        <h5>Multiple distributions</h5>
                                    </div>

                                    <div class="card-body">

                                        <?php
                                        // if (isset($_SESSION['resourceItems'])) {
                                        //     echo '<pre>';
                                        //     print_r($_SESSION['resourceItems']);
                                        //     echo '</pre>';
                                        // }
                                        // session_unset();
                                        ?>

                                        <form action="distribution-code.php" method="POST">
                                            <div class="row">
                                                <!-- Resources Dropdown -->
                                                <div class="col-md-4 mb-3">
                                                    <label for="resources1">Resources</label>
                                                    <select id="resources1" class="mySelect" name="resources_id">
                                                        <option selected disabled>-- Select Resources --</option>
                                                        <?php
                                                        $farmers = getAll('resources');
                                                        if (mysqli_num_rows($farmers) > 0) {
                                                            foreach ($farmers as $item) {
                                                        ?>
                                                                 <option value="<?= $item['id'] ?>"><span class="fw-bold"><?= number_format($item['quantity_available'], 2) ?></span> -
                                                                <?= $item['resources_name'] ?>
                                                                <?= $item['resource_type'] ?> 
                                                                    <?= $item['unit_of_measure'] ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Criteria Button (Modal Trigger) -->
                                                <div class="col-md-1 mb-3">
                                                    <label>Criteria</label>
                                                    <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Select</button>
                                                </div>

                                                <!-- Quantity Input -->
                                                <div class="col-md-1 mb-3">
                                                    <label>Quantity</label>
                                                    <input type="number" step="0.01" name="quantity" value="1" required class="form-control">
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-md-6 mb-3 text-end mt-4">
                                                    <button type="submit" name="addItems" class="btn btn-sm btn-warning">Distribute</button>
                                                </div>
                                            </div>

                                            <!-- Criteria Modal -->
                                             <?php include 'criteria-modal.php'; ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-3">

                            <div class="card-header">
                                <h5 class="mb-0"></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mb-3">
                                    <span class="fs-6">Total Beneficiaries <strong><?= count($_SESSION['resourceItems']);?></strong></span>
                                    <table class="table table-bordered table-striped" id="example">
                                        <?php //$_SESSION['status']; 
                                        ?>
                                        <thead class="thead">
                                            <tr>
                                                <th class="text-start">FFRS</th>
                                                <th class="text-start">Farmer Name</th>
                                                <th class="text-start">Program</th>
                                                <th class="text-start">Resources</th>
                                                <th class="text-start">Quantity</th>
                                                <th class="text-start">Remove</th>
                                            </tr>
                                        </thead>

                                        <tbody class="tbod">
                                            <?php
                                            if (isset($_SESSION['resourceItems']) && $_SESSION['resourceItems'] != null) {
                                                $sessionProducts = $_SESSION['resourceItems'];
                                                if (empty($sessionProducts)) {
                                                    unset($sessionProducts['resourceItems']);
                                                }
                                                foreach ($sessionProducts as $key => $item) :
                                            ?>
                                                    <tr>
                                                        <td class="text-start"><strong><?= $item['ffrs_code']; ?></strong></td>
                                                        <td class="text-start"><?= $item['farmer_name']; ?></td>
                                                        <td class="text-start"><?= $item['program']; ?></td>
                                                        <td class="text-start"><?= $item['resource_name']; ?> - <?= $item['resource_type']; ?></td>
                                                        <td class="text-start">
                                                            <div class="input-group qtyBox">
                                                                <p style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;"><?= $item['quantity']; ?></p>

                                                                <p class="ms-1 mb-0"><?= $item['unit_of_measure']; ?></p>
                                                            </div>
                                                        </td>
                                                        <td class="text-start">
                                                            <a href="distribution-code.php?index=<?= $item['farmer_id']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                                        </td>
                                                    </tr>

                                            <?php
                                                endforeach;
                                            }
                                            ?>

                                        </tbody>


                                    </table>
                                </div>

                                <hr>

                            </div>
                        </div>

                        <div class="row d-flex justify-content-end">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="distribution-code.php?clear=true" class="btn btn-sm btn-secondary me-2">Clear</a>

                                <form action="distribution-code.php" method="post">
                                    <button type="submit" class="btn btn-sm btn-success" name="saveItem"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>
    <script> let totalEntries = <?= count($_SESSION['resourceItems']); ?>;</script>
    <script src="./script.js"></script>

</body>

</html>