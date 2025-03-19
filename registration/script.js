function debounce(func, wait) {
  let timeout;
  return function () {
    const context = this;
    const args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(() => {
      func.apply(context, args);
    }, wait);
  };
}

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
  if (emptyFields.length === 0) {
    return false;
  } else {
    return true;
  }
}

function clearAllInputsAndSelects() {
  const inputs = document.querySelectorAll('input');
  const selects = document.querySelectorAll('select');
  const images = document.querySelectorAll('img');

  const ignoredInputs = [
    'form-control municipality',
    'province',
    'form-control province',
    'region',
    'form-control region',
    'farmLocationMunicipality',
    'farmLocationProvince'
  ];

  inputs.forEach(input => {
      if (!ignoredInputs.includes(input.className)){
        input.value = '';
      }
  });

  selects.forEach(select => {
    select.value = '';
  });

  images.forEach(img => {
    switch (img.id) {
      case 'farmerImage':
        img.src = '../assets/img/farmer.png';
        break;
      case 'previewImageFront':
        img.style.display = 'none';
        break;
      case 'previewImageBack':
        img.style.display = 'none';
        break;
    }
  });
}

document
  .getElementById("submitFarmsButton")
  .addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("submitFarmsButton").disabled = true;
    document.getElementById(
      "submitFarmsButton"
    ).innerHTML = `<i class="fas fa-save me-2"></i>Saving..`;

    const farmer = document.querySelector("#farmerCard .card");
    const farmCards = document.querySelectorAll('#farmContainer .card .farmContent');
    const livestockCards = document.querySelectorAll('#commodityContainer .livestockContainer .card .card-body');
    const cropCards = document.querySelectorAll('#commodityContainer .cropsContainer .card .card-body');

    // let farmer_id = "";
    // if (farmer.querySelector(".farmer_id")) {
    //   farmer_id = farmer.querySelector(".farmer_id").value;
    // }

    const ffrsElements = document.querySelectorAll(".ffrs");
    let ffrs = "";
    ffrsElements.forEach((element, index) => {
      if (index === 0) {
        ffrs += element.value;
      } else {
        ffrs += "-" + element.value;
      }
    });

    const firstName = farmer.querySelector(".firstName").value;
    const middleName = farmer.querySelector(".middleName").value;
    const lastName = farmer.querySelector(".lastName").value;
    const extName = farmer.querySelector(".extName").value;

    const gender = farmer.querySelector('input[name="gender"]:checked')?.value;

    const bday = farmer.querySelector(".bday").value;
    const hbp = farmer.querySelector(".hbp").value;
    const sss = farmer.querySelector(".sss").value;
    const brgy = farmer.querySelector(".brgy").value;
    const municipality = farmer.querySelector(".municipality").value;
    const province = farmer.querySelector(".province").value;
    const region = farmer.querySelector(".region").value;
    const govIdType = farmer.querySelector(".govIdType").value;
    const govIdNumber = farmer.querySelector(".govIdNumber").value;

    const classArr = [
      "firstName", "bday", "hbp", "sss", "brgy", "municipality", "province", "region", "govIdType", "govIdNumber",,
      "hvc", "cropArea", "cropName", "classification", "numberOfHeads", "livestockType", "ofName", "olName", "ownership", "farmLocationBrgy", "farmLocationMunicipality", "farmLocationProvince", "farmSize", "farmType", "lastName", "middleName"
    ];

    const selectedEnrollment = document.querySelector(
      'input[name="enrollment"]:checked'
    )?.value;

    if(selectedEnrollment === 'UPDATING'){
      classArr.push('ffrs');
    }

    const farmerImg = document.getElementById("farmerImg");
    const farmerImage = farmerImg.files[0];

    const photoBack = document.getElementById("govIdPhotoBack");
    const govIdPhotoBack = photoBack.files[0];

    const photoFront = document.getElementById("govIdPhotoFront");
    const govIdPhotoFront = photoFront.files[0];

    const formData = new FormData();
    if (farmerImage) formData.append("farmerImage", farmerImage);
    if (govIdPhotoBack) formData.append("govIdPhotoBack", govIdPhotoBack);
    if (govIdPhotoFront) formData.append("govIdPhotoFront", govIdPhotoFront);
    
    if (emptyFields("#farmerCard .card", [
      'farmerImg', 
      'govIdPhotoBack', 
      'govIdPhotoFront'
    ], classArr)) {
      Swal.fire({
        title: "Empty Fields!",
        text: "Please fill in all the required fields.",
        icon: "warning",
        confirmButtonText: "OK",
      });

      document.getElementById("submitFarmsButton").disabled = false;
      document.getElementById(
        "submitFarmsButton"
      ).innerHTML = `<i class="fas fa-save me-2"></i>Save`;

      return;
    }

    const hiddenInputs = document.querySelectorAll('input[type="hidden"].parcelNum');
    let num_of_parcels = 0;

    hiddenInputs.forEach(input => {
      const farmNumber = parseInt(input.value, 10);
      
      if (farmNumber > num_of_parcels) {
        num_of_parcels = farmNumber;
      }
    });

    const farms = [];
    farms.push({
      farmer: {
      num_of_parcels,
      // farmer_id,
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
      selectedEnrollment,
      govIdNumber,
      govIdType,
      sss,
      hbp,
      region
      }
    });

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
      });
    }
  
    if (cropCards.length > 0) {
      cropCards.forEach(card => {
        const parcelNum = card.querySelector('.parcelNum').value;
        const hvc = card.querySelector('.hvc').checked ? 1 : 0;
        const cropArea = card.querySelector('.cropArea').value;
        const cropName = card.querySelector('.cropName').value;
        const classification = parseInt(card.querySelector('.classification').value);
      farms.push({
        crop: {
          parcelNum,
          hvc,
          cropArea,
          cropName,
          classification
        }
      });
      });
    }
  
    if (livestockCards.length > 0) {
      livestockCards.forEach(card => {
        const parcelNum = card.querySelector('.parcelNum').value;
        const numberOfHeads = parseInt(card.querySelector('.numberOfHeads').value);
        const livestockType = card.querySelector('.livestockType').value;
   
        farms.push({
          livestock: {
            parcelNum,
            numberOfHeads,
            livestockType
          }
        });
      });
    }

    formData.append("farmsData", JSON.stringify(farms));

      const sendRequest = function (formData) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "submit-registration.php", true);

        xhr.onload = function () {
          if (xhr.status === 200) {
            // Log the response (success message) from PHP
            document.getElementById("submitFarmsButton").disabled = false;
            document.getElementById(
              "submitFarmsButton"
            ).innerHTML = `<i class="fas fa-save me-2"></i>Save`;
            clearAllInputsAndSelects()
            Swal.fire({
              title: "Success!",
              text: "Data successfully inserted.",
              icon: "success",
              confirmButtonText: "OK",
            });
            // window.location.reload();
            console.log("Response from PHP: " + xhr.responseText);
          } else {
            console.error("Error submitting data");
          }
        };
        xhr.send(formData);
      };

      const debouncedSendRequest = debounce(sendRequest, 1000);
      debouncedSendRequest(formData);
    
  });
