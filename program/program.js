let newFarmInput = `
<h5 class="card-title ms-3">Resource</h5>
  <div class="card-body">
        <div class="row">
        
            <div class="col-md-3 mt-1">
                <label>Name</label>
                <input type="text" placeholder="brand/code" class="form-control resourcesName" required>
            </div>

            <div class="col-md-3 mt-1">
                <label>Type</label>
                <input type="text" placeholder="seedlings/fertilizers/cash" class="form-control resourcesType" required>
            </div>

            <div class="col-md-3 mt-1">
                <label>Quantity/Amount</label>
                <input type="number" step="0.01" class="form-control no-spin-button resourcesNumber" required>
            </div>

            <div class="col-md-3 mb-2 mt-1">
                <label>Unit of measure</label>
                <input type="text" placeholder="kg/bags/php" class="form-control unitOfMeasure" required>
            </div>

        </div>
            <div class="d-flex justify-content-end">
            <a class="btn btn-sm btn-danger remove-resources"><i class="fa-solid fa-trash-can"></i></a>
            </div>
        </div>
`;

document
  .getElementById("addResourcesButton")
  .addEventListener("click", function () {
    const resourcesContainer = document.getElementById("resourcesContainer");

    // Create a new farm input card
    const newResourcesCard = document.createElement("div");
    newResourcesCard.className = "card my-2";
    newResourcesCard.innerHTML = newFarmInput;

    // Append the new card to the container
    resourcesContainer.appendChild(newResourcesCard);

    entryFade(newResourcesCard);
    // Add event listener to the remove farm button
    newResourcesCard
      .querySelector(".remove-resources")
      .addEventListener("click", function () {
        removalFade(newResourcesCard);
        setTimeout(() => {
          resourcesContainer.removeChild(newResourcesCard);
        }, 250);
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
  return unsafe.replace(/[<>/]/g, '');
}


document.getElementById("submitButton").addEventListener("click", function (e) {
  const classArr = [
    "nameOfProgram",
    "programType",
    "startDate",
    "endDate",
    "totalBeneficiaries",
    "description",
    "sourcingAgency",
    "resourcesName",
    "resourcesType",
    "resourcesNumber",
    "unitOfMeasure",
  ];

  if (window.location.pathname.includes("program-view.php")) {
    classArr.push("beneficiaries", "resourcesAvailable");
  }

  if (emptyFields(".card .card-body", [], classArr)) {
    let message = document.createElement("div");
    message.className = "d-flex flex-wrap justify-content-start";
    const existingMessages = new Set();

    emptyFields(".tab-content", [], classArr).forEach((index) => {
      if (!existingMessages.has(index)) {
        existingMessages.add(index);
        const pTag = document.createElement("li");
        pTag.className = "text-danger w-100 col-md-4";

        switch (index) {
          case "nameOfProgram":
            pTag.textContent = "Name of Program";
            break;
          case "programType":
            pTag.textContent = "Program Type";
            break;
          case "startDate":
            pTag.textContent = "Start Date";
            break;
          case "endDate":
            pTag.textContent = "End Date";
            break;
          case "totalBeneficiaries":
            pTag.textContent = "Total Beneficiaries";
            break;
          case "description":
            pTag.textContent = "Description";
            break;
          case "sourcingAgency":
            pTag.textContent = "Sourcing Agency";
            break;
          case "resourcesName":
            pTag.textContent = "Resource Name";
            break;
          case "resourcesType":
            pTag.textContent = "Resource Type";
            break;
          case "resourcesNumber":
            pTag.textContent = "Resource Quantity/Amount";
            break;
          case "unitOfMeasure":
            pTag.textContent = "Unit of Measure";
            break;
          case "resourcesAvailable":
            pTag.textContent = "Available Quantity/Amount";
            break;
          case "beneficiaries":
            pTag.textContent = "Beneficiaries Available";
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

  e.preventDefault();
  const program = [];
  const card = document.querySelector("#myTabContent .card .card-body");
  const resourcesCard = document.querySelectorAll(
    "#resourcesContainer .card-body"
  );

  let program_id = "";
  let beneficiaries = "";
  if (card.querySelector(".program_id")) {
    beneficiaries = parseInt(escapeHtml(card.querySelector(".beneficiaries").value));
    program_id = escapeHtml(card.querySelector(".program_id").value);
    console.log(`Program exists! ${program_id}`);
  } else {
    console.log("Class not exists!");
  }

  const description = escapeHtml(card.querySelector(".description").value);
  const totalBeneficiaries = parseInt(
    escapeHtml(card.querySelector(".totalBeneficiaries").value
  ));
  const endDate = escapeHtml(card.querySelector(".endDate").value);
  const startDate = escapeHtml(card.querySelector(".startDate").value);
  const programType = escapeHtml(card.querySelector(".programType").value);
  const sourcingAgency = escapeHtml(card.querySelector(".sourcingAgency").value);
  const nameOfProgram = escapeHtml(card.querySelector(".nameOfProgram").value);
  const programColor = escapeHtml(card.querySelector(".programColor").value);

  let review = ``;

  if (card.querySelector(".program_id")) {
    if (resourcesCard.length <= 0 || resourcesCard.length > 0) {
      program.push({
        program: {
          program_id,
          description,
          totalBeneficiaries,
          beneficiaries,
          endDate,
          startDate,
          programType,
          sourcingAgency,
          nameOfProgram,
          programColor,
        },
      });
    }
  } else {
    if (resourcesCard.length <= 0 || resourcesCard.length > 0) {
      program.push({
        program: {
          description,
          totalBeneficiaries,
          endDate,
          startDate,
          programType,
          sourcingAgency,
          nameOfProgram,
          programColor,
        },
      });
    }
    review += `
      <label class="fw-bold">Program Information</label>
      <div class="row" style="text-align: left;">
      <ul>
        <li><strong>Name of Program:</strong> <span class="text-success">${nameOfProgram}</span></li>
        <li><strong>Program Type:</strong> <span class="text-success">${programType}</span></li>
        <li><strong>Start Date:</strong> <span class="text-success">${startDate}</span></li>
        <li><strong>End Date:</strong> <span class="text-success">${endDate}</span></li>
        <li><strong>Total Beneficiaries:</strong> <span class="text-success">${totalBeneficiaries}</span></li>
        <li><strong>Description:</strong> <span class="text-success">${description}</span></li>
        <li><strong>Sourcing Agency:</strong> <span class="text-success">${sourcingAgency}</span></li>
        <li><strong>Program Color:</strong> <span class="text-success">${programColor}</span></li>
      </ul>
      </div>
      `;
  }

  console.log(resourcesCard.length);

  if (resourcesCard.length > 0) {
    review += `<label class="fw-bold">Resources</label class="fw-bold">`;
    resourcesCard.forEach((card) => {
      const resourcesName = escapeHtml(card.querySelector(".resourcesName").value);
      const resourcesType = escapeHtml(card.querySelector(".resourcesType").value);
      const resourcesNumber = parseFloat(
        escapeHtml(card.querySelector(".resourcesNumber").value)
      );
      const unitOfMeasure = escapeHtml(card.querySelector(".unitOfMeasure").value);

      let resources_id = "";
      let resourcesAvailable = "";

      if (card.querySelector(".resources_id")) {
        resources_id = escapeHtml(card.querySelector(".resources_id").value);
        resourcesAvailable = parseFloat(
          escapeHtml(card.querySelector(".resourcesAvailable").value)
        );
        console.log(
          `resources_id exists! ${resources_id} ${resourcesAvailable}`
        );
      } else {
        console.log("resources_id class not exists!");
      }

      if (card.querySelector(".resources_id")) {
        program.push({
          resources: {
            resourcesAvailable,
            resources_id,
            resourcesName,
            resourcesType,
            resourcesNumber,
            unitOfMeasure,
          },
        });
      } else {
        program.push({
          resources: {
            resourcesName,
            resourcesType,
            resourcesNumber,
            unitOfMeasure,
          },
        });
        review += `
        <div class="row" style="text-align: left;">
          <ul>
            <li><strong>Resource Name:</strong> <span class="text-success">${resourcesName}</span></li>
            <li><strong>Resource Type:</strong> <span class="text-success">${resourcesType}</span></li>
            <li><strong>Quantity/Amount:</strong> <span class="text-success">${resourcesNumber}</span></li>
            <li><strong>Unit of Measure:</strong> <span class="text-success">${unitOfMeasure}</span></li>
          </ul>
        </div>`;
      }
    });
  }

  document.getElementById("programData").value = JSON.stringify(program);
  console.log(program);
  if (card.querySelector(".program_id")) {
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
        document.getElementById("programForm").submit();
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
    xhr.send(document.getElementById("programData").value);
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
        document.getElementById("programForm").submit();
      }
    });
  }
});
