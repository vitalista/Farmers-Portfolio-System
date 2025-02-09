<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">
  <?php include '../includes/header.php' ?>
  <?php include '../includes/sidebar.php' ?>

  <main class="main" id="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12 main-table">
          <div class="card farmer-registration">
            <div class="card-body">
            <form method="POST" action="farmer-add-code.php" id="farmForm" enctype="multipart/form-data">

              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Add Farmer</h5>
                <div>
                  <a onclick="window.history.back()" class="btn btn-sm btn-danger">Back</a>
                </div>
              </div>

              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Personal Information</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Farm Profile</button>
                </li>
              </ul>

              <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                  <?php include '../backend/status-messages.php'; ?>

                  <div class="card" id="farmerCard">
                    <div class="card-body row g-3">

                      <h6 class="mt-5">Registration Code</h6>
                      <div class="col-md-6 text-center mb-3 shadow-sm">
                      <img id="farmerImage" class="rounded-circle mb-2"
                            style="background-color: seagreen; padding: 10px;" src="../assets/img/farmer.png"
                            height="150" alt="Farmer">
                            </div>
                      <div class="col-md-6">
                      <label for="govIdType" class="form-label text-emphasis-color fs-6 fw-bold">Upload Image:</label>
                          <div class="mb-3">
                            <input type="file" class="form-control" accept="image/*" id="farmerImg" name="farmerImage"
                              onchange="previewImage()">
                            <small class="text-muted">Photo taken within 6 months</small>
                          </div>

                          <label for="ffrs">FFRS SYSTEM GEN.<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control ffrs" id="ffrs" placeholder="">
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                      
                    <fieldset class="mb-3">
                            <legend class="text-emphasis-color fs-5 fw-bold">Government ID:</legend>
                            <div id="govIdDetails" class="mt-3 row">
                                <div class="col-md-6">
                                    <label for="govIdType" class="form-label text-emphasis-color fs-6 fw-bold">ID
                                        Type:</label>
                                    <input type="text" class="form-control govIdType" id="govIdType"
                                        placeholder="ID Type">
                                </div>

                                <div class="col-md-6">
                                    <label for="govIdNumber" class="form-label text-emphasis-color fs-6 fw-bold ">ID
                                        Number:</label>
                                    <input type="text" class="form-control govIdNumber" id="govIdNumber"
                                        placeholder="ID Number">
                                </div>

                                <div class="col-md-6">
                                    <label for="govIdPhotoFront"
                                        class="form-label text-emphasis-color fs-6 fw-bold mt-2">Upload Front ID
                                        Photo:</label>
                                    <input type="file" class="form-control" id="govIdPhotoFront" name="govIdPhotoFront" accept="image/*">
                                    <small class="form-text text-muted">Only image files are allowed (JPEG, PNG,
                                        etc.)</small>

                                    <!-- Preview for Front ID Photo -->
                                    <div id="previewContainerFront" class="mt-3" style="display:none;">
                                        <label for="govIdPhotoFront" class="fs-6">Front Preview:</label>
                                        <img id="previewImageFront" src="" alt="Front Image Preview" class="img-fluid"
                                            style="max-height: 200px;" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="govIdPhotoBack"
                                        class="form-label text-emphasis-color fs-6 fw-bold mt-2">Upload Back ID
                                        Photo:</label>
                                    <input type="file" class="form-control" id="govIdPhotoBack" name="govIdPhotoBack" accept="image/*">
                                    <small class="form-text text-muted">Only image files are allowed (JPEG, PNG,
                                        etc.)</small>

                                    <!-- Preview for Back ID Photo -->
                                    <div id="previewContainerBack" class="mt-3" style="display:none;">
                                        <label for="govIdPhotoBack" class="fs-6">Back Preview:</label>
                                        <img id="previewImageBack" src="" alt="Back Image Preview" class="img-fluid"
                                            style="max-height: 200px;" />
                                    </div>
                                </div>
                            </div>
                    </fieldset>

                      <h6 class="fw-bold">Address</h6>

                      <div class="col-md-3">
                      <label for="hbp">House/BLDG/ Purok<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control hbp" id="hbp" placeholder="" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-3">
                      <label for="sss">Street/Sitio/SubDV<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control sss" id="sss" placeholder="" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-3">
                      <label for="personalBrgy">BARANGAY<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control brgy" id="personalBrgy" placeholder="" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-3">
                        <label for="personalMunicipality">Municipality<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control municipality" id="personalMunicipality" placeholder="" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-3">
                        <label for="brgy">Province<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control province" id="brgy" placeholder="" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      
                      <div class="col-md-3">
                      <label for="region">Region<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control region" id="region" placeholder="" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <h6 class="fw-bold">Full Name</h6>
                      <div class="col-md-3">
                        <label for="floatingFname">First Name<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control firstName" id="floatingFname" placeholder="" required>

                        <div class="invalid-feedback">Please enter.</div>

                      </div>

                      <div class="col-md-3">
                        <label for="floatingMname">Middle Name<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control middleName" id="floatingMname" placeholder="" required>

                        <div class="invalid-feedback">Please enter.</div>

                      </div>

                      <div class="col-md-3">
                        <label for="floatingLname">Last Name<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control lastName" id="floatingLname" placeholder="" required>

                        <div class="invalid-feedback">Please enter.</div>

                      </div>

                      <div class="col-md-3">
                        <label for="validationCustom10">Extension Name</label>
                        <input type="text" class="form-control extName" id="validationCustom10">
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-3">
                        <label for="validationCustom01" class="form-label">Gender<span class="text-danger fw-bold">*</span></label>
                        <select class="form-select gender" id="validationCustom01" required>
                          <option selected disabled value="">Choose...</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback">Please select.</div>
                      </div>

                      <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Birthday<span class="text-danger fw-bold">*</span></label>
                        <input type="date" class="form-control bday" id="validationCustom05" required>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-2 mt-4 ms-5">
                        <label class="form-check-label" for="deceased">
                          Deceased?
                        </label>
                        <div class="form-check">
                          <input class="form-check-input me-2 deceased" style="width: 2rem; height: 2rem;" type="checkbox" id="deceased">
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="d-flex justify-content-center mb-2">

                    <button type="button" class="btn btn-sm btn-primary" id="nextButton"><i class="bi bi-arrow-right"></i></button>
                  </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="container farm-card">
                    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                      <h5 class="card-title">Farm List</h5>
                      <a id="addFarmButton" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Farm</a>
                    </div>

                    <div id="farmContainer" class="mt-3"></div>

                  </div>
                  <div class="d-flex justify-content-center mb-2">
                    <button type="button" class="btn btn-sm btn-primary  me-1" id="prevButton"><i class="bi bi-arrow-left"></i></button>
                  </div>
                </div>
              </div>



              <div class="d-flex justify-content-end">
                <button type="submit" id="submitFarmsButton" class="btn btn-sm btn-success me-2">Save</button>
              </div>

                <input type="hidden" name="add" value="0">
                <input type="hidden" name="farms_data" id="farmsData" style="width: 100%;">
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
    let farmCounter = 0;
  </script>
  <script src="./farmer-add.js"></script>

</body>

</html>