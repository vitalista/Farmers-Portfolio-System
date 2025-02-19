document.getElementById('addFarmButton').addEventListener('click', function() {
  farmCounter++;
  const farmContainer = document.getElementById('farmContainer');

  // Create a new farm input card
  const newFarmCard = document.createElement('div');
  newFarmCard.className = 'card my-2';
  newFarmCard.innerHTML = `
  <div class="d-flex justify-content-between align-items-center">
    <!-- Title on the left -->
    <div><h5 class="card-title ms-3 mb-0">Parcel #${farmCounter}</h5></div>

    <!-- Remove button on the right -->
    <div class="me-2"><a class="btn btn-sm btn-danger remove-farm"><i class="fa-solid fa-x"></i></a></div>
  </div>
    
      <div class="card-body">
    <input type="hidden" class="parcelNum" value="${farmCounter}" style="width: 100%;">
        <div class="row">
         <h6 class="mt-2 me-3">Owner Information</h6>
            <div class="col-md-4 mt-1">
                <div class="form-floating">
                    <input type="text" class="form-control ofName" id="" placeholder="" required>
                    <label>Owner First Name</label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-4 mt-1">
                <div class="form-floating">
                    <input type="text" class="form-control olName" id="" placeholder="" required>
                    <label>Owner Last Name</label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-4 mt-1" style="margin-top: -11px;">
                <label class="form-label">Ownership Type</label>
                <select class="form-select ownership" id="" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="Tenant">Tenant</option>
                    <option value="Registered Owner">Registered Owner</option>
                    <option value="Lesse">Lesse</option>
                    <option value="Others">Others</option>
                </select>
                <div class="invalid-feedback">Please select.</div>
            </div>
            <h6 class="mt-2">Farm Location</h6>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control validationCustom06 farmLocationBrgy" id="" placeholder="" required>
                    <label>Barangay<span class="text-danger fw-bold">*</span></label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control validationCustom07 farmLocationMunicipality" id="" placeholder="" required>
                    <label>Municipality<span class="text-danger fw-bold">*</span></label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control validationCustom08 farmLocationProvince" id="" placeholder="" required>
                    <label>Province<span class="text-danger fw-bold">*</span></label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <label>Farm Size</label>
                <input type="number" placeholder="In hectares" class="form-control farmSize no-spin-button" required>
            </div>
            <div class="col-md-4 mt-3">
                <label class="form-label">Farm Type</label>
                <select class="form-select farmType" id="" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="IRRIGATED">Irrigated</option>
                    <option value="RAINFED UPLAND">Rainfed Upland</option>
                    <option value="RAINFED LOWLAND">Rainfed Lowland</option>
                </select>
                <div class="invalid-feedback">Please select.</div>
            </div>

        </div>

            <div class="form-group">
                 <div class="d-flex align-items-center">
                                                <i class="fa fa-pagelines" style="font-size: 30px;color: rgb(29,140,20);"></i>
                                                <h5 class="card-title ms-3 mb-0">Crops</h5>
                                                </div>
                <div class="dynamic-input " id="cropsContainer"></div>
                <div class="d-flex justify-content-end mb-2">
                <a type="button" class="btn btn-sm btn-primary text-end addCropButton"><i class="fa-solid fa-plus"></i> Crop</a>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group" id="livestockContainer">
                                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-cow" style="font-size: 30px;color: brown"></i>
                                    <h5 class="card-title ms-3 mb-0">Livestocks</h5>

                                                </div>    
                <div class="dynamic-input" id="livestockContainer"></div>
                <div class="d-flex justify-content-end mb-2">
                <a type="button" class="btn btn-sm btn-primary addLivestockButton"><i class="fa-solid fa-plus"></i> Livestock</a>
                </div>
            </div>

        </div>
  `;

  // Append the new card to the container
  farmContainer.appendChild(newFarmCard);

 // entryFade(newFarmCard);

  const parcelTitle = newFarmCard.querySelector('.card-title.ms-3').textContent;
  const farmNumber = parseInt(parcelTitle.replace('Parcel #', '').trim());
  console.log(farmNumber);

  // Add event listeners for adding crops and livestock
  newFarmCard.querySelector('.addCropButton').addEventListener('click', function() {
    const cropsContainer = newFarmCard.querySelector('#cropsContainer');
    const cropInputDiv = document.createElement('div');
    cropInputDiv.className = 'row dynamic-input my-2 p-2';
    cropInputDiv.style.boxShadow = "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    cropInputDiv.innerHTML = `

        <div class="col-md-3 mb-3">
            <label class="ms-1">Crop Name<span class="text-danger fw-bold">*</span></label>
            <input id="" type="text" placeholder="Type here..." class="form-control crop cropName" required>
        </div>

        <div class="col-md-2 mb-3">
            <label class="ms-1">Crop Area<span class="text-danger fw-bold">*</span></label>
            <input id="" type="number" placeholder="In hectares" class="form-control crop cropArea no-spin-button" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>Classification<span class="text-danger fw-bold">*</span></label>
            <input type="number" class="form-control crop no-spin-button classification" required>
        </div>

        <div class="col-md-3 mb-3 mt-3 d-flex align-items-center">
            <label class="form-check-label">High value crop?</label>
            <div class="form-check ms-2">
              <input class="form-check-input crop hvc" style="width: 2rem; height: 2rem;" type="checkbox" id="">
            <input type="hidden" class="parcelNum" value="${farmNumber}" style="width: 100%;">
            </div>
        </div>

        <div class="d-flex justify-content-end col-md-2 align-items-center">
        <div>
            <a class="btn btn-sm btn-danger removeCropButton"><i class="fa-solid fa-trash-can"></i></a>
        </div>
        </div>
    `;
    cropsContainer.appendChild(cropInputDiv);
    //entryFade(cropInputDiv);

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
    livestockInputDiv.innerHTML = `
  <div class="col-md-6 mb-3">
      <label>Number of heads<span class="text-danger fw-bold">*</span></label>
      <input type="number" placeholder="Number of heads" class="form-control no-spin-button numberOfHeads" required max="9999999999" min="0" step="1">
      <input type="hidden" class="parcelNum" value="${farmNumber}" style="width: 100%;">
      <div class="invalid-feedback">Please enter.</div>
  </div>
  <div class="col-md-6 mb-3">
  <div class="form-group">
    <label for="livestockType">Animal type<span class="text-danger fw-bold">*</span></label>
    <div class="input-group">
      <input type="text" id="livestockType" class="form-control livestockType" placeholder="Enter animal type" required>
      <div class="input-group-append">
        <a class="btn btn-sm btn-danger removeLivestockButton mt-1"><i class="fa-solid fa-trash-can"></i></a>
      </div>
    </div>
  </div>
</div>

  `;
    livestockContainer.appendChild(livestockInputDiv);
    //entryFade(livestockInputDiv);

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

    const cardTitles = document.querySelectorAll('.card-title.ms-3');
    let maxFarmCounter = -1;
    let targetFarmCard = null;
  
    cardTitles.forEach(cardTitle => {
      const match = cardTitle.innerText.match(/Parcel #(\d+)/);
      if (match) {
        const farmCounter = parseInt(match[1], 10);
        if (farmCounter > maxFarmCounter) {
          maxFarmCounter = farmCounter;
          targetFarmCard = cardTitle.closest('.card');
        }
      }
    });
  
    // If the highest Parcel card is found, remove it
    if (targetFarmCard) {
      removalFade(targetFarmCard); // Apply the fade effect to the target card
      setTimeout(() => {
        farmCounter = farmCounter - 1;
        farmContainer.removeChild(targetFarmCard); // Remove the parent div of the highest farmCounter
      }, 250);
    }

    // removalFade(newFarmCard);
    // setTimeout(() => {
    //   farmContainer.removeChild(newFarmCard);
    // }, 250);

  });
});

function transferFile(srcInput, destInput) {
  const selectedFile = srcInput.files[0];

  if (selectedFile) {
    const reader = new FileReader();

    // When the file is read, transfer it to the destination input
    reader.onload = (event) => {
      const file = new File([event.target.result], selectedFile.name, { type: selectedFile.type });

      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(file);

      destInput.files = dataTransfer.files;
    };

    // Read the file as an array buffer
    reader.readAsArrayBuffer(selectedFile);
  }
}

document.getElementById('submitFarmsButton').addEventListener('click', function(e) {

  transferFile(document.getElementById('farmerImg'), document.getElementById('farmerImg1'));
  transferFile(document.getElementById('govIdPhotoFront'), document.getElementById('govIdPhotoFront1'));
  transferFile(document.getElementById('govIdPhotoBack'), document.getElementById('govIdPhotoBack1'));
  
  e.preventDefault();
  const farms = [];
  const farmCards = document.querySelectorAll('#farmContainer .card .card-body');
  const livestockCards = document.querySelectorAll('#livestockContainer .row');
  const cropCards = document.querySelectorAll('#cropsContainer .row');
  const card = document.querySelector('#farmerCard .card-body');

  let farmer_id = '';

  if (card.querySelector('.farmer_id')) {
    farmer_id = card.querySelector('.farmer_id').value;
    console.log(`Farmer exists! ${farmer_id}`);
  }else{
    console.log('Class not exists!');
  }

  const ffrs = card.querySelector('.ffrs').value;
  const brgy = card.querySelector('.brgy').value;
  const municipality = card.querySelector('.municipality').value;
  const province = card.querySelector('.province').value;
  const firstName = card.querySelector('.firstName').value;
  const middleName = card.querySelector('.middleName').value;
  const lastName = card.querySelector('.lastName').value;
  const extName = card.querySelector('.extName').value;
  const gender = card.querySelector('.gender').value;
  const bday = card.querySelector('.bday').value;
  const deceased = card.querySelector('.deceased').checked ? 1 : 0;

  const govIdType = card.querySelector('.govIdType').value;
  const govIdNumber = card.querySelector('.govIdNumber').value;
  const hbp = card.querySelector('.hbp').value;
  const sss = card.querySelector('.sss').value;
  const region = card.querySelector('.region').value;

  // Select all input elements with the class 'parcelNum' and type 'hidden'
const hiddenInputs = document.querySelectorAll('input[type="hidden"].parcelNum');

// Initialize a variable to store the largest number
let num_of_parcels = 0;

// Loop through each input element
hiddenInputs.forEach(input => {
  // Parse the value as an integer and compare with the current num_of_parcels
  const farmNumber = parseInt(input.value, 10);
  
  // Update num_of_parcels if the current farmNumber is larger
  if (farmNumber > num_of_parcels) {
    num_of_parcels = farmNumber;
  }
});

// Log the largest number found
console.log("Largest farm number:", num_of_parcels);


  if (card.querySelector('.farmer_id')) {
    if (farmCards.length <= 0 || farmCards.length > 0) {
      farms.push({
        farmer: {
          num_of_parcels,
          farmer_id,
          ffrs,
          brgy,
          municipality,
          province,
          firstName,
          middleName,
          lastName,
          extName,
          gender,
          bday,
          deceased,
          govIdNumber,
          govIdType,
          sss,
          hbp,
          region
        }
      });
    }
  }else{
    if (farmCards.length <= 0 || farmCards.length > 0) {
      farms.push({
        farmer: {
          num_of_parcels,
          ffrs,
          brgy,
          municipality,
          province,
          firstName,
          middleName,
          lastName,
          extName,
          gender,
          bday,
          deceased,
          govIdNumber,
          govIdType,
          sss,
          hbp,
          region
        }
      });
    }
  }

  if (farmCards.length > 0) {
    farmCards.forEach(card => {
      const ofName = card.querySelector('.ofName').value;
      const olName = card.querySelector('.olName').value;
      const ownership = card.querySelector('.ownership').value;
      const farmLocationBrgy = card.querySelector('.farmLocationBrgy').value;
      const farmLocationMunicipality = card.querySelector('.farmLocationMunicipality').value;
      const farmLocationProvince = card.querySelector('.farmLocationProvince').value;
      const farmType = card.querySelector('.farmType').value;
      const farmSize = card.querySelector('.farmSize').value;
      const parcelNum = parseInt(card.querySelector('.parcelNum').value, 10);

      let parcel_id = '';

      if (card.querySelector('.parcel_id')) {
        parcel_id = card.querySelector('.parcel_id').value;
          console.log(`Farm exists! ${parcel_id}`);
      }else{
        console.log('Class not exists!');
      }

      if (card.querySelector('.parcel_id')) {    
      farms.push({
        parcel: {
          parcel_id,
          parcelNum,
          ofName,
          olName,
          ownership,
          farmLocationBrgy,
          farmLocationMunicipality,
          farmLocationProvince,
          farmSize,
          farmType
        },
      });

    }else{
      farms.push({
        parcel: {
          parcelNum,
          ofName,
          olName,
          ownership,
          farmLocationBrgy,
          farmLocationMunicipality,
          farmLocationProvince,
          farmSize,
          farmType
        },
      });
    }

    });
  }

  if (cropCards.length > 0) {
    cropCards.forEach(card => {
      const parcelNum = card.querySelector('.parcelNum').value;
      const hvc = card.querySelector('.hvc').checked ? 1 : 0;
      const cropArea = card.querySelector('.cropArea').value;
      const cropName = card.querySelector('.cropName').value;
      const classification = parseInt(card.querySelector('.classification').value);


  let crop_id = '';
  if (card.querySelector('.crop_id')) {
    crop_id = card.querySelector('.crop_id').value;
    console.log(`Crop exists! ${crop_id}`);
  }else{
    console.log('Class not exists!');
  }

  if (card.querySelector('.crop_id')) {
    farms.push({
      crop: {
        crop_id,
        parcelNum,
        hvc,
        cropArea,
        cropName,
        classification
      }
    });
  }else{
    farms.push({
      crop: {
        parcelNum,
        hvc,
        cropArea,
        cropName,
        classification
      }
    });
  }

    });
  }

  if (livestockCards.length > 0) {
    livestockCards.forEach(card => {
      const parcelNum = card.querySelector('.parcelNum').value;
      const numberOfHeads = parseInt(card.querySelector('.numberOfHeads').value);
      const livestockType = card.querySelector('.livestockType').value;

  let livestock_id = '';

  if (card.querySelector('.livestock_id')) {
    livestock_id = card.querySelector('.livestock_id').value;
    console.log(`LS exists! ${livestock_id}`);
  }else{
    console.log('Class not exists!');
  }

  if (card.querySelector('.livestock_id')) {
    farms.push({
      livestock: {
        livestock_id,
        parcelNum,
        numberOfHeads,
        livestockType
      }
    });
  }else{
    farms.push({
      livestock: {
        parcelNum,
        numberOfHeads,
        livestockType
      }
    });
  }

    });
  }

  document.getElementById('farmsData').value = JSON.stringify(farms);
  console.log(farms);
  document.getElementById('farmForm').submit();
});


const prevButton = document.getElementById('prevButton');
const nextButton = document.getElementById('nextButton');
const tabs = document.querySelectorAll('.nav-link');

prevButton.addEventListener('click', () => {
  const activeTab = document.querySelector('.nav-link.active');
  if (activeTab) {
    const prevTab = activeTab.parentElement.previousElementSibling;
    if (prevTab) {
      prevTab.querySelector('.nav-link').click();
      updateButtonStates();
    }
  }
});

nextButton.addEventListener('click', () => {
  const activeTab = document.querySelector('.nav-link.active');
  if (activeTab) {
    const nextTab = activeTab.parentElement.nextElementSibling;
    if (nextTab) {
      nextTab.querySelector('.nav-link').click();
      updateButtonStates();
    }
  }
});

// Optionally, set initial states of buttons (disabled/enabled based on the active tab position)
function updateButtonStates() {
  const activeTab = document.querySelector('.nav-link.active');
  const firstTab = document.querySelector('.nav-item:first-child .nav-link');
  const lastTab = document.querySelector('.nav-item:last-child .nav-link');
  
  // Disable prevButton if we're on the first tab
  if (activeTab === firstTab) {
    prevButton.disabled = true;
  } else {
    prevButton.disabled = false;
  }

  // Disable nextButton if we're on the last tab
  if (activeTab === lastTab) {
    nextButton.disabled = true;
  } else {
    nextButton.disabled = false;
  }
}

// Initialize the button states when the page loads
document.addEventListener('DOMContentLoaded', updateButtonStates);

// Keyboard arrow navigation (left and right)
document.addEventListener('keydown', (event) => {
  if (event.key === 'ArrowLeft') {
    // Left arrow (previous)
    prevButton.click();
  } else if (event.key === 'ArrowRight') {
    // Right arrow (next)
    nextButton.click();
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

function previewImage() {
  const fileInput = document.getElementById('farmerImg');
  const imgElement = document.getElementById('farmerImage');

  const file = fileInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function(event) {
      imgElement.src = event.target.result;
    };
    reader.readAsDataURL(file);
  }
}


// Function to handle image preview
function handleImagePreview(fileInputId, previewContainerId, previewImageId) {
    // Get the file input, preview container, and image elements by their IDs
    const fileInput = document.getElementById(fileInputId);
    const previewContainer = document.getElementById(previewContainerId);
    const previewImage = document.getElementById(previewImageId);

    // Listen for the change event on the file input
    fileInput.addEventListener('change', function (event) {
        const file = event.target.files[0];  // Get the selected file

        // Check if the file is an image
        if (file && file.type.startsWith('image')) {
            const reader = new FileReader();

            // When the file is successfully read
            reader.onload = function (e) {
                previewImage.src = e.target.result;  // Set the preview image source
                previewContainer.style.display = 'block';  // Show the preview container
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