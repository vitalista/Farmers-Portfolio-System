document.getElementById("addFarmButton").addEventListener("click", function () {
  farmCounter++;
  const farmContainer = document.getElementById("farmContainer");

  // Create a new farm input card
  const newFarmCard = document.createElement("div");
  newFarmCard.className = "card my-2";
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
                </select>
                <div class="invalid-feedback">Please select.</div>
            </div>
            <h6 class="mt-2">Farm Location</h6>
            <div class="col-md-4">
                <div class="form-floating">
                  <select class="form-select validationCustom06 farmLocationBrgy" id="" required>
                      <option selected disabled value="">Choose...</option>
                      <option value="Bagong Nayon" <?= $parcel['parcel_brgy_address'] == 'Bagong Nayon' ? 'selected' : ''; ?>Bagong Nayon</option>
                      <option value="Barangca" <?= $parcel['parcel_brgy_address'] == 'Barangca' ? 'selected' : ''; ?>Barangca</option>
                      <option value="Calantipay" <?= $parcel['parcel_brgy_address'] == 'Calantipay' ? 'selected' : ''; ?>Calantipay</option>
                      <option value="Catulinan" <?= $parcel['parcel_brgy_address'] == 'Catulinan' ? 'selected' : ''; ?>Catulinan</option>
                      <option value="Concepcion" <?= $parcel['parcel_brgy_address'] == 'Concepcion' ? 'selected' : ''; ?>Concepcion</option>
                      <option value="Hinukay" <?= $parcel['parcel_brgy_address'] == 'Hinukay' ? 'selected' : ''; ?>Hinukay</option>
                      <option value="Makinabang" <?= $parcel['parcel_brgy_address'] == 'Makinabang' ? 'selected' : ''; ?>Makinabang</option>
                      <option value="Matangtubig" <?= $parcel['parcel_brgy_address'] == 'Matangtubig' ? 'selected' : ''; ?>Matangtubig</option>
                      <option value="Pagala" <?= $parcel['parcel_brgy_address'] == 'Pagala' ? 'selected' : ''; ?>Pagala</option>
                      <option value="Paitan" <?= $parcel['parcel_brgy_address'] == 'Paitan' ? 'selected' : ''; ?>Paitan</option>
                      <option value="Piel" <?= $parcel['parcel_brgy_address'] == 'Piel' ? 'selected' : ''; ?>Piel</option>
                      <option value="Pinagbarilan" <?= $parcel['parcel_brgy_address'] == 'Pinagbarilan' ? 'selected' : ''; ?>Pinagbarilan</option>
                      <option value="Poblacion" <?= $parcel['parcel_brgy_address'] == 'Poblacion' ? 'selected' : ''; ?>Poblacion</option>
                      <option value="Sabang" <?= $parcel['parcel_brgy_address'] == 'Sabang' ? 'selected' : ''; ?>Sabang</option>
                      <option value="San Jose" <?= $parcel['parcel_brgy_address'] == 'San Jose' ? 'selected' : ''; ?>San Jose</option>
                      <option value="San Roque" <?= $parcel['parcel_brgy_address'] == 'San Roque' ? 'selected' : ''; ?>San Roque</option>
                      <option value="Santa Barbara" <?= $parcel['parcel_brgy_address'] == 'Santa Barbara' ? 'selected' : ''; ?>Santa Barbara</option>
                      <option value="Santo Cristo" <?= $parcel['parcel_brgy_address'] == 'Santo Cristo' ? 'selected' : ''; ?>Santo Cristo</option>
                      <option value="Santo Niño" <?= $parcel['parcel_brgy_address'] == 'Santo Niño' ? 'selected' : ''; ?>Santo Niño</option>
                      <option value="Subic" <?= $parcel['parcel_brgy_address'] == 'Subic' ? 'selected' : ''; ?>Subic</option>
                      <option value="Sulivan" <?= $parcel['parcel_brgy_address'] == 'Sulivan' ? 'selected' : ''; ?>Sulivan</option>
                      <option value="Tangos" <?= $parcel['parcel_brgy_address'] == 'Tangos' ? 'selected' : ''; ?>Tangos</option>
                      <option value="Tarcan" <?= $parcel['parcel_brgy_address'] == 'Tarcan' ? 'selected' : ''; ?>Tarcan</option>
                      <option value="Tiaong" <?= $parcel['parcel_brgy_address'] == 'Tiaong' ? 'selected' : ''; ?>Tiaong</option>
                      <option value="Tibag" <?= $parcel['parcel_brgy_address'] == 'Tibag' ? 'selected' : ''; ?>Tibag</option>
                      <option value="Tilapayong" <?= $parcel['parcel_brgy_address'] == 'Tilapayong' ? 'selected' : ''; ?>Tilapayong</option>
                      <option value="Virgen delas Flores" <?= $parcel['parcel_brgy_address'] == 'Virgen delas Flores' ? 'selected' : ''; ?>Virgen delas Flores</option>
                  </select>
                  <label>Barangay<span class="text-danger fw-bold red-star"></span></label>
                  <div class="invalid-feedback">Please enter.</div>
              </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control validationCustom07 farmLocationMunicipality" id="" placeholder="" value="Baliwag" disabled required>
                    <label>Municipality<span class="text-danger fw-bold red-star"></span></label>
                    <div class="invalid-feedback">Please enter.</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating">
                    <input type="text" class="form-control validationCustom08 farmLocationProvince" id="" placeholder="" value="Bulacan" disabled required>
                    <label>Province<span class="text-danger fw-bold red-star"></span></label>
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

  const parcelTitle = newFarmCard.querySelector(".card-title.ms-3").textContent;
  const farmNumber = parseInt(parcelTitle.replace("Parcel #", "").trim());
  console.log(farmNumber);

  // Add event listeners for adding crops and livestock
  newFarmCard
    .querySelector(".addCropButton")
    .addEventListener("click", function () {
      const cropsContainer = newFarmCard.querySelector("#cropsContainer");
      const cropInputDiv = document.createElement("div");
      cropInputDiv.className = "row dynamic-input my-2 p-2";
      cropInputDiv.style.boxShadow =
        "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
      cropInputDiv.innerHTML = `

        <div class="col-md-3 mb-3">
            <label class="ms-1">Crop Name<span class="text-danger fw-bold red-star"></span></label>
           <select id="cropName" class="form-select crop cropName" required>
            <option value="" disabled selected>Choose...</option>
            <option value="Rice/Palay">Rice/Palay</option>
            <option value="Water melon">Water melon</option>
            <option value="String beans - harvested green (sitao)">String beans - harvested green (sitao)</option>
            <option value="Patola">Patola</option>
            <option value="Okra">Okra</option>
            <option value="Eggplant (talong)">Eggplant (talong)</option>
            <option value="Batao">Batao</option>
            <option value="Pechay">Pechay</option>
            <option value="Corn">Corn</option>
            <option value="Chili (labuyo)">Chili (labuyo)</option>
            <option value="Camote">Camote</option>
            <option value="Mustard">Mustard</option>
            <option value="Mango">Mango</option>
            <option value="Tomato (kamatis)">Tomato (kamatis)</option>
            <option value="Ampalaya">Ampalaya</option>
            <option value="Long Chili">Long Chili</option>
            <option value="Mongo (Mung Bean)">Mongo (Mung Bean)</option>
            <option value="Common gourd (upo)">Common gourd (upo)</option>
            <option value="Bush Sitao">Bush Sitao</option>
            <option value="Winged Bean (pallang)">Winged Bean (pallang)</option>
            <option value="Cucumber (pipino)">Cucumber (pipino)</option>
            <option value="Squash (kalabasa)">Squash (kalabasa)</option>
            <option value="Papaya">Papaya</option>
            <option value="Onion bulbs (sibuyas)">Onion bulbs (sibuyas)</option>
            <option value="Rambutan">Rambutan</option>
            <option value="Kangkong">Kangkong</option>
            <option value="Spinach">Spinach</option>
          </select>
        </div>

        <div class="col-md-2 mb-3">
            <label class="ms-1">Crop Area<span class="text-danger fw-bold red-star"></span></label>
            <input id="" type="number" placeholder="In hectares" class="form-control crop cropArea no-spin-button" required>
        </div>
        <div class="col-md-2 mb-3">
            <label>Classification<span class="text-danger fw-bold red-star"></span></label>
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
      cropInputDiv
        .querySelector(".removeCropButton")
        .addEventListener("click", function () {
          removalFade(cropInputDiv);
          setTimeout(() => {
            cropsContainer.removeChild(cropInputDiv);
          }, 250);
        });
    });

  newFarmCard
    .querySelector(".addLivestockButton")
    .addEventListener("click", function () {
      const livestockContainer = newFarmCard.querySelector(
        "#livestockContainer"
      );
      const livestockInputDiv = document.createElement("div");
      livestockInputDiv.className = "row dynamic-input mt-2 px-2 pt-3 mb-2";
      livestockInputDiv.style.boxShadow =
        "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
      livestockInputDiv.innerHTML = `
  <div class="col-md-6 mb-3">
      <label>Number of heads<span class="text-danger fw-bold red-star"></span></label>
      <input type="number" placeholder="Type here..." class="form-control no-spin-button numberOfHeads" required max="9999999999" min="0" step="1">
      <input type="hidden" class="parcelNum" value="${farmNumber}" style="width: 100%;">
      <div class="invalid-feedback">Please enter.</div>
  </div>
  <div class="col-md-6 mb-3">
  <div class="form-group">
    <label for="livestockType">Animal type<span class="text-danger fw-bold red-star"></span></label>
    <div class="input-group">
      <select id="livestockType" class="form-select livestockType" required>
        <option value="" disabled selected>Choose...</option>
        <option value="Pigs or swine">Pigs or swine</option>
        <option value="Buffaloes (Carabaos)">Buffaloes (Carabaos)</option>
        <option value="Goats">Goats</option>
        <option value="Ducks">Ducks</option>
        <option value="Chickens">Chickens</option>
        <option value="Turkeys">Turkeys</option>
        <option value="Geese">Geese</option>
        <option value="Sheep">Sheep</option>
        <option value="Cattle">Cattle</option>
        <option value="Horses">Horses</option>
        <option value="Rabbits and hares">Rabbits and hares</option>
        <option value="Quail">Quail</option>
      </select>

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
      livestockInputDiv
        .querySelector(".removeLivestockButton")
        .addEventListener("click", function () {
          removalFade(livestockInputDiv);
          setTimeout(() => {
            livestockContainer.removeChild(livestockInputDiv);
          }, 250);
        });
    });

  // Add event listener to the remove farm button
  newFarmCard
    .querySelector(".remove-farm")
    .addEventListener("click", function () {
      const cardTitles = document.querySelectorAll(".card-title.ms-3");
      let maxFarmCounter = -1;
      let targetFarmCard = null;

      cardTitles.forEach((cardTitle) => {
        const match = cardTitle.innerText.match(/Parcel #(\d+)/);
        if (match) {
          const farmCounter = parseInt(match[1], 10);
          if (farmCounter > maxFarmCounter) {
            maxFarmCounter = farmCounter;
            targetFarmCard = cardTitle.closest(".card");
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

function emptyFields(card, idArr = [], classArr = []) {
  const parent = document.querySelector(card);
  let emptyFields = [];
  let checkClass = [];
  classArr.forEach((classId) => {
    if (parent.querySelector(`.${classId}`)) {
      checkClass.push(classId);
    }
  });

  checkClass.forEach((classId) => {
    const classElements = parent.querySelectorAll(`.${classId}`);
    if (classElements.length > 0) {
      classElements.forEach((classElement) => {
        if (!classElement || !classElement.value) {
          emptyFields.push(classId);
          classElement.style.border = "1px solid red";
        } else {
          classElement.style.border = "";
        }
      });
    } else {
      emptyFields.push(classId);
    }
  });

  idArr.forEach((id) => {
    const idElement = parent.querySelector(`#${id}`);
    if (!idElement || !idElement.value) {
      emptyFields.push(id);
      if (idElement) idElement.style.border = "1px solid red";
    } else {
      if (idElement) idElement.style.border = "";
    }
  });

  console.log(emptyFields);
  return emptyFields.length === 0 ? false : emptyFields;
}

function escapeHtml(unsafe) {
  if (unsafe === null || unsafe === undefined) return '';
  return String(unsafe).replace(/[<>/]/g, '');
}

document
  .getElementById("submitFarmsButton")
  .addEventListener("click", function (e) {
    e.preventDefault();
    const farms = [];
    const farmCards = document.querySelectorAll(
      "#farmContainer .card .card-body"
    );
    const livestockCards = document.querySelectorAll(
      "#livestockContainer .row"
    );
    const cropCards = document.querySelectorAll("#cropsContainer .row");
    const card = document.querySelector("#farmerCard .card-body");

    let idArr = [];
    let classArr = [
      "ffrs",
      "govIdType",
      "govIdNumber",
      "hbp",
      "sss",
      "region",
      "brgy",
      "municipality",
      "province",
      "firstName",
      "middleName",
      "lastName",
      "gender",
      "bday",
      "ofName",
      "olName",
      "ownership",
      "farmLocationBrgy",
      "farmLocationMunicipality",
      "farmLocationProvince",
      "farmSize",
      "farmType",
      "cropName",
      "cropArea",
      "classification",
      "numberOfHeads",
      "livestockType",
    ];
    if (window.location.pathname.includes("farmer-add.php")) {
      idArr = ['farmerImg', 'govIdPhotoBack', 'govIdPhotoFront'];
    }

    if (emptyFields(".tab-content", idArr, classArr)) {
      let message = document.createElement("div");
      message.className = "d-flex flex-wrap justify-content-start";
      const existingMessages = new Set();

      emptyFields(".tab-content", idArr, classArr).forEach((index) => {
        if (!existingMessages.has(index)) {
          existingMessages.add(index);
          const pTag = document.createElement("li");
          pTag.className = "text-danger w-100 col-md-4";

          switch (index) {
            case "farmerImg":
              pTag.textContent = "Farmer's image";
              break;
            case "govIdPhotoBack":
              pTag.textContent = "Back of the government ID";
              break;
            case "govIdPhotoFront":
              pTag.textContent = "Front of the government ID";
              break;

            case "ffrs":
              pTag.textContent = "FFRS number";
              break;
            case "govIdType":
              pTag.textContent = "Government ID type";
              break;
            case "govIdNumber":
              pTag.textContent = "Government ID number";
              break;
            case "hbp":
              pTag.textContent = "House/BLDG/Purok";
              break;
            case "sss":
              pTag.textContent = "Street/Sitio/SubDV";
              break;
            case "region":
              pTag.textContent = "Region";
              break;
            case "brgy":
              pTag.textContent = "Barangay";
              break;
            case "municipality":
              pTag.textContent = "Municipality";
              break;
            case "province":
              pTag.textContent = "Province";
              break;
            case "firstName":
              pTag.textContent = "First name";
              break;
            case "middleName":
              pTag.textContent = "Middle name";
              break;
            case "lastName":
              pTag.textContent = "Last name";
              break;
            case "gender":
              pTag.textContent = "Gender";
              break;
            case "bday":
              pTag.textContent = "Birthdate";
              break;
            case "ofName":
              pTag.textContent = "Owner's first name";
              break;
            case "olName":
              pTag.textContent = "Owner's last name";
              break;
            case "ownership":
              pTag.textContent = "Ownership type";
              break;
            case "farmLocationBrgy":
              pTag.textContent = "Farm's barangay";
              break;
            case "farmLocationMunicipality":
              pTag.textContent = "Farm's municipality";
              break;
            case "farmLocationProvince":
              pTag.textContent = "Farm's province";
              break;
            case "farmSize":
              pTag.textContent = "Farm size";
              break;
            case "farmType":
              pTag.textContent = "Farm type";
              break;
            case "cropName":
              pTag.textContent = "Crop name";
              break;
            case "cropArea":
              pTag.textContent = "Crop area";
              break;
            case "classification":
              pTag.textContent = "Classification";
              break;
            case "numberOfHeads":
              pTag.textContent = "Number of heads";
              break;
            case "livestockType":
              pTag.textContent = "Livestock type";
              break;
            default:
              pTag.textContent = "Please fill out the required fields";
              break;
          }

          message.appendChild(pTag);
        }
      });

      Swal.fire({
        title: "<strong>Empty Fields!</strong>",
        html: message,
        icon: "warning",
        confirmButtonText: "OK",
      });

      document.getElementById("submitFarmsButton").disabled = false;
      document.getElementById(
        "submitFarmsButton"
      ).innerHTML = `<i class="fas fa-save me-2"></i>Save`;

      return;
    }

    let farmer_id = "";

    if (card.querySelector(".farmer_id")) {
      farmer_id = card.querySelector(".farmer_id").value;
      console.log(`Farmer exists! ${farmer_id}`);
    } else {
      console.log("Class not exists!");
    }

    const ffrs = escapeHtml(card.querySelector(".ffrs").value);
    const brgy = escapeHtml(card.querySelector(".brgy").value);
    const municipality = escapeHtml(card.querySelector(".municipality").value);
    const province = escapeHtml(card.querySelector(".province").value);
    const firstName = escapeHtml(card.querySelector(".firstName").value);
    const middleName = escapeHtml(card.querySelector(".middleName").value);
    const lastName = escapeHtml(card.querySelector(".lastName").value);
    const extName = escapeHtml(card.querySelector(".extName").value);
    const gender = escapeHtml(card.querySelector(".gender").value);
    const bday = escapeHtml(card.querySelector(".bday").value);
    const deceased = escapeHtml(card.querySelector(".deceased").checked ? 1 : 0);

    const govIdType = escapeHtml(card.querySelector(".govIdType").value);
    const govIdNumber = escapeHtml(card.querySelector(".govIdNumber").value);
    const hbp = escapeHtml(card.querySelector(".hbp").value);
    const sss = escapeHtml(card.querySelector(".sss").value);
    const region = escapeHtml(card.querySelector(".region").value);
    const selected_enrollment = "";
    if (document.getElementById(".selected_enrollment")) {
      selected_enrollment = escapeHtml(document.getElementById(
        ".selected_enrollment"
      ).value);
    }

    // Select all input elements with the class 'parcelNum' and type 'hidden'
    const hiddenInputs = document.querySelectorAll(
      'input[type="hidden"].parcelNum'
    );

    // Initialize a variable to store the largest number
    let num_of_parcels = 0;

    // Loop through each input element
    hiddenInputs.forEach((input) => {
      // Parse the value as an integer and compare with the current num_of_parcels
      const farmNumber = parseInt(input.value, 10);

      // Update num_of_parcels if the current farmNumber is larger
      if (farmNumber > num_of_parcels) {
        num_of_parcels = farmNumber;
      }
    });

    // Log the largest number found
    console.log("Largest farm number:", num_of_parcels);
    let review = ``;

    if (card.querySelector(".farmer_id")) {
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
            region,
            selected_enrollment,
          },
        });
      }
    } else {
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
            region,
          },
        });
      }

      review += `
        <label class="fw-bold">Farmer Information</label class="fw-bold">
        <div class="row" style="text-align: left;">
      <ul>
        <li><strong>FFRS:</strong> <span class="text-success">${ffrs}</span></li>
        <li><strong>Full Name:</strong> <span class="text-success">${firstName}</span>, <span class="text-success">${middleName}</span>, <span class="text-success">${lastName}</span>, <span class="text-success">${extName}</span></li>
        <li><strong>Goverment ID Type:</strong> <span class="text-success">${govIdType}</span></li>
        <li><strong>Goverment ID Number:</strong> <span class="text-success">${govIdNumber}</span></li>
        <li><strong>Address:</strong> <span class="text-success">${hbp}</span>, <span class="text-success">${sss}</span>, <span class="text-success">${brgy}</span>, <span class="text-success">${municipality}</span>, <span class="text-success">${province}</span></li>
        <li><strong>Gender:</strong> <span class="text-success">${gender}</span></li>
        <li><strong>Birthdate:</strong> <span class="text-success">${bday}</span></li>
      </ul>
        </div>
        `;
    }

    if (farmCards.length > 0) {
      review += `<label class="fw-bold">Farm Information</label class="fw-bold">`;
      farmCards.forEach((card) => {
        const ofName = escapeHtml(card.querySelector(".ofName").value);
        const olName = escapeHtml(card.querySelector(".olName").value);
        const ownership = escapeHtml(card.querySelector(".ownership").value);
        const farmLocationBrgy = escapeHtml(card.querySelector(".farmLocationBrgy").value);
        const farmLocationMunicipality = escapeHtml(card.querySelector(
          ".farmLocationMunicipality"
        ).value);
        const farmLocationProvince = escapeHtml(card.querySelector(
          ".farmLocationProvince"
        ).value);
        const farmType = escapeHtml(card.querySelector(".farmType").value);
        const farmSize = escapeHtml(card.querySelector(".farmSize").value);
        const parcelNum = parseInt(escapeHtml(card.querySelector(".parcelNum").value, 10));

        let parcel_id = "";

        if (card.querySelector(".parcel_id")) {
          parcel_id = escapeHtml(card.querySelector(".parcel_id").value);
          console.log(`Farm exists! ${parcel_id}`);
        } else {
          console.log("Class not exists!");
        }

        if (card.querySelector(".parcel_id")) {
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
              farmType,
            },
          });
        } else {
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
              farmType,
            },
          });
            review += `
        <div class="row" style="text-align: left;">
          <ul>
          <li><strong>Parcel #:</strong> <span class="text-success">${parcelNum}</span></li>
          <li><strong>Ownership:</strong> <span class="text-success">${ownership}</span></li>
          <li><strong>Owner's Name:</strong> <span class="text-success">${ofName} ${olName}</span></li>
          <li><strong>Location:</strong> <span class="text-success">${farmLocationBrgy}, ${farmLocationMunicipality}, ${farmLocationProvince}</span></li>
          <li><strong>Farm Size:</strong> <span class="text-success">${farmSize}</span> hectares</li>
          <li><strong>Farm Type:</strong> <span class="text-success">${farmType}</span></li>
          </ul>
        </div>`;
        }
      });
    }

    if (cropCards.length > 0) {
      review += `
      <label class="fw-bold">Crop Information</label class="fw-bold">
    `;
      cropCards.forEach((card) => {
        const parcelNum = escapeHtml(card.querySelector(".parcelNum").value);
        const hvc = escapeHtml(card.querySelector(".hvc").checked ? 1 : 0);
        const cropArea = escapeHtml(card.querySelector(".cropArea").value);
        const cropName = escapeHtml(card.querySelector(".cropName").value);
        const classification = parseInt(
          escapeHtml(card.querySelector(".classification").value)
        );

        let crop_id = "";
        if (card.querySelector(".crop_id")) {
          crop_id = escapeHtml(card.querySelector(".crop_id").value);
          console.log(`Crop exists! ${crop_id}`);
        } else {
          console.log("Class not exists!");
        }

        if (card.querySelector(".crop_id")) {
          farms.push({
            crop: {
              crop_id,
              parcelNum,
              hvc,
              cropArea,
              cropName,
              classification,
            },
          });
        } else {
          farms.push({
            crop: {
              parcelNum,
              hvc,
              cropArea,
              cropName,
              classification,
            },
          });
            review += `
          <div class="row" style="text-align: left;">
            <ul>
            <li><strong>Parcel #:</strong> <span class="text-success">${parcelNum}</span></li>
            <li><strong>High Value Crop?:</strong> <span class="text-success">${hvc === 1 ? 'Yes': 'No'}</span></li>
            <li><strong>Crop Area:</strong> <span class="text-success">${cropArea}</span></li>
            <li><strong>Crop Name:</strong> <span class="text-success">${cropName}</span></li>
            <li><strong>Classification:</strong> <span class="text-success">${classification}</span> hectares</li>
            </ul>
          </div>
        `;
        }
      });
    }

    if (livestockCards.length > 0) {
      review += `
      <label class="fw-bold">Livestock Information</label class="fw-bold">
    `;
      livestockCards.forEach((card) => {
        const parcelNum = escapeHtml(card.querySelector(".parcelNum").value);
        const numberOfHeads = parseInt(
          escapeHtml(card.querySelector(".numberOfHeads").value)
        );
        const livestockType = escapeHtml(card.querySelector(".livestockType").value);

        let livestock_id = "";

        if (card.querySelector(".livestock_id")) {
          livestock_id = escapeHtml(card.querySelector(".livestock_id").value);
          console.log(`LS exists! ${livestock_id}`);
        } else {
          console.log("Class not exists!");
        }

        if (card.querySelector(".livestock_id")) {
          farms.push({
            livestock: {
              livestock_id,
              parcelNum,
              numberOfHeads,
              livestockType,
            },
          });
        } else {
          farms.push({
            livestock: {
              parcelNum,
              numberOfHeads,
              livestockType,
            },
          });
            review += `
            <div class="row" style="text-align: left;">
              <ul>
              <li><strong>Parcel #:</strong> <span class="text-success">${parcelNum}</span></li>
              <li><strong>Number Of Heads:</strong> <span class="text-success">${numberOfHeads}</span></li>
              <li><strong>Livestock:</strong> <span class="text-success">${livestockType}</span></li>
              </ul>
            </div>
          `;
        }
      });
    }

    document.getElementById("farmsData").value = JSON.stringify(farms);
    console.log(farms);

    if (card.querySelector(".farmer_id")) {
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "compare-record.php", true);
      xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
      xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
        if (xhr.status === 200) {
        // console.log("Response from compare-record.php:", xhr.responseText);
        Swal.fire({
          title: "Review Changes",
          html: `<div class="row">${xhr.responseText}</div>`,
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Continue",
        }).then((result) => {
          if (result.isConfirmed) {
          document.getElementById("farmForm").submit();
          }
        });
        } else if (xhr.status === 404) {
        Swal.fire({
          title: "Error",
          text: "The requested resource was not found (404).",
          icon: "error",
          confirmButtonText: "OK",
        });
        } else if (xhr.status === 500) {
        Swal.fire({
          title: "Error",
          text: "An internal server error occurred (500).",
          icon: "error",
          confirmButtonText: "OK",
        });
        }
      }
      };
      xhr.send(document.getElementById("farmsData").value);
    } else {
      Swal.fire({
        title: "Are you sure?",
        html: `<div class="row">${review}</div>`,
        // icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, submit it!",
      }).then((result) => {
        if (result.isConfirmed) {
          document.getElementById("farmForm").submit();
        }
      });
    }
  });

const prevButton = document.getElementById("prevButton");
const nextButton = document.getElementById("nextButton");
const tabs = document.querySelectorAll(".nav-link");

prevButton.addEventListener("click", () => {
  const activeTab = document.querySelector(".nav-link.active");
  if (activeTab) {
    const prevTab = activeTab.parentElement.previousElementSibling;
    if (prevTab) {
      prevTab.querySelector(".nav-link").click();
      updateButtonStates();
    }
  }
});

nextButton.addEventListener("click", () => {
  const activeTab = document.querySelector(".nav-link.active");
  if (activeTab) {
    const nextTab = activeTab.parentElement.nextElementSibling;
    if (nextTab) {
      nextTab.querySelector(".nav-link").click();
      updateButtonStates();
    }
  }
});

// Optionally, set initial states of buttons (disabled/enabled based on the active tab position)
function updateButtonStates() {
  const activeTab = document.querySelector(".nav-link.active");
  const firstTab = document.querySelector(".nav-item:first-child .nav-link");
  const lastTab = document.querySelector(".nav-item:last-child .nav-link");

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
document.addEventListener("DOMContentLoaded", updateButtonStates);

// Keyboard arrow navigation (left and right)
document.addEventListener("keydown", (event) => {
  if (event.key === "ArrowLeft") {
    // Left arrow (previous)
    prevButton.click();
  } else if (event.key === "ArrowRight") {
    // Right arrow (next)
    nextButton.click();
  }
});

if (window.location.href.includes("farms=true")) {
  nextButton.click();
}

tabs.forEach((tab) => {
  tab.addEventListener("click", () => {
    const activeTab = document.querySelector(".nav-link.active");
    if (activeTab) {
      activeTab.classList.remove("active");
    }
    tab.classList.add("active");
  });
});

function previewImage() {
  const fileInput = document.getElementById("farmerImg");
  const imgElement = document.getElementById("farmerImage");

  const file = fileInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (event) {
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
  fileInput.addEventListener("change", function (event) {
    const file = event.target.files[0]; // Get the selected file

    // Check if the file is an image
    if (file && file.type.startsWith("image")) {
      const reader = new FileReader();

      // When the file is successfully read
      reader.onload = function (e) {
        previewImage.src = e.target.result; // Set the preview image source
        previewContainer.style.display = "block"; // Show the preview container
      };

      // Read the file as a data URL
      reader.readAsDataURL(file);
    } else {
      // If the file is not an image, hide the preview container
      previewContainer.style.display = "none";
    }
  });
}

// Initialize preview handling for both front and back ID photos
handleImagePreview(
  "govIdPhotoFront",
  "previewContainerFront",
  "previewImageFront"
);
handleImagePreview(
  "govIdPhotoBack",
  "previewContainerBack",
  "previewImageBack"
);
