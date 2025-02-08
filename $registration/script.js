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

function checkEmptyFields(card, idArr = [], classArr = []) {
  const parent = document.querySelector(card);

  let emptyFields = [];

  classArr.forEach((classId) => {
    const classElement = parent.querySelector(`.${classId}`);
    if (!classElement || !classElement.value) {
      emptyFields.push(classId);
    }
  });

  idArr.forEach((id) => {
    const idElement = parent.querySelector(`#${id}`);
    if (!idElement || !idElement.value) {
      emptyFields.push(id);
    }
  });

  console.log(emptyFields);
  if (emptyFields.length === 0) {
    return true;
  } else {
    return false;
  }
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
    let farmer_id = "";
    if (farmer.querySelector(".farmer_id")) {
      farmer_id = farmer.querySelector(".farmer_id").value;
    }

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
    const selectedEnrollment = document.querySelector(
      'input[name="enrollment"]:checked'
    )?.value;

    const farmerImg = document.getElementById("farmerImg");
    const farmerImage = farmerImg.files[0];

    const photoBack = document.getElementById("govIdPhotoBack");
    const govIdPhotoBack = photoBack.files[0];

    const photoFront = document.getElementById("govIdPhotoFront");
    const govIdPhotoFront = photoFront.files[0];

    const formData = new FormData();

    formData.append("farmer_id", farmer_id);
    formData.append("ffrs", ffrs);
    formData.append("firstName", firstName);
    formData.append("middleName", middleName);
    formData.append("lastName", lastName);
    formData.append("extName", extName);
    formData.append("gender", gender);
    formData.append("bday", bday);
    formData.append("hbp", hbp);
    formData.append("sss", sss);
    formData.append("brgy", brgy);
    formData.append("municipality", municipality);
    formData.append("province", province);
    formData.append("region", region);
    formData.append("govIdType", govIdType);
    formData.append("govIdNumber", govIdNumber);
    formData.append("selectedEnrollment", selectedEnrollment);

    if (farmerImage) formData.append("farmerImage", farmerImage);
    if (govIdPhotoBack) formData.append("govIdPhotoBack", govIdPhotoBack);
    if (govIdPhotoFront) formData.append("govIdPhotoFront", govIdPhotoFront);
    
    if (checkEmptyFields("#farmerCard .card", ["farmerImg"], ["firstName"])) {
      const sendRequest = function (formData) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "submit_registration.php", true);

        xhr.onload = function () {
          if (xhr.status === 200) {
            // Log the response (success message) from PHP
            document.getElementById("submitFarmsButton").disabled = false;
            document.getElementById(
              "submitFarmsButton"
            ).innerHTML = `<i class="fas fa-save me-2"></i>Save`;
            window.location.reload();
            console.log("Response from PHP: " + xhr.responseText);
          } else {
            console.error("Error submitting data");
          }
        };
        xhr.send(formData);
      };

      const debouncedSendRequest = debounce(sendRequest, 1000);
      debouncedSendRequest(formData);
    } else {
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

    }
  });
