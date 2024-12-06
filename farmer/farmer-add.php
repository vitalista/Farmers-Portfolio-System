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
              <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Add Farmer</h5>
                <div>
                  <a onclick="window.history.back()" class="btn btn-primary">Back</a>
                </div>
              </div>

              <!-- Default Tabs -->
              <!-- <form class="needs-validation" id="farmForm" novalidate> -->
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

                  <div class="card" id="farmerCard">
                    <div class="card-body row g-3">

                      <h6 class="mt-5">Registration Code
                        <!-- <span class="red-star">*</span> -->
                      </h6>

                      <div class="d-none col-md-6">
                        <div class="form-floating">
                          <input type="text" class="form-control" id="lgu" placeholder="" required>
                          <label for="lgu">LGU REFERENCE CODE</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-floating">
                          <input type="text" class="form-control ffrs" id="ffrs" placeholder="" required>
                          <label for="ffrs">FFRS SYSTEM GEN.</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <h6>Address<span class="red-star">*</span></h6>

                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control brgy" id="personalBrgy" placeholder="" required>
                          <label for="personalBrgy">BARANGAY</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control municipality" id="personalMunicipality" placeholder="" required>
                          <label for="personalMunicipality">Municipality</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control province" id="brgy" placeholder="" required>
                          <label for="brgy">Province</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <h6>Full Name<span class="red-star">*</span></h6>
                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control firstName" id="floatingFname" placeholder="" required>
                          <label for="floatingFname">First Name</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control middleName" id="floatingMname" placeholder="" required>
                          <label for="floatingMname">Middle Name</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-floating">
                          <input type="text" class="form-control lastName" id="floatingLname" placeholder="" required>
                          <label for="floatingLname">Last Name</label>
                          <div class="invalid-feedback">Please enter.</div>
                        </div>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom10" class="form-label">Extension Name</label>
                        <input type="text" class="form-control extName" id="validationCustom10">
                        <div class="invalid-feedback">Please enter.</div>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom01" class="form-label">Gender<span class="red-star">*</span></label>
                        <select class="form-select gender" id="validationCustom01" required>
                          <option selected disabled value="">Choose...</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <div class="invalid-feedback">Please select.</div>
                      </div>

                      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">Birthday<span class="red-star">*</span></label>
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

                      <div class="col-md-2 mt-4">
                        <label class="form-check-label" for="active">
                          Active?
                        </label>
                        <div class="form-check">
                          <input class="form-check-input me-2 active" style="width: 2rem; height: 2rem;" type="checkbox" required id="active">
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
                    <!-- <?php if (is_dir('../map')) { ?>
                        <style>
                          #map { height: 400px; width: 50%; margin: 0px 25%;}
                          #mapTypeControl { margin: 10px; }
                          #searchControl { margin: 10px; }
                          #saveLocation { background-color: white; border: 2px solid #ccc; padding: 5px; cursor: pointer; }
                          .map-control { background: white; padding: 10px; border-radius: 5px; margin: 10px; }
                      </style>
                      <div class="col-md-12">
                        <div id="searchControl">
                          <input id="searchBox" type="text" placeholder="Search for a location..." />
                        </div>
                        <div id="mapTypeControl">
                          <label for="mapType">Select Map Type:</label>
                          <select id="mapType">
                            <option value="roadmap">Roadmap</option>
                            <option value="satellite">Satellite</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="terrain">Terrain</option>
                          </select>
                        </div>
                        <div id="map"></div>
                      </div>
                      <?php } ?> -->
                    <div id="farmContainer" class="mt-3"></div>
                    <!-- Submit Button -->
                    <!-- Form to submit farms -->

                  </div>
                </div>
                <!-- Farm Profile Information -->
              </div>
              <!-- </div> -->


              <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-secondary me-2">Reset</button>
                <button type="submit" id="submitFarmsButton" class="btn btn-success me-2">Save</button>
              </div>

              <form class="needs-validation" method="POST" action="farmer-add-code.php" id="farmForm" novalidate>
                <input type="hidden" name="farms_data" id="farmsData" style="width: 100%;">
              </form>

              <div class="d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-primary  me-1" id="prevButton"><i class="bi bi-arrow-left"></i></button>
                <button type="button" class="btn btn-primary" id="nextButton"><i class="bi bi-arrow-right"></i></button>
              </div>
              <!-- </form> -->

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>

  <script src="./farmer-add.js"></script>
  <!-- Google Map Script -->
  <!-- <script>
    let map;
    let marker;
    let coords = {};
    let searchBox;

    async function initMap() {
      // Initialize the map
      map = new google.maps.Map(document.getElementById('map'), {
        center: {
          lat: 14.958642678369692,
          lng: 120.88960343561189
        },
        zoom: 8,
      });

      // Create a search box
      searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(document.getElementById('searchBox'));

      // Bias the SearchBox results towards current map's viewport
      map.addListener('bounds_changed', () => {
        searchBox.setBounds(map.getBounds());
      });

      // Listen for the event when a user selects a prediction from the dropdown
      searchBox.addListener('places_changed', () => {
        const places = searchBox.getPlaces();

        if (places.length === 0) {
          return;
        }

        // Clear out the old markers
        if (marker) {
          marker.setMap(null);
        }

        // Get the first place
        const place = places[0];
        const location = place.geometry.location;

        // Center the map on the selected place
        map.setCenter(location);
        map.setZoom(14); // Zoom in

        // Create a new marker
        marker = new google.maps.Marker({
          position: location,
          map: map,
        });

        // Store coordinates
        coords = {
          lat: location.lat(),
          lng: location.lng()
        };
      });

      // Click event on the map to place a marker
      map.addListener('click', (event) => {
        if (marker) marker.setMap(null);
        marker = new google.maps.Marker({
          position: event.latLng,
          map: map,
        });
        coords = {
          lat: event.latLng.lat(),
          lng: event.latLng.lng()
        };
      });

      // Create the Save Location button
      const saveButton = document.createElement('button');
      saveButton.innerHTML = 'Save Location';
      saveButton.id = 'saveLocation';
      saveButton.onclick = async () => {
        try {
          const response = await fetch('../backend/save_location.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify(coords),
          });

          const data = await response.json();
          alert(data.message);
        } catch (error) {
          console.error('Error:', error);
          alert('There was an error saving the location.');
        }
      };

      // Add the button to the map
      map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(saveButton);

      // Layer control
      const mapTypeSelector = document.getElementById('mapType');
      mapTypeSelector.addEventListener('change', function() {
        const selectedType = mapTypeSelector.value;
        map.setMapTypeId(selectedType);
      });
    }

    window.onload = initMap;
  </script> -->


</body>

</html>