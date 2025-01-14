<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">

    <!-- ======= Header ======= -->
    <?php include '../includes/header.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../includes/sidebar.php' ?>
    <style>
        .select2-container .select2-selection--single {
            padding-bottom: 40px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 40px;
        }
    </style>


    <!-- ======= Main ======= -->
    <main class="main" id="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 main-table">

                    <div class="card-body">
                        <?php include '../backend/status-messages.php'; ?>
                        <div class="d-sm-flex justify-content-between">
                            <h5 class="card-title">View Distribution</h5>
                            <div class="d-sm-flex justify-content-end align-items-center mt-2">
                                <a onclick="window.history.back()" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Distribution Information</button>
                            </li>
                        </ul>
                        <form class="needs-validation" method="POST" action="distribution-view-code.php" id="" novalidate>
                            <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">


                                    <?php
                                    $paramValue = checkParamId('id');
                                    if (!is_numeric($paramValue)) {
                                        echo '<h5>Not Available</h5>';
                                        return false;
                                    }
                                    $checkId = getById('distributions', $paramValue);
                                    // echo '<pre style="color: red; font-weight: bold;">';
                                    // print_r($checkId);
                                    // echo '</pre></div>';

                                    if ($checkId['status'] == 200) {
                                        $data = $checkId['data'];
                                        $farmerGet = getById('farmers', $data['farmer_id']);
                                        $programGet = getById('programs', $data['program_id']);
                                        $resourcesGet = getById('resources', $data['resource_id']); // Correct variable name for resources

                                        $farmer = $program = $resources = null; // Initialize variables

                                        if ($farmerGet['status'] == 200 && $programGet['status'] == 200 && $resourcesGet['status'] == 200) {
                                            $farmer = $farmerGet['data'];
                                            $program = $programGet['data'];
                                            $resources = $resourcesGet['data'];
                                        }
                                    ?>


                                        <div class="card">

                                            <div class="card-body row g-3">

                                                <input type="hidden" name="id" value="<?= $data['id']; ?>">

                                                <div class="col-md-4 mb-3">
                                                    <label for="farmers">Farmer</label>
                                                    <select id="farmers" class="mySelect" name="farmer_id" required>
                                                        <option selected disabled>-- Select Farmer --</option>
                                                        <?php
                                                        $farmers = getAll('farmers');
                                                        if (mysqli_num_rows($farmers) > 0) {
                                                            foreach ($farmers as $item) {
                                                        ?>
                                                                <option <?php
                                                                        if ($farmer['id'] == $item['id']) {
                                                                            echo 'selected';
                                                                        }
                                                                        ?> value="<?= $item['id'] ?>"><?= $item['ffrs_system_gen'] ?> -
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
                                                    <select id="resources" class="mySelect" name="resources_id" required>
                                                        <option selected disabled>-- Select Resources --</option>
                                                        <?php
                                                        $farmers = getAll('resources');
                                                        if (mysqli_num_rows($farmers) > 0) {
                                                            foreach ($farmers as $item) {
                                                        ?>
                                                                <option
                                                                    <?php
                                                                    if ($resources['id'] == $item['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>
                                                                    value="<?= $item['id'] ?>"><?= $item['quantity_available'] ?> -
                                                                    <?= $item['unit_of_measure'] ?>
                                                                    <?= $item['resource_type'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="programs">Programs</label>
                                                    <select id="programs" class="mySelect" name="program_id" required>
                                                        <option selected disabled>-- Select Programs --</option>
                                                        <?php
                                                        $farmers = getAll('programs');
                                                        if (mysqli_num_rows($farmers) > 0) {
                                                            foreach ($farmers as $item) {
                                                        ?>
                                                                <option
                                                                    <?php
                                                                    if ($program['id'] == $item['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>
                                                                    value="<?= $item['id'] ?>"><?= $item['program_name'] ?> -
                                                                    <?= $item['program_type'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="validationCustom01" class="form-label">Quantity distributed</label>
                                                    <div class=" input-group">
                                                        <input style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;" name="quantity_distributed" value="<?= $data['quantity_distributed']; ?>" required>
                                                        <p class="ms-1 mb-0"><?= $resources['unit_of_measure']; ?></p>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <label for="validationCustom05" class="form-label">Distribution date</label>
                                                    <input type="date" name="distribution_date" value="<?= $data['distribution_date'] == '0000-00-00' ? '' : $data['distribution_date']; ?>" class="form-control" id="validationCustom05" required>
                                                    <div class="invalid-feedback">Please enter.</div>
                                                </div>

                                                <div class="col-md-4 mt-5 form-floating mb-3">
                                                    <textarea required class="form-control" name="remarks" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px;"><?= $data['remarks']; ?></textarea>
                                                    <label for="floatingTextarea">Remarks</label>
                                                    <div class="invalid-feedback">Please enter.</div>
                                                </div>

                                            </div>

                                        </div>

                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="d-flex justify-content-end mb-3 mt-3">
                                <button type="reset" class="btn btn-secondary me-2">Reset</button>
                                <button type="submit" class="btn btn-success me-2">Save</button>
                            </div>


                        </form>

                    </div>

                </div>

            </div>
            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>
    <script>
        $(document).ready(function() {
            $('.mySelect').select2({
                width: '100%'
            });

        });
    </script>

</body>

</html>