<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php'; ?>

<body class="login-bg">

    <?php include 'registration-header.php'; ?>
    <?php include 'registration-sidebar.php'; ?>

    <main id="main" class="main">
        <div class="content">
            <div class="container" id="farmerCard">
                <div class="card shadow-sm m-2 shadow">
                    <div style="background-color: #99e7cf;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="text-dark">Farmer's Registration</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <fieldset class="mb-3 mt-4">
                                    <legend class="fw-bold">Enrollment Type</legend>
                                    <div class="form-check">
                                        <input type="radio" id="new" name="enrollment" value="NEW" class="form-check-input" checked onclick="toggleReferenceNumber()">
                                        <label class="form-check-label" for="new">New</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" id="update" name="enrollment" value="UPDATING" class="form-check-input" onclick="toggleReferenceNumber()">
                                        <label class="form-check-label" for="update">Updating</label>
                                    </div>
                                </fieldset>
                                <fieldset class="reference-number" style="display: none;">
                                    <label class="fw-bold">Reference Number</label>
                                    <a href="https://finder-rsbsa.da.gov.ph/" class="text-success">find your rsbsa here.</a>
                                    <div class="d-flex form-group mb-3">
                                        <input class="form-control ffrs" type="number" placeholder="Region">
                                        <input class="form-control ffrs" type="number" placeholder="Province">
                                        <input class="form-control ffrs" type="number" placeholder="City">
                                        <input class="form-control ffrs" type="number" placeholder="Barangay">
                                        <input class="form-control ffrs" type="number" placeholder="Other">
                                    </div>
                                </fieldset>
                            </div>
                            <script>
                                function toggleReferenceNumber() {
                                    const referenceNumberFieldset = document.querySelector('.reference-number');
                                    const enrollmentType = document.querySelector('input[name="enrollment"]:checked').value;
                                    if (enrollmentType === 'NEW') {
                                        referenceNumberFieldset.style.display = 'none';
                                    } else {
                                        referenceNumberFieldset.style.display = 'block';
                                    }
                                }
                                // Initialize the display state on page load
                                document.addEventListener('DOMContentLoaded', toggleReferenceNumber);
                            </script>
                            <div class="col-md-6">
                                <div class="text-center mb-3">
                                    <img id="farmerImage" class="rounded-circle mb-2"
                                        style="background-color: seagreen; padding: 10px;" src="../assets/img/farmer.png"
                                        height="150" alt="Farmer">
                                    <div class="mb-3">
                                        <input type="file" class="form-control" accept="image/*" id="farmerImg"
                                            onchange="previewImage()">
                                        <small class="text-muted">Photo taken within 6 months</small>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function previewImage() {
                                    const fileInput = document.getElementById('farmerImg');
                                    const imgElement = document.getElementById('farmerImage');
                                    const file = fileInput.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = function(event) {
                                            imgElement.src = event.target.result; // Set the image source to the file's data URL
                                        };
                                        reader.readAsDataURL(file); // Convert the file to a data URL
                                    }
                                }
                            </script>
                        </div>
                    </div>
                    <!-- Personal Information Section -->
                    <div style="background-color: #99e7cf;"
                        class="text-dark p-2 card-header d-flex justify-content-between align-items-center"
                        data-bs-toggle="collapse" data-bs-target="#pInfoBody">
                        <h5>
                            Part I: Personal Information
                        </h5>
                        <i class="bi bi-caret-down-fill"></i>
                    </div>
                    <div class="row card-body collapsed" id="pInfoBody">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label class="fw-bold">Surname</label>
                                    <input type="text" class="form-control lastName">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="fw-bold">Midname</label>
                                    <input type="text" class="form-control middleName">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="fw-bold">Firstname</label>
                                    <input type="text" class="form-control firstName">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="fw-bold">Extname</label>
                                    <input type="text" class="form-control extName">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label class="fw-bold">Date of Birth</label>
                                    <input type="date" class="form-control bday">
                                </div>
                                <div class="mt-4 col-md-12">
                                    <label class="me-3 fw-bold">Gender</label>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="male" value="MALE" class="form-check-input" checked>
                                        <label class="form-check-label" for="male">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="gender" id="female" value="FEMALE"
                                            class="form-check-input">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="mb-3">
                                <legend class="text-emphasis-color fs-5 fw-bold">Address:</legend>
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="address1"
                                            class="form-label text-emphasis-color fs-6 fw-bold">House/BLDG/ Purok:</label>
                                        <input type="text" class="form-control hbp" id="address1">
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="address2"
                                            class="form-label text-emphasis-color fs-6 fw-bold">Street/Sitio/SubDV:</label>
                                        <input type="text" class="form-control sss" id="address2">
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="barangay"
                                            class="form-label text-emphasis-color fs-6 fw-bold">Barangay:</label>
                                        <select class="form-select brgy" id="personalBrgy" required>
                                            <option selected disabled value="">Choose...</option>
                                            <option value="Bagong Nayon">Bagong Nayon</option>
                                            <option value="Barangca">Barangca</option>
                                            <option value="Calantipay">Calantipay</option>
                                            <option value="Catulinan">Catulinan</option>
                                            <option value="Concepcion">Concepcion</option>
                                            <option value="Hinukay">Hinukay</option>
                                            <option value="Makinabang">Makinabang</option>
                                            <option value="Matangtubig">Matangtubig</option>
                                            <option value="Pagala">Pagala</option>
                                            <option value="Paitan">Paitan</option>
                                            <option value="Piel">Piel</option>
                                            <option value="Pinagbarilan">Pinagbarilan</option>
                                            <option value="Poblacion">Poblacion</option>
                                            <option value="Sabang">Sabang</option>
                                            <option value="San Jose">San Jose</option>
                                            <option value="San Roque">San Roque</option>
                                            <option value="Santa Barbara">Santa Barbara</option>
                                            <option value="Santo Cristo">Santo Cristo</option>
                                            <option value="Santo Niño">Santo Niño</option>
                                            <option value="Subic">Subic</option>
                                            <option value="Sulivan">Sulivan</option>
                                            <option value="Tangos">Tangos</option>
                                            <option value="Tarcan">Tarcan</option>
                                            <option value="Tiaong">Tiaong</option>
                                            <option value="Tibag">Tibag</option>
                                            <option value="Tilapayong">Tilapayong</option>
                                            <option value="Virgen delas Flores">Virgen delas Flores</option>
                                        </select>
                                        <div class="invalid-feedback">Please select.</div>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="municipality"
                                            class="form-label text-emphasis-color fs-6 fw-bold">Municipality/City:</label>
                                        <input type="text" class="form-control municipality" id="municipality" value="Baliwag" disabled>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="province"
                                            class="form-label text-emphasis-color fs-6 fw-bold">Province:</label>
                                        <input type="text" class="form-control province" id="province" value="Bulacan" disabled>
                                    </div>
                                    <div class="col-12 col-md-4 mb-3">
                                        <label for="region"
                                            class="form-label text-emphasis-color fs-6 fw-bold">Region:</label>
                                        <input type="text" class="form-control region" id="region" value="III" disabled>
                                    </div>
                                </div>
                            </fieldset>
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
                                        <input type="file" class="form-control" id="govIdPhotoFront" accept="image/*">
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
                                        <input type="file" class="form-control" id="govIdPhotoBack" accept="image/*">
                                        <small class="form-text text-muted">Only image files are allowed (JPEG, PNG,
                                            etc.)</small>
                                        <!-- Preview for Back ID Photo -->
                                        <div id="previewContainerBack" class="mt-3" style="display:none;">
                                            <label for="govIdPhotoBack" class="fs-6">Back Preview:</label>
                                            <img id="previewImageBack" src="" alt="Back Image Preview" class="img-fluid"
                                                style="max-height: 200px;" />
                                        </div>
                                    </div>
                                    <script>
                                        // Function to handle image preview
                                        function handleImagePreview(fileInputId, previewContainerId, previewImageId) {
                                            // Get the file input, preview container, and image elements by their IDs
                                            const fileInput = document.getElementById(fileInputId);
                                            const previewContainer = document.getElementById(previewContainerId);
                                            const previewImage = document.getElementById(previewImageId);
                                            // Listen for the change event on the file input
                                            fileInput.addEventListener('change', function(event) {
                                                const file = event.target.files[0]; // Get the selected file
                                                // Check if the file is an image
                                                if (file && file.type.startsWith('image')) {
                                                    const reader = new FileReader();
                                                    // When the file is successfully read
                                                    reader.onload = function(e) {
                                                        previewImage.src = e.target.result; // Set the preview image source
                                                        previewContainer.style.display = 'block'; // Show the preview container
                                                    };
                                                    // Read the file as a data URL
                                                    reader.readAsDataURL(file);
                                                } else {
                                                    // If the file is not an image, hide the preview container
                                                    previewContainer.style.display = 'none';
                                                }
                                            });
                                        }
                                        // Initialize preview handling for both front and back ID photos
                                        handleImagePreview('govIdPhotoFront', 'previewContainerFront', 'previewImageFront');
                                        handleImagePreview('govIdPhotoBack', 'previewContainerBack', 'previewImageBack');
                                    </script>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div style="background-color: #99e7cf;"
                        class="text-dark p-2 mt-4 card-header d-flex justify-content-between align-items-center">
                        <h5>Part II: Farm Profile</h5>
                        <button class="btn btn-success btn-icon-split" id="addFarmButton">
                            <span class="text-white-50 icon"><i class="fas fa-check"></i></span>
                            <span class="text-white">Add Parcel</span>
                        </button>
                    </div>
                    <div class="row card-body" id="fProf">
                        <div id="farmContainer"></div>
                    </div>
                    <div class="row">
                        <div class="text-center col-md-12 mt-4 mb-4 fixed-bottom">
                            <button class="btn btn-primary px-5" id="submitFarmsButton">
                                <i class="fas fa-save me-2"></i>Save
                            </button>
                        </div>
                        <!-- CAPTCHA
                        <div class="text-center col-md-6 mt-3">
                            <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY"></div>
                            <small class="text-muted">Please verify that you are not a robot</small>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include '../includes/footer.php' ?>

</body>
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="add-div.js"></script>
<script src="script.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->


</html>