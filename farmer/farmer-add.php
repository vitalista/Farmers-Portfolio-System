<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>

<body class="login-bg">

  <!-- ======= Header ======= -->
  <?php include '../includes/header.php' ?>

  <!-- ======= Sidebar ======= -->
  <?php include '../includes/sidebar.php' ?>
  <!-- ======= Main ======= -->
  <main class="main" id="main">
    <section class="section">
      <div class="row">
        <div class="col-lg-12 main-table">
          <div class="card farmer-registration">
            <div class="card-body">
              <h5 class="card-title">Add Farmer</h5>

              <!-- Default Tabs -->
              <form class="needs-validation" id="farmForm" novalidate>
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

                    <div class="card">
                      <div class="card-body row g-3">

                        <h6 class="mt-5">Registration Code<span class="red-star">*</span></h6>

                        <div class="d-none col-md-6">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="lgu" placeholder="" required>
                            <label for="lgu">LGU REFERENCE CODE</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="ffrs" placeholder="" required>
                            <label for="ffrs">FFRS SYSTEM GEN.</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <h6>Address<span class="red-star">*</span></h6>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="personalBrgy" placeholder="" required>
                            <label for="personalBrgy">BARANGAY</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="personalMunicipality" placeholder="" required>
                            <label for="personalMunicipality">Municipality</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="brgy" placeholder="" required>
                            <label for="brgy">Province</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <h6>Full Name<span class="red-star">*</span></h6>
                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="floatingFname" placeholder="" required>
                            <label for="floatingFname">First Name</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="floatingMname" placeholder="" required>
                            <label for="floatingMname">Middle Name</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <div class="col-md-4">
                          <div class="form-floating">
                            <input type="text" class="form-control" id="floatingLname" placeholder="" required>
                            <label for="floatingLname">Last Name</label>
                            <div class="invalid-feedback">Please enter.</div>
                          </div>
                        </div>

                        <div class="col-md-2">
                          <label for="validationCustom10" class="form-label">Extension Name</label>
                          <input type="text" class="form-control" id="validationCustom10">
                          <div class="invalid-feedback">Please enter.</div>
                        </div>

                        <div class="col-md-2">
                          <label for="validationCustom01" class="form-label">Gender<span class="red-star">*</span></label>
                          <select class="form-select" id="validationCustom01" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                          <div class="invalid-feedback">Please select.</div>
                        </div>

                        <div class="col-md-2">
                          <label for="validationCustom05" class="form-label">Birthday<span class="red-star">*</span></label>
                          <input type="date" class="form-control" id="validationCustom05" required>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>

                        <div class="col-md-2 mt-4 ms-5">
                          <label class="form-check-label" for="deceased">
                            Deceased?
                          </label>
                          <div class="form-check">
                            <input class="form-check-input me-2" style="width: 2rem; height: 2rem;" type="checkbox" id="deceased">
                          </div>
                        </div>

                        <div class="col-md-2 mt-4">
                          <label class="form-check-label" for="active">
                            Active?
                          </label>
                          <div class="form-check">
                            <input class="form-check-input me-2" style="width: 2rem; height: 2rem;" type="checkbox" required id="active">
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>



                  <!-- Farm Profile Information -->
                  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="container farm-card">
                      <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                        <h5 class="card-title">Farm List</h5>
                        <a id="addFarmButton" class="btn btn-primary">Add Farm</a>
                      </div>

                      <div id="farmContainer" class="mt-3"></div>
                      <!-- Submit Button -->
                      <!-- Form to submit farms -->

                    </div>
                  </div>
                  <!-- Farm Profile Information -->
                </div>
            </div>


            <div class="d-flex justify-content-end">
              <button type="reset" class="btn btn-secondary me-2">Reset</button>
              <button type="submit" id="submitFarmsButton" class="btn btn-success me-2">Save</button>
            </div>
            <input type="hidden" name="farms_data" id="farmsData" style="width: 100%;">

            <div class="d-flex justify-content-center mb-2">
              <button type="button" class="btn btn-primary  me-1" id="prevButton"><i class="bi bi-arrow-left"></i></button>
              <button type="button" class="btn btn-primary" id="nextButton"><i class="bi bi-arrow-right"></i></button>
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

    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');
    const tabs = document.querySelectorAll('.nav-link');

    prevButton.addEventListener('click', () => {
      const activeTab = document.querySelector('.nav-link.active');
      if (activeTab) {
        const prevTab = activeTab.parentElement.previousElementSibling;
        if (prevTab) {
          prevTab.querySelector('.nav-link').click();
        }
      }

      // Change class for buttons
    });

    nextButton.addEventListener('click', () => {
      const activeTab = document.querySelector('.nav-link.active');
      if (activeTab) {
        const nextTab = activeTab.parentElement.nextElementSibling;
        if (nextTab) {
          nextTab.querySelector('.nav-link').click();
        }
      }

    });

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        const activeTab = document.querySelector('.nav-link.active');
        if (activeTab) {
          activeTab.classList.remove('active');
        }
        tab.classList.add('active');
      });
    });



    let newFarmInput = `
    <h5 class="card-title ms-3">Parcel</h5>
      <div class="card-body">
            <div class="row">
             <h6 class="mt-2 me-3">Owner Information <span class="text-danger">*</span></h6>
                <div class="col-md-4 mt-1">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="" placeholder="" required>
                        <label for="floatingOFname">Owner First Name</label>
                        <div class="invalid-feedback">Please enter.</div>
                    </div>
                </div>
                <div class="col-md-4 mt-1">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="" placeholder="" required>
                        <label for="floatingOLname">Owner Last Name</label>
                        <div class="invalid-feedback">Please enter.</div>
                    </div>
                </div>
                <div class="col-md-4 mt-1" style="margin-top: -11px;">
                    <label for="validationCustom11" class="form-label">Ownership Type<span class="red-star">*</span></label>
                    <select class="form-select" id="" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="Tenant">Tenant</option>
                        <option value="Registered Owner">Registered Owner</option>
                        <option value="Lesse">Lesse</option>
                        <option value="Others">Others</option>
                    </select>
                    <div class="invalid-feedback">Please select.</div>
                </div>
                <h6 class="mt-2">Farm Location<span class="red-star">*</span></h6>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control validationCustom06" id="" placeholder="" required>
                        <label for="validationCustom06">Barangay</label>
                        <div class="invalid-feedback">Please enter.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control validationCustom07" id="" placeholder="" required>
                        <label for="validationCustom07">Municipality</label>
                        <div class="invalid-feedback">Please enter.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-floating">
                        <input type="text" class="form-control validationCustom08" id="" placeholder="" required>
                        <label for="validationCustom08">Province</label>
                        <div class="invalid-feedback">Please enter.</div>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <label>Farm Size</label>
                    <input type="number" placeholder="In hectares" class="form-control farmSize no-spin-button" required>
                </div>
                <div class="col-md-4 mt-3">
                    <label for="farmType" class="form-label">Farm Type<span class="red-star">*</span></label>
                    <select class="form-select" id="" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="IRRIGATED">Irrigated</option>
                        <option value="UPLAND">Rainfed Upland</option>
                        <option value="LOWLAND">Rainfed Lowland</option>
                    </select>
                    <div class="invalid-feedback">Please select.</div>
                </div>
            </div>

                <div class="form-group">
                    <label>Crops</label>
                    <div class="dynamic-input " id="cropsContainer"></div>
                    <div class="d-flex justify-content-end mb-2">
                    <a type="button" class="btn btn-primary text-end addCropButton">Add Crop</a>
                    </div>
                </div>
                <div class="form-group">
                    <label>Livestock</label>
                    <div class="dynamic-input" id="livestockContainer"></div>
                    <div class="d-flex justify-content-end mb-2">
                    <a type="button" class="btn btn-primary addLivestockButton">Add Livestock</a>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                <a class="btn btn-danger remove-farm">Remove Farm</a>
                </div>

            </div>
  `;

    let newLivestockInput = `
      <div class="col-md-6 mb-3">
          <input type="number" placeholder="Number of heads" class="form-control no-spin-button" required max="9999999999" min="0" step="1">
          <div class="invalid-feedback">Please enter.</div>
      </div>
      <div class="col-md-6 mb-3">
          <div class="input-group mb-2">
              <input type="text" class="form-control livestock" placeholder="Enter animal type" required>
              <div class="input-group-append">
                  <a class="btn btn-danger removeLivestockButton">Remove</a>
              </div>
          </div>
      </div>
  `;

    let newCropInput = `
      <div class="col-md-3 mb-3 mt-3 d-flex align-items-center">
          <label class="form-check-label" for="hvc">High value crop?</label>
          <div class="form-check ms-2">
              <input class="form-check-input crop" style="width: 2rem; height: 2rem;" type="checkbox" id="">
          </div>
      </div>
      <div class="col-md-5 mb-3">
          <label class="ms-1">Crop Area</label>
          <input id="" type="number" placeholder="In hectares" class="form-control crop farmSize no-spin-button" required>
      </div>
      <div class="col-md-2 mb-3">
          <label>Classification</label>
          <input type="number" class="form-control crop farmSize no-spin-button" required>
      </div>
      <div class="d-flex justify-content-end col-md-2 mb-3 mt-4">
          <a class="btn btn-danger removeCropButton">Remove</a>
      </div>
  `;

    document.getElementById('addFarmButton').addEventListener('click', function() {
      const farmContainer = document.getElementById('farmContainer');

      // Create a new farm input card
      const newFarmCard = document.createElement('div');
      newFarmCard.className = 'card my-2';
      newFarmCard.innerHTML = newFarmInput;

      // Append the new card to the container
      farmContainer.appendChild(newFarmCard);

      entryFade(newFarmCard);

      // Add event listeners for adding crops and livestock
      newFarmCard.querySelector('.addCropButton').addEventListener('click', function() {
        const cropsContainer = newFarmCard.querySelector('#cropsContainer');
        const cropInputDiv = document.createElement('div');
        cropInputDiv.className = 'row dynamic-input my-2 p-2';
        cropInputDiv.style.boxShadow = "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
        cropInputDiv.innerHTML = newCropInput;
        cropsContainer.appendChild(cropInputDiv);
        entryFade(cropInputDiv);

        // Add event listener for the remove button
        cropInputDiv.querySelector('.removeCropButton').addEventListener('click', function() {
          removalFade(cropInputDiv);
          setTimeout(() => {
            cropsContainer.removeChild(cropInputDiv);
          }, 250);
        });
      });

      newFarmCard.querySelector('.addLivestockButton').addEventListener('click', function() {
        const livestockContainer = newFarmCard.querySelector('#livestockContainer');
        const livestockInputDiv = document.createElement('div');
        livestockInputDiv.className = 'row dynamic-input mt-2 px-2 pt-3 mb-2';
        livestockInputDiv.style.boxShadow = "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
        livestockInputDiv.innerHTML = newLivestockInput;
        livestockContainer.appendChild(livestockInputDiv);
        entryFade(livestockInputDiv);

        // Add event listener for the remove button
        livestockInputDiv.querySelector('.removeLivestockButton').addEventListener('click', function() {
          removalFade(livestockInputDiv);
          setTimeout(() => {
            livestockContainer.removeChild(livestockInputDiv);
          }, 250);

        });
      });

      // Add event listener to the remove farm button
      newFarmCard.querySelector('.remove-farm').addEventListener('click', function() {
        removalFade(newFarmCard);
        setTimeout(() => {
          farmContainer.removeChild(newFarmCard);
        }, 250);

      });
    });

    // document.getElementById('submitFarmsButton').addEventListener('click', function(e) {
    //     e.preventDefault();
    //     const farms = [];
    //     const farmCards = document.querySelectorAll('#farmContainer .card');

    //     farmCards.forEach(card => {
    //         const farmName = card.querySelector('.farmName').value;
    //         const farmLocation = card.querySelector('.farmLocation').value;

    //         // Collect crops
    //         const cropsInputs = card.querySelectorAll('.cropInput');
    //         const crops = Array.from(cropsInputs).map(input => input.value.trim()).filter(value => value);

    //         // Collect livestock
    //         const livestockInputs = card.querySelectorAll('.livestockInput');
    //         const livestock = Array.from(livestockInputs).map(input => input.value.trim()).filter(value => value);

    //         farms.push({ 
    //             name: farmName, 
    //             location: farmLocation,
    //             crops: crops,
    //             livestock: livestock
    //         });
    //     });

    //     document.getElementById('farmsData').value = JSON.stringify(farms);
    //     document.getElementById('farmForm').submit();
    // });
  </script>

  <?php
  // PHP part to handle form submission
  // if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //     // Database connection
  //     $conn = new mysqli('localhost', 'root', '', 'your_database');

  //     // Check connection
  //     if ($conn->connect_error) {
  //         die("Connection failed: " . $conn->connect_error);
  //     }

  //     $farms = json_decode($_POST['farms_data'], true);

  //     foreach ($farms as $farm) {
  //         $name = $conn->real_escape_string($farm['name']);
  //         $location = $conn->real_escape_string($farm['location']);
  //         $crops = $conn->real_escape_string(implode(',', $farm['crops']));
  //         $livestock = $conn->real_escape_string(implode(',', $farm['livestock']));

  //         // Insert farm into the database
  //         $sql = "INSERT INTO farms (name, location, crops, livestock) VALUES ('$name', '$location', '$crops', '$livestock')";
  //         if (!$conn->query($sql)) {
  //             echo "Error: " . $conn->error;
  //         }
  //     }

  //     $conn->close();
  // }
  ?>

  </script>


</body>

</html>