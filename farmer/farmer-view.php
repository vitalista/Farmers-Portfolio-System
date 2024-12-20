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

            <div class="container pb-2">

                <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Personal Information</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Farm Profile</button>
                    </li>
                </ul>

                <div class="tab-content pt-2" id="myTabContent">
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
                        ?>

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
                                                <h1 class="font-weight-bold"><?= $farmer['data']['first_name'] == '' ? 'Farmer' : $farmer['data']['first_name']; ?> <?= $farmer['data']['last_name'] == '' ? 'Name' : $farmer['data']['last_name']; ?></h1>
                                                <span><?= $farmer['data']['ffrs_system_gen'] == '' ? '00-00-00-00000' : $farmer['data']['ffrs_system_gen']; ?></span>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="farmerCard">
                                <div class="col">
                                    <div class="card my-4" data-aos="fade-up" data-aos-duration="450" data-aos-delay="200">
                                        <div class="card-body">
                                            <hr>
                                            <h4 class="text-center text-success font-weight-bold mt-2">I. Personal Information</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <fieldset>
                                                        <input type="hidden" class="ffrs" value="<?= $farmer['data']['ffrs_system_gen']; ?>">
                                                        <input type="hidden" class="deceased" value="<?= $farmer['data']['is_deceased']; ?>">
                                                        <input type="hidden" class="active" value="<?= $farmer['data']['is_active']; ?>">
                                                        <input type="hidden" class="farmer_id" value="<?= $farmer['data']['id']; ?>">

                                                        <label class="form-label">Lastname<input type="text" value="<?= $farmer['data']['last_name']; ?>" class="form-control lastName"></label>
                                                        <label class="form-label">First name<input type="text" value="<?= $farmer['data']['first_name']; ?>" class="form-control firstName"></label>
                                                        <label class="form-label">Middle name<input type="text" value="<?= $farmer['data']['middle_name']; ?>" class="form-control"></label>
                                                    </fieldset>
                                                </div>
                                                <div class="col">
                                                    <fieldset>
                                                        <label class="form-label">Birthday<input type="text" value="<?= $farmer['data']['birthday']; ?>" class="form-control bday"></label>
                                                        <label class="form-label">Gender<input type="text" value="<?= $farmer['data']['gender']; ?>" class="form-control gender"></label>
                                                        <label class="form-label">Extension name<input type="text" value="<?= $farmer['data']['ext_name']; ?>" class="form-control extName"></label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <hr>
                                            <fieldset class="mt-3">
                                                <h6 class="text-success font-weight-bold">Farmer Address*</h6>
                                                <label class="form-label">Province<input type="text" value="<?= $farmer['data']['farmer_brgy_address']; ?>" class="form-control brgy"></label>
                                                <label class="form-label">Municipality<input type="text" value="<?= $farmer['data']['farmer_municipality_address']; ?>" class="form-control municipality"></label>
                                                <label class="form-label">Barangay<input type="text" value="<?= $farmer['data']['farmer_province_address']; ?>" class="form-control province"></label>
                                            </fieldset>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } else {
                            echo '<h5>Not Available</h5>';
                        }
                        ?>
                        <!-- <div class="row">
                    <div class="col">
                        <div class="card my-4" data-aos="fade-up" data-aos-duration="450" data-aos-delay="200">
                            <div class="card-body">
                                <hr>
                                <h4 class="text-center text-success font-weight-bold mt-2">Parcel No. <span class="ml-2">0</span></h4>
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
                </div> -->

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

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="container farm-card">
                            <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                                <h5 class="card-title">Farm List</h5>
                                <a id="addFarmButton" class="btn btn-primary">Add Farm</a>
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
                                            <h5 class="card-title ms-3">Parcel # <?= $parcel['parcel_no']; ?></h5>
                                            <div class="card-body">
                                                <input type="text" class="parcelNum" value="<?= $parcel['parcel_no']; ?>" style="width: 100%;">

                                                <input type="hidden" class="parcel_id" value="<?= $parcel['id']; ?>">

                                                <div class="row">
                                                    <h6 class="mt-2 me-3">Owner Information <span class="text-danger">*</span></h6>
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
                                                        <label class="form-label">Ownership Type<span class="red-star">*</span></label>
                                                        <select class="form-select ownership" id="" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option value="Tenant" <?= $parcel['ownership_type'] == 'Tenant' ? 'selected' : ''; ?>>Tenant</option>
                                                            <option value="Registered Owner" <?= $parcel['ownership_type'] == 'Registered Owner' ? 'selected' : ''; ?>>Registered Owner</option>
                                                            <option value="Lesse" <?= $parcel['ownership_type'] == 'Lesse' ? 'selected' : ''; ?>>Lesse</option>
                                                            <!-- <option value="Others">Others</option> -->
                                                        </select>
                                                        <div class="invalid-feedback">Please select.</div>
                                                    </div>
                                                    <h6 class="mt-2">Farm Location<span class="red-star">*</span></h6>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" value="<?= $parcel['parcel_brgy_address']; ?>" class="form-control validationCustom06 farmLocationBrgy" id="" placeholder="" required>
                                                            <label>Barangay</label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" value="<?= $parcel['parcel_municipality_address']; ?>" class="form-control validationCustom07 farmLocationMunicipality" id="" placeholder="" required>
                                                            <label>Municipality</label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-floating">
                                                            <input type="text" value="<?= $parcel['parcel_province_address']; ?>" class="form-control validationCustom08 farmLocationProvince" id="" placeholder="" required>
                                                            <label>Province</label>
                                                            <div class="invalid-feedback">Please enter.</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mt-4">
                                                        <label>Farm Size</label>
                                                        <input type="number" value="<?= $parcel['parcel_area']; ?>" placeholder="In hectares" class="form-control farmSize no-spin-button" required>
                                                    </div>
                                                    <div class="col-md-4 mt-3">
                                                        <label class="form-label">Farm Type<span class="red-star">*</span></label>
                                                        <select class="form-select farmType" id="" required>
                                                            <option selected disabled value="">Choose...</option>
                                                            <option value="IRRIGATED" <?= $parcel['farm_type'] == 'IRRIGATED' ? 'selected' : ''; ?>>Irrigated</option>
                                                            <option value="UPLAND" <?= $parcel['farm_type'] == 'UPLAND' ? 'selected' : ''; ?>>Rainfed Upland</option>
                                                            <option value="LOWLAND" <?= $parcel['farm_type'] == 'LOWLAND' ? 'selected' : ''; ?>>Rainfed Lowland</option>
                                                        </select>
                                                        <div class="invalid-feedback">Please select.</div>
                                                    </div>

                                                </div>

                                                <div class="form-group" id="cropsContainer">
                                                    <label>Crops</label>
                                                    <div class="dynamic-input">
                                                        <?php if (isset($parcel['crops'])) {
                                                            foreach ($parcel['crops'] as $crop): ?>
                                                                <div class="row dynamic-input my-2 p-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

                                                                <input type="hidden" class="crop_id" value="<?= $crop['id']; ?>">

                                                                    <div class="col-md-3 mb-3 mt-3 d-flex align-items-center">
                                                                        <label class="form-check-label">High value crop?</label>
                                                                        <div class="form-check ms-2">
                                                                            <input <?= $crop['hvc'] == 1 ? 'checked' : ''; ?> class="form-check-input crop hvc" style="width: 2rem; height: 2rem;" type="checkbox" id="">
                                                                            <input type="hidden" class="parcelNum" value="<?= $parcel['parcel_no']; ?>" style="width: 100%;">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 mb-3">
                                                                        <label class="ms-1">Crop Area</label>
                                                                        <input id="" type="number" value="<?= $crop['crop_area']; ?>" placeholder="In hectares" class="form-control crop cropArea no-spin-button" required>
                                                                    </div>
                                                                    <div class="col-md-2 mb-3">
                                                                        <label>Classification</label>
                                                                        <input type="number" value="<?= $crop['classification']; ?>" class="form-control crop no-spin-button classification" required>
                                                                    </div>
                                                                    <div class="d-flex justify-content-end col-md-2 mb-3 mt-4">
                                                                        <a class="btn btn-danger"
                                                                            id="crop<?= $parcel['parcel_no']; ?>"
                                                                             onclick="return confirm('Are you sure you want to remove it?')"
                                                    href="../backend/archive.php?farmer=<?= $paramValue; ?>&crop=<?= $crop['id'];?>"
                                                                            >Remove</a>
                                                                    </div>
                                                                </div>
                                                        <?php endforeach;
                                                        } ?>
                                                    </div>
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <a type="button" class="btn btn-primary text-end" 
                                                        id="cropBtns<?= $parcel['parcel_no']; ?>" 
                                                        data-parcel-no="<?= $parcel['parcel_no']; ?>">
                                                        Add Crop
                                                        </a>
                                                    </div>

                                                </div>
                                                <div class="form-group" id="livestockContainer">
                                                    <label>Livestock</label>
                                                    <div class="dynamic-input">

                                                        <?php if (isset($parcel['livestocks'])) {
                                                            foreach ($parcel['livestocks'] as $livestock): ?>
                                                                <div class="row dynamic-input mt-2 px-2 pt-3 mb-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">

                                                                <input type="hidden" class="livestock_id" value="<?= $livestock['id']; ?>">

                                                                    <div class="col-md-6 mb-3">
                                                                        <input type="number" value="<?= $livestock['no_of_heads']; ?>" placeholder="Number of heads" class="form-control no-spin-button numberOfHeads" required max="9999999999" min="0" step="1">
                                                                        <input type="hidden" class="parcelNum" value="<?= $parcel['parcel_no']; ?>" style="width: 100%;">
                                                                        <div class="invalid-feedback">Please enter.</div>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <div class="input-group mb-2">
                                                                            <input type="text" value="<?= $livestock['animal_name']; ?>" class="form-control livestockType" placeholder="Enter animal type" required>
                                                                            <div class="input-group-append">
                                                                                <a class="btn btn-danger removeLivestockButton" id="livestock<?= $parcel['parcel_no']; ?>"
                                                                                 onclick="return confirm('Are you sure you want to remove it?')"
                                                    href="../backend/archive.php?farmer=<?= $paramValue; ?>&livestock=<?= $livestock['id'];?>"
                                                                                >Remove</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php endforeach;
                                                        } ?>

                                                    </div>
                                                    <div class="d-flex justify-content-end mb-2">
                                                        <a type="button" class="btn btn-primary addLivestockButton"
                                                         id="livestockBtns<?= $parcel['parcel_no']; ?>"
                                                          data-parcel-no="<?= $parcel['parcel_no']; ?>"
                                                        >Add Livestock</a>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end">
                                                    <a class="btn btn-danger remove-farm" id="parcel<?= $parcel['parcel_no']; ?>"
                                                    onclick="return confirm('Are you sure you want to remove it?')"
                                                    href="../backend/archive.php?farmer=<?= $paramValue; ?>&parcel=<?= $parcel['id']; ?>"
                                                    >Remove Farm</a>
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
                    </div>

                </div>

                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">Reset</button>
                    <button type="submit" id="submitFarmsButton" class="btn btn-success me-2">Save</button>
                </div>

                <form class="needs-validation" method="POST" action="farmer-add-code.php" id="farmForm" novalidate>
                    <input type="hidden" name="farms_data" id="farmsData" style="width: 100%;">
                </form>

                <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary  me-1" id="prevButton"><i class="bi bi-arrow-left"></i></button>
                    <button type="button" class="btn btn-primary" id="nextButton"><i class="bi bi-arrow-right"></i></button>
                </div>


            </div>
        </section>
    </main>

    <script src="./farmer-view.js"></script>

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>
    <script src="./farmer-add.js"></script>

</body>

</html>