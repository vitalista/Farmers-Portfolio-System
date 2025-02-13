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
                <input type="number" class="form-control no-spin-button resourcesNumber" required>
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

document.getElementById('addResourcesButton').addEventListener('click', function() {
  const resourcesContainer = document.getElementById('resourcesContainer');

  // Create a new farm input card
  const newResourcesCard = document.createElement('div');
  newResourcesCard.className = 'card my-2';
  newResourcesCard.innerHTML = newFarmInput;

  // Append the new card to the container
  resourcesContainer.appendChild(newResourcesCard);

  entryFade(newResourcesCard);
  // Add event listener to the remove farm button
  newResourcesCard.querySelector('.remove-resources').addEventListener('click', function() {
    removalFade(newResourcesCard);
    setTimeout(() => {
      resourcesContainer.removeChild(newResourcesCard);
    }, 250);

  });
});

document.getElementById('submitButton').addEventListener('click', function(e) {
  e.preventDefault();
  const program = [];
  const card = document.querySelector('#myTabContent .card .card-body');
  const resourcesCard = document.querySelectorAll('#resourcesContainer .card-body');

  let program_id = '';
  let beneficiaries = '';
  if (card.querySelector('.program_id')) {
    beneficiaries = parseInt(card.querySelector('.beneficiaries').value);
    program_id = card.querySelector('.program_id').value;
    console.log(`Program exists! ${program_id}`);
  } else {
    console.log('Class not exists!');
  }

  const description = card.querySelector('.description').value;
  const totalBeneficiaries = parseInt(card.querySelector('.totalBeneficiaries').value);
  const endDate = card.querySelector('.endDate').value;
  const startDate = card.querySelector('.startDate').value;
  const programType = card.querySelector('.programType').value;
  const sourcingAgency = card.querySelector('.sourcingAgency').value;
  const nameOfProgram = card.querySelector('.nameOfProgram').value;

  if (card.querySelector('.program_id')) {
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
          nameOfProgram
        }
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
          nameOfProgram
        }
      });
    }
}

console.log(resourcesCard.length);

  if (resourcesCard.length > 0) {
    resourcesCard.forEach(card => {
      const resourcesName = card.querySelector('.resourcesName').value;
      const resourcesType = card.querySelector('.resourcesType').value;
      const resourcesNumber = parseInt(card.querySelector('.resourcesNumber').value);
      const unitOfMeasure = card.querySelector('.unitOfMeasure').value;

      let resources_id = '';
      let resourcesAvailable = '';

      if (card.querySelector('.resources_id')) {
        resources_id = card.querySelector('.resources_id').value;
        resourcesAvailable = parseInt(card.querySelector('.resourcesAvailable').value);
        console.log(`resources_id exists! ${resources_id} ${resourcesAvailable}`);
      } else {
        console.log('resources_id class not exists!');
      }

      if (card.querySelector('.resources_id')) {
        program.push({
          resources: {
            resourcesAvailable,
            resources_id,
            resourcesName,
            resourcesType,
            resourcesNumber,
            unitOfMeasure
          },
        });

      } else {
        program.push({
          resources: {
            resourcesName,
            resourcesType,
            resourcesNumber,
            unitOfMeasure
          },
        });
      }

    });
  }

  document.getElementById('programData').value = JSON.stringify(program);
  console.log(program);
  document.getElementById('programForm').submit();
});