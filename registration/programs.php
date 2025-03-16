<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>

<body class="login-bg">
<?php include 'registration-header.php'; ?>
<?php include 'registration-sidebar.php'; ?>

    <main id="main" class="main">
    <div class="container">
        <div class="bg-white shadow p-3 rounded mb-5">
            <ul id="myTab1" class="nav nav-tabs text-center flex-column flex-sm-row nav-pills with-arrow"
                role="tablist">
                <li class="nav-item flex-sm-fill" role="presentation">
                    <a id="home1-tab" class="nav-link active text-uppercase font-weight-bold mr-sm-3 rounded-0 border"
                        role="tab" data-bs-toggle="tab" aria-controls="home1" aria-selected="true" href="#home1">
                        Eligibility
                    </a>
                </li>
                <li class="nav-item flex-sm-fill" role="presentation">
                    <a id="profile1-tab" class="nav-link text-uppercase font-weight-bold mr-sm-3 rounded-0 border"
                        role="tab" data-bs-toggle="tab" aria-controls="profile1" aria-selected="false" href="#profile1">
                        Upcoming Programs
                    </a>
                </li>
                <li class="nav-item flex-sm-fill" role="presentation">
                    <a id="contact1-tab" class="nav-link text-uppercase font-weight-bold rounded-0 border" role="tab"
                        data-bs-toggle="tab" aria-controls="contact1" aria-selected="false" href="#contact1">
                        History
                    </a>
                </li>
            </ul>

            <div id="myTab1Content" class="tab-content">
                <!-- Eligibility Tab Content -->
                <div id="home1" class="tab-pane active fade px-4 py-5 show" role="tabpanel" aria-labelledby="home1-tab">
                    <div class="row">
                        <div class="col">
                            <section style="margin-top: -44px;">
                                <div class="container mt-5">
                                    <form>
                                        <div class="row mb-3">

                                            <style>
                                                .select2-container .select2-selection--single {
                                                    padding-bottom: 40px;
                                                }

                                                .select2-container--default .select2-selection--single .select2-selection__rendered {
                                                    line-height: 40px;
                                                }
                                            </style>
                                            <form method="get">
                                                <!-- Select Program Input -->
                                                <div class="col-md-6">
                                                    <label for="programs">Programs</label>
                                                    <select id="programs" class="mySelect" name="program">
                                                        <option selected disabled>-- Select Program --</option>
                                                        <?php
                                                        $programs = getAll('programs');
                                                        if (mysqli_num_rows($programs) > 0) {
                                                            foreach ($programs as $item) {
                                                        ?>
                                                                <option value="<?= $item['id'] ?>"><?= $item['program_name'] ?> -
                                                                    <?= $item['program_type'] ?>
                                                                </option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Select Barangay Input -->
                                                <div class="col-md-6">
                                                    <label for="brgys">Barangays</label>
                                                    <select id="brgys" class="mySelect" name="brgy">
                                                        <option selected disabled>-- Select Barangay --</option>
                                                        <?php
                                                        $barangays = getAll('barangays');
                                                        if (mysqli_num_rows($barangays) > 0) {
                                                            foreach ($barangays as $item) {
                                                        ?>
                                                                <option value="<?= $item['brgy'] ?>"><?= $item['brgy'] ?>
                                                            <?php
                                                            }
                                                        }
                                                            ?>
                                                    </select>
                                                </div>
                                            </form>
                                            <!-- Search Button -->
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>

                    <!-- Results Table -->
                    <div class="row">
                        <div class="col">
                            <h4 class="card-header mb-2"><?= isset($_GET['brgy']) ? "Barangay: " . $_GET['brgy'] : "Barangay Name"; ?></h4>
                            <div class="table-responsive card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>FFRS Code</th>
                                            <th>Farmer's Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (isset($_GET['program']) && isset($_GET['brgy'])) {

                                            $distributions = getAll('distributions', $_GET['program'], $_GET['brgy']);
                                            if (mysqli_num_rows($distributions) > 0) {
                                                foreach ($distributions as $item) {
                                        ?>
                                                    <tr>
                                                        <td><?= $item['ffrs_system_gen']; ?></td>
                                                        <td><?= $item['first_name']; ?> <?= $item['middle_name']; ?> <?= $item['last_name']; ?></td>
                                                    </tr>
                                        <?php
                                                }
                                            }else{
                                                echo "<tr>
                                                        <td colspan='2' style='text-align: center;'>No Information Available</td>
                                                      </tr>";
                                            }
                                        } else {
                                            // Assuming the table has 5 columns, set the colspan to 5
                                            echo "<tr>
                                                    <td colspan='2' style='text-align: center;'>No Information Available</td>
                                                  </tr>";
                                        }                                        
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Programs Tab Content -->
                <div id="profile1" class="tab-pane fade px-4 py-5" role="tabpanel" aria-labelledby="profile1-tab">

                    <div class="row">
                        <div class="col">
                            <div class="table-responsive card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Program Name</th>
                                            <th>Program Term</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $programs = getPrograms('pending_programs');
                                            if (mysqli_num_rows($programs) > 0) {
                                                foreach ($programs as $item) {
                                            ?>
                                           <tr>
                                           <td><?= $item['program_name'];?></td>
                                           <td><?= $item['start_date'];?> <strong>-</strong> <?= $item['end_date'];?></td>
                                           </tr>
                                            <?php
                                                }
                                            }else{
                                                // Assuming the table has 5 columns, set the colspan to 5
                                                echo "<tr>
                                                        <td colspan='2' style='text-align: center;'>No Information Available</td>
                                                      </tr>";
                                            }  
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- History Tab Content -->
                <div id="contact1" class="tab-pane fade px-4 py-5" role="tabpanel" aria-labelledby="contact1-tab">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive card" style="box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Program Name</th>
                                            <th>Program Term</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $programs = getPrograms('expired_programs');
                                            if (mysqli_num_rows($programs) > 0) {
                                                foreach ($programs as $item) {
                                            ?>
                                           <tr>
                                           <td><?= $item['program_name'];?></td>
                                           <td><?= $item['start_date'];?> <strong>-</strong> <?= $item['end_date'];?></td>
                                           </tr>
                                            <?php
                                                }
                                            }else {
                                                // Assuming the table has 5 columns, set the colspan to 5
                                                echo "<tr>
                                                        <td colspan='2' style='text-align: center;'>No Information Available</td>
                                                      </tr>";
                                            }  
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <?php include '../includes/footer.php' ?>
    <script>
        $(document).ready(function() {
            $('.mySelect').select2({
                width: '100%'
            });

        });
    </script>
</body>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="add-div.js"></script>
<script src="script.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->


</html>