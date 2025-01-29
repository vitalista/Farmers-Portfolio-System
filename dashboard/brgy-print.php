<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body style="font-family: fangsong;">
<div class="container mt-5" id="overview">
    <h1 class="text-center mb-4"><?= $_GET['brgy']; ?> Overview</h1>

    <div class="row">

        <div class="col-md-3 mb-3 box">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h5 class="card-title">Farmers</h5>
                    <p class="card-text"><?= brgyCountRows('farmers', $_GET['brgy']); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3 box">
            <div class="card">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <h5 class="card-title">Parcels</h5>
                    <p class="card-text"><?= brgyCountRows('parcels', $_GET['brgy']); ?></p>
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
                            <i class="fa fa-male" style="font-size: 60px;color: rgb(54,77,249);"></i>
                            <div class="ms-2">
                                <span class="fw-bold">Male</span>
                                <div><?= brgyCountRows('farmers', $_GET['brgy'], 'MALE'); ?></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <i class="fa fa-female" style="font-size: 60px;color: rgb(232,23,23);"></i>
                            <div class="ms-2">
                                <span class="fw-bold">Female</span>
                                <div><?= brgyCountRows('farmers', $_GET['brgy'], 'FEMALE'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div>Total: <?= brgyCountRows('farmers', $_GET['brgy'], 'FEMALE') + brgyCountRows('farmers', $_GET['brgy'], 'MALE'); ?></div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 box">
            <div class="card pt-4">
                <div class="card-body text-center">
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <div class="d-flex align-items-center mx-3">
                            <i class="fa fa-pagelines" style="font-size: 60px;color: rgb(29,140,20);"></i>
                            <div class="ms-2">
                                <!-- CROP -->
                                <span class="fw-bold">Crops</span>
                                <div><?= brgyCountRows('crops', $_GET['brgy']); ?></div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mx-3">
                            <!-- PIG -->
                            <div class="ms-2">
                                <span class="fw-bold">Livestocks</span>
                                <div><?= brgyCountRows('livestocks', $_GET['brgy']); ?></div>
                            </div>
                        </div>
                    </div>
                    <div>Total: <?= brgyCountRows('crops', $_GET['brgy']) +  brgyCountRows('livestocks', $_GET['brgy']); ?></div>
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
                            $count = brgyGetCountArray('crops', 'crop_name', 'count', $_GET['brgy']);
                            $name =  brgyGetCountArray('crops', 'crop_name', 'id', $_GET['brgy']);

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
                            $count = brgyGetCountArray('livestocks', 'animal_name', 'count', $_GET['brgy']);
                            $name = brgyGetCountArray('livestocks', 'animal_name', 'id', $_GET['brgy']);
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


   <!-- ======= Footer ======= -->
   <script>
   window.print();
    const boxes = document.querySelectorAll('.box');
    let isCtrlPressed = false;

    // Handle click event on each box
    boxes.forEach((box) => {
      box.addEventListener('click', () => {
        if (isCtrlPressed) {
          const currentWidth = parseInt(window.getComputedStyle(box).width);
          box.style.width = `${currentWidth + 50}px`;
        } else {
          box.style.display = 'none';  // Hide the box
        }
      });
    });

    // Detect if the Ctrl key is being pressed
    window.addEventListener('keydown', (event) => {
      if (event.key === 'Control') {
        isCtrlPressed = true;
      }
    });

    window.addEventListener('keyup', (event) => {
      if (event.key === 'Control') {
        isCtrlPressed = false;
      }
    });
   </script>

</body>

</html>