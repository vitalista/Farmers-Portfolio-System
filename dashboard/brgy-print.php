<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>
<?php include '../backend/auth-check.php'; ?>

<body style="font-family: fangsong;">
    <div class="container mt-5" id="overview">
        <h1 class="text-center mb-4"><?= $_GET['brgy']; ?> Overview</h1>
        <h6 class="text-dark text-end" id="fullNameDisplay"></h6>
        <div class="row">

            <div class="col-md-3 mb-3 box">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Farmers</h5>
                        <p class="card-text"><?= countRows('farmers', '', $_GET['brgy']); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3 box">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Parcels</h5>
                        <p class="card-text"><?= countRows('parcels', '', $_GET['brgy']); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3 box">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Total Parcels Size</h5>
                        <p class="card-text"><?php
                                                $number = sumColumn('parcels', 'parcel_area', $_GET['brgy']);
                                                $decimalPlaces = 2;
                                                $roundedValue = ceil($number * pow(10, $decimalPlaces)) / pow(10, $decimalPlaces);
                                                echo $roundedValue;
                                                ?> Ha</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3 box">
                <div class="card">
                    <div class="card-body d-flex flex-column align-items-center justify-content-center">
                        <h5 class="card-title">Without Owners</h5>
                        <p class="card-text">
                            <?= returnNullRows('parcels', $_GET['brgy']); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6 box">
                <div class="card pt-4">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <div class="d-flex align-items-center mx-3">
                                <div class="ms-2">
                                    <span class="fw-bold">Male</span>
                                    <div><?= countRows('farmers', '', $_GET['brgy'], 'MALE'); ?></div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mx-3">
                                <div class="ms-2">
                                    <span class="fw-bold">Female</span>
                                    <div><?= countRows('farmers', '', $_GET['brgy'], 'FEMALE'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div>Total: <?= countRows('farmers', '', $_GET['brgy'], 'FEMALE') + countRows('farmers', '', $_GET['brgy'], 'MALE'); ?></div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6 box">
                <div class="card pt-4">
                    <div class="card-body text-center">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <div class="d-flex align-items-center mx-3">
                                <div class="ms-2">
                                    <!-- CROP -->
                                    <span class="fw-bold">Crops</span>
                                    <div><?= countRows('crops', '', $_GET['brgy']); ?></div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mx-3">
                                <div class="ms-2">
                                    <span class="fw-bold">Livestocks</span>
                                    <div><?= countRows('livestocks', '', $_GET['brgy']); ?></div>
                                </div>
                            </div>
                        </div>
                        <div>Total: <?= countRows('crops', '', $_GET['brgy']) +  countRows('livestocks', '', $_GET['brgy']); ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3 box">
                <div class="card table-container">
                    <div class="card-body">
                        <h5 class="card-title">Crops</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Number</th>
                                    <th class="text-center">Crop</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = getCountArray('crops', 'crop_name', 'count', $_GET['brgy']);
                                $name =  getCountArray('crops', 'crop_name', 'id', $_GET['brgy']);

                                for ($i = 0; $i < count($count); $i++) {
                                    echo "<tr><td class='text-center'>" . $count[$i] . "</td><td class='text-center'>" . $name[$i] . "</td></tr>";
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3 box">
                <div class="card table-container">
                    <div class="card-body">
                        <h5 class="card-title">Livestocks</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Number</th>
                                    <th class="text-center">Livestock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = getCountArray('livestocks', 'animal_name', 'count', $_GET['brgy']);
                                $name = getCountArray('livestocks', 'animal_name', 'id', $_GET['brgy']);
                                for ($i = 0; $i < count($count); $i++) {
                                    echo "<tr><td class='text-center'>" . $count[$i] . "</td><td class='text-center'>" . $name[$i] . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="../assets/js/print.js"></script>
</body>

</html>