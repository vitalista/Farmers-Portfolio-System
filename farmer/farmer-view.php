<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">
    <?php include '../includes/header.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../includes/sidebar.php' ?>

    <div id="floatingDiv" class="position-fixed bottom-0 start-50 bg-dark translate-middle-x text-white p-3 rounded shadow d-none mb-3"
        style="z-index: 9999;">
        <i class="bi bi-chevron-double-down"></i>
    </div>
    <script>
        window.onload = function() {
            var floatingDiv = document.getElementById("floatingDiv");

            // Show the div when the page loads
            floatingDiv.classList.remove("d-none");

            // Hide it after 30 seconds (30000 milliseconds)
            setTimeout(function() {
                floatingDiv.classList.add("d-none");
            }, 3000);
        };
    </script>

    <main id="main" class="main">

        <section class="main-table">

            <div class="container-fluid">
                <div class="d-sm-flex justify-content-between align-items-center mb-4">
                    <h3 class="card-header">Farmer Profile</h3>
                    <div class="d-sm-flex justify-content-end align-items-center mt-2">
                    <a class="btn btn-primary btn-sm d-none d-sm-inline-block me-1" role="button" href="farmer-print.php?id=<?= $_GET['id']; ?>" target="_blank"><i class="fas fa-download fa-sm text-white-50"></i> Print</a>
                        <a class="btn btn-sm btn-danger"
                            href="#"
                            onclick="window.history.back()">Back</a>
                    </div>
                </div>
            </div>

            <div class="container pb-2">

                <ul class="nav nav-tabs sticky-top" id="myTab" role="tablist"  style="top: 60px;">
                    <li class="nav-item bg-white rounded-3" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Personal Information</button>
                    </li>
                    <li class="nav-item bg-white rounded-3" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Farm Profile</button>
                    </li>
                </ul>
                <form method="POST" action="farmer-add-code.php" id="farmForm" enctype="multipart/form-data">

                    <div class="tab-content pt-2" id="myTabContent">

                        <?php include '../backend/status-messages.php'; ?>

                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <?php

                            $paramValue = checkParamId('id');
                            if (!is_numeric($paramValue)) {

                                echo '<h5>Not Available</h5>';
                                return false;
                            }

                            $farmer = getById('farmers', $paramValue);

                            // echo '<pre style="color: red; font-weight: bold;">';
                            //     print_r($farmer);
                            //     echo '</pre></div>';

                            if ($farmer['status'] == 200) {
                                $sql = "SELECT image_path, image_data, image_type FROM images WHERE farmer_id = $paramValue";
                                $result = $conn->query($sql);

                                $imageArray = []; // Initialize an empty array to store image types and paths

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $imgData = $row['image_data'];
                                        $imgPath = $row['image_path'];
                                        $imageType = $row['image_type'];  // Get image type

                                        // Store the image type as the key and image path as the value in the array
                                        $imageArray[$imageType] = $imgPath;

                                        // Optional: You can still process the image and save it if needed
                                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                                        $mimeType = finfo_buffer($finfo, $imgData);
                                        finfo_close($finfo);

                                        // If you still need to do the image processing, you can use the same logic from earlier
                                        $string = $row['image_path'];
                                        preg_match('/\/(\d{4}-\d{2}-\d{2}_\d{2}-\d{2}-\d{2}[a-zA-Z0-9_-]+)(?=\.\w+)/', $string, $matches);

                                        switch ($mimeType) {
                                            case 'image/jpeg':
                                                $ext = 'jpg';
                                                break;
                                            case 'image/png':
                                                $ext = 'png';
                                                break;
                                            case 'image/gif':
                                                $ext = 'gif';
                                                break;
                                            case 'image/bmp':
                                                $ext = 'bmp';
                                                break;
                                            default:
                                                echo "Unsupported image type!";
                                                exit;
                                        }

                                        $imageFilePath = '../assets/img/' . $matches[1] . '.' . $ext;
                                        file_put_contents($imageFilePath, $imgData);
                                    }
                                }

                                // You can now use $imageArray, which holds the image types as keys and paths as values

                            ?>
                                <div id="farmerCard" class="card">

                                    <div class="card-body row">
                                        <input type="hidden" class="ffrs" value="<?= $farmer['data']['ffrs_system_gen']; ?>">
                                        <input type="hidden" class="farmer_id" value="<?= $farmer['data']['id']; ?>">
                                        <hr>
                                        <div class="col-md-6 text-center mb-3 shadow-sm">
                                            <img id="farmerImage" class="rounded-circle mb-2"
                                                style="background-color: seagreen; padding: 10px;" src="<?= isset($imageArray['farmerImage']) ? $imageArray['farmerImage'] : "../assets/img/farmer.png"; ?>
"
                                                height="<?= isset($imageArray['farmerImage']) ? "200" : "150"; ?>" alt="Farmer">
                                            <div class="text-center">
                                                <label for="farmerImg" class="form-label text-emphasis-color fs-6 fw-bold">Upload Image:</label>
                                                <div class="mb-3">
                                                    <input type="file" class="form-control" accept="image/*" id="farmerImg" name="farmerImage"
                                                        onchange="previewImage()">
                                                    <small class="text-muted">Photo taken within 6 months</small>
                                                </div>


                                                <div class="mt-3 text-start ms-5 p-2">
                                                    <h5 class="fw-bold"><?= $farmer['data']['first_name'] == '' ? 'Farmer' : $farmer['data']['first_name']; ?> <?= $farmer['data']['last_name'] == '' ? 'Name' : $farmer['data']['last_name']; ?></h5>
                                                    <span><span class="fw-bold">FFRS:</span> <?= $farmer['data']['ffrs_system_gen'] == '' ? '00-00-00-00000' : $farmer['data']['ffrs_system_gen']; ?></span><br>
                                                    <span><span class="fw-bold">FPS: <?= $farmer['data']['fps_code'] ?></span></span>
                                                </div>

                                            </div>
                                        </div>

                                        <fieldset class="mt-5 col-md-6">
                                            <legend class="text-emphasis-color fs-5 fw-bold">Government ID:</legend>
                                            <div id="govIdDetails" class="mt-3 row">
                                                <div class="col-md-6">
                                                    <label for="govIdType" class="form-label text-emphasis-color fs-6 fw-bold">ID
                                                        Type:</label>
                                                    <select class="form-select govIdType" id="govIdType" required>
                                                        <option selected disabled value="">Choose...</option>
                                                        <option value="National ID" <?= $farmer['data']['gov_id_type'] == 'National ID' ? 'selected' : ''; ?>>National ID</option>
                                                        <option value="Passport" <?= $farmer['data']['gov_id_type'] == 'Passport' ? 'selected' : ''; ?>>Passport</option>
                                                        <option value="Driver's License" <?= $farmer['data']['gov_id_type'] == "Driver's License" ? 'selected' : ''; ?>>Driver's License</option>
                                                        <option value="Voter's ID" <?= $farmer['data']['gov_id_type'] == "Voter's ID" ? 'selected' : ''; ?>>Voter's ID</option>
                                                        <option value="SC ID" <?= $farmer['data']['gov_id_type'] == 'SC ID' ? 'selected' : ''; ?>>SC ID</option>
                                                        <option value="PWD ID" <?= $farmer['data']['gov_id_type'] == 'PWD ID' ? 'selected' : ''; ?>>PWD ID</option>
                                                        <option value="4PS ID" <?= $farmer['data']['gov_id_type'] == '4PS ID' ? 'selected' : ''; ?>>4PS ID</option>
                                                        <option value="Philhealth ID" <?= $farmer['data']['gov_id_type'] == 'Philhealth ID' ? 'selected' : ''; ?>>Philhealth ID</option>
                                                        <option value="SP ID" <?= $farmer['data']['gov_id_type'] == 'SP ID' ? 'selected' : ''; ?>>SP ID</option>
                                                        <option value="SSS/GSIS ID" <?= $farmer['data']['gov_id_type'] == 'SSS/GSIS ID' ? 'selected' : ''; ?>>SSS/GSIS ID</option>
                                                        <option value="Comelec ID" <?= $farmer['data']['gov_id_type'] == 'Comelec ID' ? 'selected' : ''; ?>>Comelec ID</option>
                                                        <option value="Employee ID" <?= $farmer['data']['gov_id_type'] == 'Employee ID' ? 'selected' : ''; ?>>Employee ID</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="govIdNumber" class="form-label text-emphasis-color fs-6 fw-bold ">ID
                                                        Number:</label>
                                                    <input type="text" class="form-control govIdNumber" value="<?= $farmer['data']['gov_id_number'] ?>" id="govIdNumber"
                                                        placeholder="ID Number">
                                                </div>

                                                <div class="col-md-6">
                                                    <label for="govIdPhotoFront"
                                                        class="form-label text-emphasis-color fs-6 fw-bold mt-2">Upload Front ID
                                                        Photo:</label>
                                                    <input type="file" class="form-control" id="govIdPhotoFront" name="govIdPhotoFront" accept="image/*">
                                                    <small class="form-text text-muted">Only image files are allowed (JPEG, PNG,
                                                        etc.)</small><br>

                                                    <!-- Preview for Front ID Photo -->
                                                    <div id="previewContainerFront" class="mt-3" style="display:<?= isset($imageArray['govIdPhotoFront']) ? 'flex' : 'none'; ?>; flex-direction: column;">
                                                        <label for="govIdPhotoFront" class="fs-6 w-100">Front Preview:</label>

                                                        <img id="previewImageFront" src="<?= isset($imageArray['govIdPhotoFront']) ? $imageArray['govIdPhotoFront'] : ""; ?>" alt="Front Image Preview" class="img-fluid"
                                                            style="max-height: 200px;" />
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <label for="govIdPhotoBack"
                                                        class="form-label text-emphasis-color fs-6 fw-bold mt-2">Upload Back ID
                                                        Photo:</label>
                                                    <input type="file" class="form-control" id="govIdPhotoBack" name="govIdPhotoBack" accept="image/*">
                                                    <small class="form-text text-muted">Only image files are allowed (JPEG, PNG,
                                                        etc.)</small><br>

                                                    <!-- Preview for Back ID Photo -->

                                                    <div id="previewContainerBack" class="mt-3" style="display:<?= isset($imageArray['govIdPhotoBack']) ? 'flex' : 'none'; ?>;  flex-direction: column;">
                                                        <label for="govIdPhotoBack" class="fs-6 w-100">Back Preview:</label>
                                                        <img id="previewImageBack" src="<?= isset($imageArray['govIdPhotoBack']) ? $imageArray['govIdPhotoBack'] : ""; ?>" alt="Back Image Preview" class="img-fluid"
                                                            style="max-height: 200px;" />
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>


                                        <hr>
                                        <h4 class="text-center text-success font-weight-bold mt-2">I. Personal Information</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <fieldset>

                                                    <label class="form-label">Lastname<input type="text" value="<?= $farmer['data']['last_name']; ?>" class="form-control lastName"></label>
                                                    <label class="form-label">First name<input type="text" value="<?= $farmer['data']['first_name']; ?>" class="form-control firstName"></label>
                                                    <label class="form-label">Middle name<input type="text" value="<?= $farmer['data']['middle_name']; ?>" class="form-control middleName"></label>
                                                    <label class="form-label">Extension name<input type="text" value="<?= $farmer['data']['ext_name']; ?>" class="form-control extName"></label>
                                                </fieldset>
                                            </div>
                                            <div class="col">
                                                <fieldset>
                                                    <label class="form-label">Birthday<input type="date" value="<?= $farmer['data']['birthday'] == '0000-00-00' ? '' : $farmer['data']['birthday']; ?>" class="form-control bday"></label>
                                                    <label class="form-label">Gender
                                                        <select class="form-control gender">
                                                            <option value="Male" <?= $farmer['data']['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                                            <option value="Female" <?= $farmer['data']['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                                                        </select>
                                                    </label>
                                                    <label class="form-label">Number of Parcels<input type="text" disabled value="<?= $farmer['data']['no_of_parcels']; ?>" class="form-control"></label>
                                                </fieldset>

                                                <fieldset>
                                                    <label class="form-label">STATUS
                                                        <select class="form-select selected_enrollment" id="selected_enrollment">
                                                            <option value=""> -- Select -- </option>
                                                            <option value="NEW" <?= $farmer['data']['selected_enrollment'] == 'NEW' ? 'selected' : ''; ?>>NEW</option>
                                                            <option value="UPDATING" <?= $farmer['data']['selected_enrollment'] == 'UPDATING' ? 'selected' : ''; ?>>UPDATING</option>
                                                            <option value="OLD" <?= $farmer['data']['selected_enrollment'] == 'OLD' ? 'selected' : ''; ?>>Old</option>
                                                            <option value="CURRENT" <?= $farmer['data']['selected_enrollment'] == 'CURRENT' ? 'selected' : ''; ?>>CURRENT</option>
                                                        </select>
                                                    </label>
                                                </fieldset>

                                                <div class="ms-3 d-flex">

                                                    <div class="ms-5 form-check d-none">
                                                        <input class="form-check-input me-2 deceased" style="width: 2rem; height: 2rem;" type="checkbox" id="deceased" <?= $farmer['data']['is_deceased'] == 1 ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="deceased">
                                                            Deceased?
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <fieldset class="mt-3">
                                            <h6 class="text-success font-weight-bold">Farmer Address*</h6>
                                            <label class="form-label">House/BLDG/ Purok<input type="text" value="<?= $farmer['data']['hbp']; ?>" class="form-control hbp"></label>
                                            <label class="form-label">Street/Sitio/SubDV<input type="text" value="<?= $farmer['data']['sss']; ?>" class="form-control sss"></label>
                                            <label class="form-label">Barangay
                                                <select class="form-select brgy" id="personalBrgy" required>
                                                    <option selected disabled value="">Choose...</option>
                                                    <option value="Bagong Nayon" <?= $farmer['data']['farmer_brgy_address'] == 'Bagong Nayon' ? 'selected' : ''; ?>>Bagong Nayon</option>
                                                    <option value="Barangca" <?= $farmer['data']['farmer_brgy_address'] == 'Barangca' ? 'selected' : ''; ?>>Barangca</option>
                                                    <option value="Calantipay" <?= $farmer['data']['farmer_brgy_address'] == 'Calantipay' ? 'selected' : ''; ?>>Calantipay</option>
                                                    <option value="Catulinan" <?= $farmer['data']['farmer_brgy_address'] == 'Catulinan' ? 'selected' : ''; ?>>Catulinan</option>
                                                    <option value="Concepcion" <?= $farmer['data']['farmer_brgy_address'] == 'Concepcion' ? 'selected' : ''; ?>>Concepcion</option>
                                                    <option value="Hinukay" <?= $farmer['data']['farmer_brgy_address'] == 'Hinukay' ? 'selected' : ''; ?>>Hinukay</option>
                                                    <option value="Makinabang" <?= $farmer['data']['farmer_brgy_address'] == 'Makinabang' ? 'selected' : ''; ?>>Makinabang</option>
                                                    <option value="Matangtubig" <?= $farmer['data']['farmer_brgy_address'] == 'Matangtubig' ? 'selected' : ''; ?>>Matangtubig</option>
                                                    <option value="Pagala" <?= $farmer['data']['farmer_brgy_address'] == 'Pagala' ? 'selected' : ''; ?>>Pagala</option>
                                                    <option value="Paitan" <?= $farmer['data']['farmer_brgy_address'] == 'Paitan' ? 'selected' : ''; ?>>Paitan</option>
                                                    <option value="Piel" <?= $farmer['data']['farmer_brgy_address'] == 'Piel' ? 'selected' : ''; ?>>Piel</option>
                                                    <option value="Pinagbarilan" <?= $farmer['data']['farmer_brgy_address'] == 'Pinagbarilan' ? 'selected' : ''; ?>>Pinagbarilan</option>
                                                    <option value="Poblacion" <?= $farmer['data']['farmer_brgy_address'] == 'Poblacion' ? 'selected' : ''; ?>>Poblacion</option>
                                                    <option value="Sabang" <?= $farmer['data']['farmer_brgy_address'] == 'Sabang' ? 'selected' : ''; ?>>Sabang</option>
                                                    <option value="San Jose" <?= $farmer['data']['farmer_brgy_address'] == 'San Jose' ? 'selected' : ''; ?>>San Jose</option>
                                                    <option value="San Roque" <?= $farmer['data']['farmer_brgy_address'] == 'San Roque' ? 'selected' : ''; ?>>San Roque</option>
                                                    <option value="Santa Barbara" <?= $farmer['data']['farmer_brgy_address'] == 'Santa Barbara' ? 'selected' : ''; ?>>Santa Barbara</option>
                                                    <option value="Santo Cristo" <?= $farmer['data']['farmer_brgy_address'] == 'Santo Cristo' ? 'selected' : ''; ?>>Santo Cristo</option>
                                                    <option value="Santo Niño" <?= $farmer['data']['farmer_brgy_address'] == 'Santo Niño' ? 'selected' : ''; ?>>Santo Niño</option>
                                                    <option value="Subic" <?= $farmer['data']['farmer_brgy_address'] == 'Subic' ? 'selected' : ''; ?>>Subic</option>
                                                    <option value="Sulivan" <?= $farmer['data']['farmer_brgy_address'] == 'Sulivan' ? 'selected' : ''; ?>>Sulivan</option>
                                                    <option value="Tangos" <?= $farmer['data']['farmer_brgy_address'] == 'Tangos' ? 'selected' : ''; ?>>Tangos</option>
                                                    <option value="Tarcan" <?= $farmer['data']['farmer_brgy_address'] == 'Tarcan' ? 'selected' : ''; ?>>Tarcan</option>
                                                    <option value="Tiaong" <?= $farmer['data']['farmer_brgy_address'] == 'Tiaong' ? 'selected' : ''; ?>>Tiaong</option>
                                                    <option value="Tibag" <?= $farmer['data']['farmer_brgy_address'] == 'Tibag' ? 'selected' : ''; ?>>Tibag</option>
                                                    <option value="Tilapayong" <?= $farmer['data']['farmer_brgy_address'] == 'Tilapayong' ? 'selected' : ''; ?>>Tilapayong</option>
                                                    <option value="Virgen delas Flores" <?= $farmer['data']['farmer_brgy_address'] == 'Virgen delas Flores' ? 'selected' : ''; ?>>Virgen delas Flores</option>
                                                </select>
                                            </label>
                                            <label class="form-label">Municipality<input disabled type="text" value="<?= $farmer['data']['farmer_municipality_address']; ?>" class="form-control municipality"></label>
                                            <label class="form-label">Province<input disabled type="text" value="<?= $farmer['data']['farmer_province_address']; ?>" class="form-control province"></label>
                                            <label class="form-label">Region<input disabled type="text" value="<?= $farmer['data']['region']; ?>" class="form-control region"></label>
                                        </fieldset>
                                        <hr>
                                    </div>
                                </div>

                                <?php
                                $tableName = "distributions";

                                $sql = "SELECT * FROM $tableName WHERE is_archived = 0 AND farmer_id = $paramValue";
                                $result = $conn->query($sql);

                                ?>
                                <script>
                                    function getTotalEntries() {
                                        return <?= $result->num_rows; ?>
                                    }
                                </script>

                                <div class="card table-responsive mb-3">
                                    <div class="card-body mt-3">
                                        <table class="table table-bordered table-striped" id="example">
                                            <thead class="thead">
                                                <tr>

                                                    <th class="text-start">FPS</th>
                                                    <th class="text-start">Date</th>
                                                    <th class="text-start">Program</th>
                                                    <th class="text-start">Resources</th>
                                                    <th class="text-start">Quantity</th>
                                                </tr>
                                            </thead>
                                            <tbody class="tbod">
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        $program = getById('programs', $row['program_id']);
                                                        $resources = getById('resources', $row['resource_id']);
                                                        if ($program['status'] == 200 || $resources['status'] == 200) {
                                                ?>
                                                            <tr>
                                                                <td class="text-start"><?= $row['fps_code'] ?></td>
                                                                <td class="text-start"><?= $row['created_at'] ?></td>
                                                                <td class="text-start" style="color: <?= $program['data']['color'];?>;"><?= $program['data']['program_name']; ?></td>

                                                                <td class="text-start" style="color: <?= $program['data']['color'];?>;"><strong><?= $resources['data']['resources_name']; ?> </strong> - <?= $resources['data']['resource_type']; ?></td>

                                                                <td class="text-start"><strong><?= $row['quantity_distributed']; ?></strong> <?= $resources['data']['unit_of_measure']; ?></td>
                                                            </tr>

                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="button" class="btn btn-sm btn-primary" id="nextButton"><i class="bi bi-arrow-right"></i></button>
                                </div>


                        </div>

                    <?php } else {
                                echo '<h5>Not Available</h5>';
                            }
                    ?>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container farm-card">
                            <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                                <h5 class="card-title">Farm List</h5>

                                <a id="addFarmButton" class="btn btn-sm btn-primary <?= $_SESSION['LoggedInUser']['can_create'] == 0 ? 'd-none' : ''; ?>"><i class="fa-solid fa-plus "></i> Farm</a>
                            </div>

                            <div id="farmContainer" class="mt-3">

                                <?php
                                $parcels = getById('parcels', $paramValue, false);
                                $crops = getById('crops', $paramValue, false);
                                $livestocks = getById('livestocks', $paramValue, false);

                                if ($parcels['status'] == 200) {

                                    foreach ($parcels['data'] as $key => $parcel) {

                                        if ($crops['status'] == 200) {
                                            $matchingCrops = [];
                                            // Loop through each crop to find matching ones

                                            foreach ($crops['data'] as $crop) {
                                                if ($parcel['id'] == $crop['parcel_id']) {
                                                    $matchingCrops[] = $crop;  // Collect matching crops in an array
                                                }
                                            }

                                            // Store all matching crops in the parcel's 'crops' field
                                            if (!empty($matchingCrops)) {
                                                $parcels['data'][$key]['crops'] = $matchingCrops;
                                            }
                                        }

                                        if ($livestocks['status'] == 200) {
                                            $matchingLivestocks = [];
                                            // Process livestock (similar approach)
                                            foreach ($livestocks['data'] as $livestock) {
                                                if ($parcel['id'] == $livestock['parcel_id']) {
                                                    $matchingLivestocks[] = $livestock;
                                                }
                                            }

                                            if (!empty($matchingLivestocks)) {
                                                $parcels['data'][$key]['livestocks'] = $matchingLivestocks;
                                            }
                                        }
                                    }

                                    // echo '<pre style="color: red; font-weight: bold;">';
                                    // print_r($parcels);
                                    // echo '</pre></div>';

                                    foreach ($parcels['data'] as $parcel) {
                                ?>
                                        <div class="card my-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="card-title ms-3">Parcel # <?= $parcel['parcel_no']; ?></h5>
                                                </div>
                                                <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) { ?>
                                                    <div class="me-2">
                                                        <a class="btn btn-sm btn-danger remove-farm" id="parcel<?= $parcel['parcel_no']; ?>"
                                                            onclick="return confirm('Are you sure you want to remove it?')"
                                                            href="../backend/archive.php?farmer=<?= $paramValue; ?>&parcel=<?= $parcel['id']; ?>"><i class="fa-solid fa-x"></i></a>
                                                    </div>
                                                <?php } ?>
                                            </div>


                                            <div class="card-body">
                                                <input type="hidden" class="parcelNum" value="<?= $parcel['parcel_no']; ?>" style="width: 100%;">

                                                <input type="hidden" class="parcel_id" value="<?= $parcel['id']; ?>">

                                                <div class="row">
                                                    <h6 class="mt-2 me-3">Owner Information <span class="text-danger red-star"></span></h6>
                                                    <div class="col-md-4 mt-1">
                                                        <div class="form-floating">
                                                            <input type="text" value="<?= $parcel['owner_first_name']; ?>" class="form-control ofName" id="" placeholder="" required>
                                                            <label>Owner First Name</label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-1">
                                                        <div class="form-floating">
                                                            <input type="text" value="<?= $parcel['owner_last_name']; ?>" class="form-control olName" id="" placeholder="" required>
                                                            <label>Owner Last Name</label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mt-1" style="margin-top: -11px;">
                                                        <label class="form-label">Ownership Type</label>
                                                        <select class="form-select ownership" id="" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option value="Tenant" <?= $parcel['ownership_type'] == 'Tenant' ? 'selected' : ''; ?>>Tenant</option>
                                                            <option value="Registered Owner" <?= $parcel['ownership_type'] == 'Registered Owner' ? 'selected' : ''; ?>>Registered Owner</option>
                                                            <option value="Lesse" <?= $parcel['ownership_type'] == 'Lesse' ? 'selected' : ''; ?>>Lesse</option>
                                                            <!-- <option value="Others">Others</option> -->
                                                        </select>
                                                        <div class="invalid-feedback">Please select.</div>
                                                    </div>
                                                    <h6 class="mt-2">Farm Location</h6>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <select class="form-select validationCustom06 farmLocationBrgy" id="" required>
                                                                <option selected disabled value="">Choose...</option>
                                                                <option value="Bagong Nayon" <?= $parcel['parcel_brgy_address'] == 'Bagong Nayon' ? 'selected' : ''; ?>>Bagong Nayon</option>
                                                                <option value="Barangca" <?= $parcel['parcel_brgy_address'] == 'Barangca' ? 'selected' : ''; ?>>Barangca</option>
                                                                <option value="Calantipay" <?= $parcel['parcel_brgy_address'] == 'Calantipay' ? 'selected' : ''; ?>>Calantipay</option>
                                                                <option value="Catulinan" <?= $parcel['parcel_brgy_address'] == 'Catulinan' ? 'selected' : ''; ?>>Catulinan</option>
                                                                <option value="Concepcion" <?= $parcel['parcel_brgy_address'] == 'Concepcion' ? 'selected' : ''; ?>>Concepcion</option>
                                                                <option value="Hinukay" <?= $parcel['parcel_brgy_address'] == 'Hinukay' ? 'selected' : ''; ?>>Hinukay</option>
                                                                <option value="Makinabang" <?= $parcel['parcel_brgy_address'] == 'Makinabang' ? 'selected' : ''; ?>>Makinabang</option>
                                                                <option value="Matangtubig" <?= $parcel['parcel_brgy_address'] == 'Matangtubig' ? 'selected' : ''; ?>>Matangtubig</option>
                                                                <option value="Pagala" <?= $parcel['parcel_brgy_address'] == 'Pagala' ? 'selected' : ''; ?>>Pagala</option>
                                                                <option value="Paitan" <?= $parcel['parcel_brgy_address'] == 'Paitan' ? 'selected' : ''; ?>>Paitan</option>
                                                                <option value="Piel" <?= $parcel['parcel_brgy_address'] == 'Piel' ? 'selected' : ''; ?>>Piel</option>
                                                                <option value="Pinagbarilan" <?= $parcel['parcel_brgy_address'] == 'Pinagbarilan' ? 'selected' : ''; ?>>Pinagbarilan</option>
                                                                <option value="Poblacion" <?= $parcel['parcel_brgy_address'] == 'Poblacion' ? 'selected' : ''; ?>>Poblacion</option>
                                                                <option value="Sabang" <?= $parcel['parcel_brgy_address'] == 'Sabang' ? 'selected' : ''; ?>>Sabang</option>
                                                                <option value="San Jose" <?= $parcel['parcel_brgy_address'] == 'San Jose' ? 'selected' : ''; ?>>San Jose</option>
                                                                <option value="San Roque" <?= $parcel['parcel_brgy_address'] == 'San Roque' ? 'selected' : ''; ?>>San Roque</option>
                                                                <option value="Santa Barbara" <?= $parcel['parcel_brgy_address'] == 'Santa Barbara' ? 'selected' : ''; ?>>Santa Barbara</option>
                                                                <option value="Santo Cristo" <?= $parcel['parcel_brgy_address'] == 'Santo Cristo' ? 'selected' : ''; ?>>Santo Cristo</option>
                                                                <option value="Santo Niño" <?= $parcel['parcel_brgy_address'] == 'Santo Niño' ? 'selected' : ''; ?>>Santo Niño</option>
                                                                <option value="Subic" <?= $parcel['parcel_brgy_address'] == 'Subic' ? 'selected' : ''; ?>>Subic</option>
                                                                <option value="Sulivan" <?= $parcel['parcel_brgy_address'] == 'Sulivan' ? 'selected' : ''; ?>>Sulivan</option>
                                                                <option value="Tangos" <?= $parcel['parcel_brgy_address'] == 'Tangos' ? 'selected' : ''; ?>>Tangos</option>
                                                                <option value="Tarcan" <?= $parcel['parcel_brgy_address'] == 'Tarcan' ? 'selected' : ''; ?>>Tarcan</option>
                                                                <option value="Tiaong" <?= $parcel['parcel_brgy_address'] == 'Tiaong' ? 'selected' : ''; ?>>Tiaong</option>
                                                                <option value="Tibag" <?= $parcel['parcel_brgy_address'] == 'Tibag' ? 'selected' : ''; ?>>Tibag</option>
                                                                <option value="Tilapayong" <?= $parcel['parcel_brgy_address'] == 'Tilapayong' ? 'selected' : ''; ?>>Tilapayong</option>
                                                                <option value="Virgen delas Flores" <?= $parcel['parcel_brgy_address'] == 'Virgen delas Flores' ? 'selected' : ''; ?>>Virgen delas Flores</option>
                                                            </select>
                                                            <label>Barangay<span class="text-danger fw-bold red-star"></span></label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" value="<?= $parcel['parcel_municipality_address']; ?>" class="form-control validationCustom07 farmLocationMunicipality" id="" placeholder="" disabled required>
                                                            <label>Municipality<span class="text-danger fw-bold red-star"></span></label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" value="<?= $parcel['parcel_province_address']; ?>" class="form-control validationCustom08 farmLocationProvince" id="" placeholder="" disabled required>
                                                            <label>Province<span class="text-danger fw-bold red-star"></span></label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mt-4">
                                                        <label>Farm Size</label>
                                                        <input type="number" value="<?= $parcel['parcel_area']; ?>" placeholder="In hectares" class="form-control farmSize no-spin-button" required>
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        <label class="form-label">Farm Type</label>
                                                        <select class="form-select farmType" id="" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option value="IRRIGATED" <?= $parcel['farm_type'] == 'IRRIGATED' ? 'selected' : ''; ?>>Irrigated</option>
                                                            <option value="RAINFED UPLAND" <?= $parcel['farm_type'] == 'RAINFED UPLAND' ? 'selected' : ''; ?>>Rainfed Upland</option>
                                                            <option value="RAINFED LOWLAND" <?= $parcel['farm_type'] == 'RAINFED LOWLAND' ? 'selected' : ''; ?>>Rainfed Lowland</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select.</div>
                                                    </div>

                                                </div>

                                                <div class="form-group" id="cropsContainer">

                                                    <div class="d-flex align-items-center">
                                                        <i class="fa fa-pagelines" style="font-size: 30px;color: rgb(29,140,20);"></i>
                                                        <h5 class="card-title ms-3 mb-0">Crops</h5>
                                                    </div>

                                                    <!-- <label> Crops</label> -->
                                                    <div class="dynamic-input">
                                                        <?php if (isset($parcel['crops'])) {
                                                            foreach ($parcel['crops'] as $crop): ?>
                                                                <div class="row dynamic-input my-2 p-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

                                                                    <input type="hidden" class="crop_id" value="<?= $crop['id']; ?>">

                                                                    <div class="col-md-3 mb-3">
                                                                        <label class="ms-1">Crop Name<span class="text-danger fw-bold red-star"></span></label>
                                                                        <input id="" type="text" list="cropTypes" value="<?= $crop['crop_name']; ?>" placeholder="Type here..." class="form-control crop cropName" required>
                                                                        <datalist id="cropTypes">
                                                                            <option value="Rice/Palay">
                                                                            <option value="Water melon">
                                                                            <option value="String beans - harvested green (sitao)">
                                                                            <option value="Patola">
                                                                            <option value="Okra">
                                                                            <option value="Eggplant (talong)">
                                                                            <option value="Batao">
                                                                            <option value="Pechay">
                                                                            <option value="Corn">
                                                                            <option value="Chili (labuyo)">
                                                                            <option value="Camote">
                                                                            <option value="Mustard">
                                                                            <option value="Mango">
                                                                            <option value="Tomato (kamatis)">
                                                                            <option value="Ampalaya">
                                                                            <option value="Long Chili">
                                                                            <option value="Mongo (Mung Bean)">
                                                                            <option value="Common gourd (upo)">
                                                                            <option value="Bush Sitao">
                                                                            <option value="Winged Bean (pallang)">
                                                                            <option value="Cucumber (pipino)">
                                                                            <option value="Squash (kalabasa)">
                                                                            <option value="Papaya">
                                                                            <option value="Onion bulbs (sibuyas)">
                                                                            <option value="Rambutan">
                                                                            <option value="Kangkong">
                                                                            <option value="Spinach">
                                                                        </datalist>
                                                                    </div>

                                                                    <div class="col-md-3 mb-3">
                                                                        <label class="ms-1">Crop Area<span class="text-danger fw-bold red-star"></span></label>
                                                                        <input id="" type="number" value="<?= $crop['crop_area']; ?>" placeholder="In hectares" class="form-control crop cropArea no-spin-button" required>
                                                                    </div>
                                                                    <div class="col-md-3 mb-3">
                                                                        <label>Classification<span class="text-danger fw-bold red-star"></span></label>
                                                                        <input type="number" value="<?= $crop['classification']; ?>" class="form-control crop no-spin-button classification" required>
                                                                    </div>

                                                                    <div class="col-md-3 mb-3 mt-3 d-flex align-items-center">
                                                                        <label class="form-check-label">High value crop?</label>
                                                                        <div class="form-check ms-2">
                                                                            <input <?= $crop['hvc'] == 1 ? 'checked' : ''; ?> class="form-check-input crop hvc" style="width: 2rem; height: 2rem;" type="checkbox" id="">
                                                                            <input type="hidden" class="parcelNum" value="<?= $parcel['parcel_no']; ?>" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) { ?>
                                                                        <div class="d-flex justify-content-end col-md-12 mb-3 mt-4">
                                                                            <a class="btn btn-sm btn-danger"
                                                                                id="crop<?= $parcel['parcel_no']; ?>"
                                                                                onclick="return confirm('Are you sure you want to remove it?')"
                                                                                href="../backend/archive.php?farmer=<?= $paramValue; ?>&crop=<?= $crop['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                        <?php endforeach;
                                                        } ?>
                                                    </div>
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <a type="button" class="btn btn-sm btn-primary text-end <?= $_SESSION['LoggedInUser']['can_create'] == 0 ? 'd-none' : ''; ?>"
                                                            id="cropBtns<?= $parcel['parcel_no']; ?>"
                                                            data-parcel-no="<?= $parcel['parcel_no']; ?>">
                                                            <i class="fa-solid fa-plus"></i> Crop
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="form-group" id="livestockContainer">
                                                    <div class="d-flex align-items-center">
                                                        <i class="fa-solid fa-cow" style="font-size: 30px;color: brown"></i>
                                                        <h5 class="card-title ms-3 mb-0">Livestocks</h5>

                                                    </div>
                                                    <!-- <label>Livestock</label> -->
                                                    <div class="dynamic-input">

                                                        <?php if (isset($parcel['livestocks'])) {
                                                            foreach ($parcel['livestocks'] as $livestock): ?>
                                                                <div class="row dynamic-input mt-2 px-2 pt-3 mb-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

                                                                    <input type="hidden" class="livestock_id" value="<?= $livestock['id']; ?>">

                                                                    <div class="col-md-6 mb-3">
                                                                        <label>Number of heads<span class="text-danger fw-bold red-star"></span></label>
                                                                        <input type="number" value="<?= $livestock['no_of_heads']; ?>" placeholder="Type here..." class="form-control no-spin-button numberOfHeads" required max="9999999999" min="0" step="1">
                                                                        <input type="hidden" class="parcelNum" value="<?= $parcel['parcel_no']; ?>" style="width: 100%;">
                                                                        <div class="invalid-feedback">Please enter.</div>
                                                                    </div>

                                                                    <div class="col-md-6 mb-3">
                                                                        <div class="form-group">
                                                                            <label for="livestockType">Animal type<span class="text-danger fw-bold red-star"></span></label>
                                                                            <div class="input-group">
                                                                                <input type="text" list="livestockTypes" value="<?= $livestock['animal_name']; ?>" class="form-control livestockType" placeholder="Type here..." required>
                                                                                <datalist id="livestockTypes">
                                                                                    <option value="Pigs or swine">       
                                                                                    <option value="Buffaloes (Carabaos)">
                                                                                    <option value="Goats">
                                                                                    <option value="Ducks">
                                                                                    <option value="Chickens">
                                                                                    <option value="Turkeys">
                                                                                    <option value="Geese">
                                                                                    <option value="Sheep">
                                                                                    <option value="Cattle">
                                                                                    <option value="Horses">
                                                                                    <option value="Rabbits and hares">
                                                                                    <option value="Quail">
                                                                                </datalist>
                                                                                <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) { ?>

                                                                                    <div class="input-group-append">
                                                                                        <a class="btn btn-sm btn-danger mt-1 removeLivestockButton" id="livestock<?= $parcel['parcel_no']; ?>"
                                                                                            onclick="return confirm('Are you sure you want to remove it?')"
                                                                                            href="../backend/archive.php?farmer=<?= $paramValue; ?>&livestock=<?= $livestock['id']; ?>"><i class="fa-solid fa-trash-can"></i></a>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                        <?php endforeach;
                                                        } ?>

                                                    </div>
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <a type="button" class="btn btn-sm btn-primary addLivestockButton <?= $_SESSION['LoggedInUser']['can_create'] == 0 ? 'd-none' : ''; ?>"
                                                            id="livestockBtns<?= $parcel['parcel_no']; ?>"
                                                            data-parcel-no="<?= $parcel['parcel_no']; ?>"><i class="fa-solid fa-plus"></i> Livestock</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                <?php
                                    }
                                } else {
                                    echo "<p>No records found.</p>";
                                }
                                ?>



                            </div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="button" class="btn btn-sm btn-primary  me-1" id="prevButton"><i class="bi bi-arrow-left"></i></button>
                        </div>

                    </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button id="submitFarmsButton" class="btn btn-sm btn-success me-2"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                    </div>
                    <input type="hidden" name="update" value="1">
                    <input type="hidden" name="farms_data" id="farmsData" style="width: 100%;">
                </form>

            </div>
        </section>
    </main>

    <?php include 'missing-parcel.php'; ?>
    <script src="./farmer-view.js"></script>
    <script src="script.js"></script>

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>
    <script src="./farmer-add.js"></script>

</body>

</html>