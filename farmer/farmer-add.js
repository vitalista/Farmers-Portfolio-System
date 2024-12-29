

document.getElementById('addFarmButton').addEventListener('click', function() {
  farmCounter++;
  const farmContainer = document.getElementById('farmContainer');

  // Create a new farm input card
  const newFarmCard = document.createElement('div');
  newFarmCard.className = 'card my-2';
  newFarmCard.innerHTML = `
    <h5 class="card-title ms-3">Parcel #${farmCounter}</h5>
      <div class="card-body">
    <input type="hidden" class="parcelNum" value="${farmCounter}" style="width: 100%;">
        <div class="row">
         <h6 class="mt-2 me-3">Owner Information <span class="text-danger">*</span></h6>
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
                <label class="form-label">Ownership Type<span class="red-star">*</span></label>
                <select class="form-select ownership" id="" required>
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
                    <input type="text" class="form-control validationCustom06 farmLocationBrgy" id="" placeholder="" required>
                    <label>Barangay</label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control validationCustom07 farmLocationMunicipality" id="" placeholder="" required>
                    <label>Municipality</label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control validationCustom08 farmLocationProvince" id="" placeholder="" required>
                    <label>Province</label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-3 mt-4">
                <label>Farm Size</label>
                <input type="number" placeholder="In hectares" class="form-control farmSize no-spin-button" required>
            </div>
            <div class="col-md-4 mt-3">
                <label class="form-label">Farm Type<span class="red-star">*</span></label>
                <select class="form-select farmType" id="" required>
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

  // Append the new card to the container
  farmContainer.appendChild(newFarmCard);

  entryFade(newFarmCard);

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
        <div class="col-md-3 mb-3 mt-3 d-flex align-items-center">
            <label class="form-check-label">High value crop?</label>
            <div class="form-check ms-2">
              <input class="form-check-input crop hvc" style="width: 2rem; height: 2rem;" type="checkbox" id="">
            <input type="hidden" class="parcelNum" value="${farmNumber}" style="width: 100%;">
            </div>
        </div>
        <div class="col-md-5 mb-3">
            <label class="ms-1">Crop Area</label>
            <input id="" type="number" placeholder="In hectares" class="form-control crop cropArea no-spin-button" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>Classification</label>
            <input type="number" class="form-control crop no-spin-button classification" required>
        </div>
        <div class="d-flex justify-content-end col-md-2 mb-3 mt-4">
            <a class="btn btn-danger removeCropButton">Remove</a>
        </div>
    `;
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
    livestockInputDiv.innerHTML = `
  <div class="col-md-6 mb-3">
      <input type="number" placeholder="Number of heads" class="form-control no-spin-button numberOfHeads" required max="9999999999" min="0" step="1">
      <input type="hidden" class="parcelNum" value="${farmNumber}" style="width: 100%;">
      <div class="invalid-feedback">Please enter.</div>
  </div>
  <div class="col-md-6 mb-3">
      <div class="input-group mb-2">
          <input type="text" class="form-control livestockType" placeholder="Enter animal type" required>
          <div class="input-group-append">
              <a class="btn btn-danger removeLivestockButton">Remove</a>
          </div>
      </div>
  </div>
  `;
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

document.getElementById('submitFarmsButton').addEventListener('click', function(e) {
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
  const deceased = card.querySelector('.deceased').checked;
  const active = card.querySelector('.active').checked;

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
          active
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
          active
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
      const farmSize = card.querySelector('.farmSize').value;
      const farmType = card.querySelector('.farmType').value;

      const parcelNum = card.querySelector('.parcelNum').value;

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
      const hvc = card.querySelector('.hvc').checked;
      const cropArea = card.querySelector('.cropArea').value;
      const classification = card.querySelector('.classification').value;


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
        classification
      }
    });
  }else{
    farms.push({
      crop: {
        parcelNum,
        hvc,
        cropArea,
        classification
      }
    });
  }

    });
  }

  if (livestockCards.length > 0) {
    livestockCards.forEach(card => {
      const parcelNum = card.querySelector('.parcelNum').value;
      const numberOfHeads = card.querySelector('.numberOfHeads').value;
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
