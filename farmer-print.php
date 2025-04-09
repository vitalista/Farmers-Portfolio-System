<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>
<?php include '../backend/auth-check.php'; ?>
<?php include '../backend/no-access.php'; ?>
<body>

    <div class="container-fluid">
        <div class="d-sm-flex justify-content-between align-items-center">
            <h3 class="card-title">Farmer Profile</h3>
        </div>
    </div>

    <div class="container">

        <?php

        $paramValue = checkParamId('id');
        if (!is_numeric($paramValue)) {

            echo '<h5>Not Available</h5>';
            return false;
        }

        $farmer = getById('farmers', $paramValue);

        if ($farmer['status'] == 200) {
            $sql = "SELECT image_path, image_data, image_type FROM images WHERE farmer_id = $paramValue";
            $result = $conn->query($sql);

            $imageArray = [];

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imgData = $row['image_data'];
                    $imgPath = $row['image_path'];
                    $imageType = $row['image_type']; 
                    $imageArray[$imageType] = $imgPath;

                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    $mimeType = finfo_buffer($finfo, $imgData);
                    finfo_close($finfo);

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


        ?>
            <div id="farmerCard" class="card">

                <div class="card-body row">
                    <input type="hidden" class="ffrs" value="<?= $farmer['data']['ffrs_system_gen']; ?>">
                    <input type="hidden" class="farmer_id" value="<?= $farmer['data']['id']; ?>">
                    <hr>
                    <div class="col-md-6 text-center mb-3 shadow-sm">
                        <img id="farmerImage" class="rounded-circle mb-2"
                            style="padding: 10px;" src="<?= isset($imageArray['farmerImage']) ? $imageArray['farmerImage'] : "../assets/img/farmer.png"; ?>
"
                            height="<?= isset($imageArray['farmerImage']) ? "200" : "150"; ?>" alt="Farmer">
                        <div class="text-center">
                            <small class="text-muted">Photo taken within 6 months</small>


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
                            <table class="table table-bordered">
                                <tr>
                                    <th>ID Type</th>
                                    <td><?= $farmer['data']['gov_id_type'] ?></td>
                                </tr>
                                <tr>
                                    <th>ID Number</th>
                                    <td><?= $farmer['data']['gov_id_number'] ?></td>
                                </tr>
                            </table>

                            <div class="col-md-6">
                                <label for="govIdPhotoFront"
                                    class="form-label text-emphasis-color fs-6 fw-bold">Front ID
                                    Photo:</label><span class="fs-6 w-100"> Front Preview</span>

                                <!-- Preview for Front ID Photo -->
                                <div id="previewContainerFront" style="display: flex; flex-direction: column;">
                                    <img id="previewImageFront" src="<?= isset($imageArray['govIdPhotoFront']) ? $imageArray['govIdPhotoFront'] : ""; ?>" alt="Front Image Preview" class="img-fluid"
                                        style="max-height: 200px;" />
                                </div>

                            </div>

                            <div class="col-md-6 pb-5">
                                <label for="govIdPhotoBack"
                                    class="form-label text-emphasis-color fs-6 fw-bold">Back ID
                                    Photo: </label><span class="fs-6 w-100"> Back Preview</span>

                                <!-- Preview for Back ID Photo -->

                                <div id="previewContainerBack" style="display: flex;  flex-direction: column;">
                                    <img id="previewImageBack" src="<?= isset($imageArray['govIdPhotoBack']) ? $imageArray['govIdPhotoBack'] : ""; ?>" alt="Back Image Preview" class="img-fluid"
                                        style="max-height: 200px;" />
                                </div>
                            </div>
                        </div>
                    </fieldset>


                    <hr>
                    <h4 class="text-center text-success font-weight-bold">I. Personal Information</h4>
                    <hr>
                    <table class="table table-bordered">
                        <tr>
                            <th>Lastname</th>
                            <td><?= $farmer['data']['last_name']; ?></td>
                        </tr>
                        <tr>
                            <th>First name</th>
                            <td><?= $farmer['data']['first_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Middle name</th>
                            <td><?= $farmer['data']['middle_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Extension name</th>
                            <td><?= $farmer['data']['ext_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Birthday</th>
                            <td><?= $farmer['data']['birthday'] == '0000-00-00' ? '' : $farmer['data']['birthday']; ?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?= $farmer['data']['gender']; ?></td>
                        </tr>
                        <tr>
                            <th>Number of Parcels</th>
                            <td><?= $farmer['data']['no_of_parcels']; ?></td>
                        </tr>
                        <tr>
                            <th>Deceased?</th>
                            <td><?= $farmer['data']['is_deceased'] == 1 ? 'Yes' : 'No'; ?></td>
                        </tr>
                    </table>
                    <hr>
                    <h4 class="text-center text-success font-weight-bold">Farmer Address</h4>
                    <hr>
                    <table class="table table-bordered mt-3">
                        <tr>
                            <th>House/BLDG/ Purok</th>
                            <td><?= $farmer['data']['hbp']; ?></td>
                        </tr>
                        <tr>
                            <th>Street/Sitio/SubDV</th>
                            <td><?= $farmer['data']['sss']; ?></td>
                        </tr>
                        <tr>
                            <th>Barangay</th>
                            <td><?= $farmer['data']['farmer_brgy_address']; ?></td>
                        </tr>
                        <tr>
                            <th>Municipality</th>
                            <td><?= $farmer['data']['farmer_municipality_address']; ?></td>
                        </tr>
                        <tr>
                            <th>Province</th>
                            <td><?= $farmer['data']['farmer_province_address']; ?></td>
                        </tr>
                        <tr>
                            <th>Region</th>
                            <td><?= $farmer['data']['region']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>



            <div class="container farm-card card">

                <hr>
                <h4 class="text-center text-success font-weight-bold">I. Personal Information</h4>
                <hr>

                <div id="farmContainer">

                    <?php
                    $parcels = getById('parcels', $paramValue, false);
                    $crops = getById('crops', $paramValue, false);
                    $livestocks = getById('livestocks', $paramValue, false);

                    if ($parcels['status'] == 200) {

                        foreach ($parcels['data'] as $key => $parcel) {

                            if ($crops['status'] == 200) {
                                $matchingCrops = [];

                                foreach ($crops['data'] as $crop) {
                                    if ($parcel['id'] == $crop['parcel_id']) {
                                        $matchingCrops[] = $crop;
                                    }
                                }
                                if (!empty($matchingCrops)) {
                                    $parcels['data'][$key]['crops'] = $matchingCrops;
                                }
                            }

                            if ($livestocks['status'] == 200) {
                                $matchingLivestocks = [];
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
                        foreach ($parcels['data'] as $parcel) {
                    ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title ms-3">Parcel # <?= $parcel['parcel_no']; ?></h5>
                                </div>
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <th>Owner First Name</th>
                                    <td><?= $parcel['owner_first_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Owner Last Name</th>
                                    <td><?= $parcel['owner_last_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Ownership Type</th>
                                    <td><?= $parcel['ownership_type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Barangay</th>
                                    <td><?= $parcel['parcel_brgy_address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Municipality</th>
                                    <td><?= $parcel['parcel_municipality_address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Province</th>
                                    <td><?= $parcel['parcel_province_address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Farm Size (In hectares)</th>
                                    <td><?= $parcel['parcel_area']; ?></td>
                                </tr>
                                <tr>
                                    <th>Farm Type</th>
                                    <td><?= $parcel['farm_type']; ?></td>
                                </tr>
                            </table>

                            <div class="form-group <?= !isset($parcel['crops']) ? 'd-none' : ''?>" id="cropsContainer">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-pagelines" style="font-size: 30px;color: rgb(29,140,20);"></i>
                                    <h5 class="card-title ms-3 mb-0">Crops</h5>
                                </div>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Crop Name</th>
                                            <th>Crop Area (In hectares)</th>
                                            <th>Classification</th>
                                            <th>High value crop?</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($parcel['crops'])) {
                                            foreach ($parcel['crops'] as $crop): ?>
                                                <tr>
                                                    <td><?= $crop['crop_name']; ?></td>
                                                    <td><?= $crop['crop_area']; ?></td>
                                                    <td><?= $crop['classification']; ?></td>
                                                    <td><?= $crop['hvc'] == 1 ? 'Yes' : 'No'; ?></td>
                                                </tr>
                                        <?php endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="form-group <?= !isset($parcel['livestocks']) ? 'd-none' : ''?>" id="livestockContainer">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-cow" style="font-size: 30px;color: brown"></i>
                                    <h5 class="card-title ms-3 mb-0">Livestocks</h5>
                                </div>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Number of heads</th>
                                            <th>Animal type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($parcel['livestocks'])) {
                                            foreach ($parcel['livestocks'] as $livestock): ?>
                                                <tr>
                                                    <td><?= $livestock['no_of_heads']; ?></td>
                                                    <td><?= $livestock['animal_name']; ?></td>
                                                </tr>
                                        <?php endforeach;
                                        } ?>
                                    </tbody>
                                </table>
                            </div>

                    <?php
                        }
                    } else {
                        echo "<p>No records found.</p>";
                    }
                    ?>



                </div>

            </div>

            <?php
            $tableName = "distributions";

            $sql = "SELECT * FROM $tableName WHERE is_archived = 0 AND farmer_id = $paramValue";
            $result = $conn->query($sql);

            ?>
            <div class="card table-responsive mb-3  <?= $result->num_rows <= 0 ? 'd-none' : '' ?>">
                <div class="card-body mt-3">
                    <table class="table table-bordered table-striped">
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
                                            <td class="text-start"><?= $program['data']['program_name']; ?></td>

                                            <td class="text-start"><strong><?= $resources['data']['resources_name']; ?></strong> - <?= $resources['data']['resource_type']; ?></td>

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

        <?php } else {
            echo '<h5>Not Available</h5>';
        }
        ?>





    </div>
<script>
   window.onload = function() {
    window.print();

    window.onafterprint = function() {
        if (!window.matchMedia('print').matches) {
            window.close();
        }
    };
};

</script>
</body>

</html>