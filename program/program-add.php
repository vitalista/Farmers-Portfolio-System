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

          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
              <h5 class="card-title">Add Program</h5>
              <div>
                <a onclick="window.history.back()" class="btn btn-primary">Back</a>
              </div>
            </div>

            <!-- Default Tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Program Information</button>
              </li>
            </ul>

            <div class="tab-content pt-2" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                <div class="card">

                  <div class="card-body row g-3">

                    <div class="col-md-4 mt-5">
                      <div class="form-floating">
                        <input type="text" class="form-control nameOfProgram" id="nameOfProgram" placeholder="" required>
                        <label for="nameOfProgram">Name of program</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                    </div>

                    <div class="col-md-4 mt-5">
                      <div class="form-floating">
                        <input type="text" class="form-control sourcingAgency" id="sourcingAgency" placeholder="" required>
                        <label for="sourcingAgency">Sourcing agency</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                    </div>

                    <div class="col-md-4 mt-5">
                      <div class="form-floating">
                        <input type="text" class="form-control programType" id="programType" placeholder="" required>
                        <label for="programType">Type</label>
                        <div class="invalid-feedback">Please enter.</div>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <label for="startDate" class="form-label">Start date</label>
                      <input type="date" class="form-control startDate" id="startDate" required>
                      <div class="invalid-feedback">Please enter.</div>
                    </div>


                    <div class="col-md-2">
                      <label for="endDate" class="form-label">End date<span class="red-star">*</span></label>
                      <input type="date" class="form-control endDate" id="endDate" required>
                      <div class="invalid-feedback">Please enter.</div>
                    </div>

                    <div class="col-md-3">
                      <label for="totalBeneficiaries" class="form-label">Total beneficiaries<span class="red-star">*</span></label>
                      <input type="number" placeholder="" class="form-control no-spin-button totalBeneficiaries" id="totalBeneficiaries" required max="9999999999" min="9000000000" step="1">
                      <div class="invalid-feedback">Please enter.</div>
                    </div>

                    <div class="col-md-5 mt-5 form-floating mb-3">
                      <textarea required class="form-control description" placeholder="Leave a comment here" id="description" style="height: 100px;"></textarea>
                      <label for="description">Description</label>
                      <div class="invalid-feedback">Please enter.</div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center" style="margin-bottom: -20px;">
                      <h5 class="card-title">Resources List</h5>
                      <a id="addResourcesButton" class="btn btn-primary">Add Resource</a>
                    </div>

                    <div id="resourcesContainer" class="mt-3"></div>

                  </div>

                </div>

              </div>
            </div>

          </div>


          <div class="d-flex justify-content-end mb-3 mt-3">
            <button type="reset" class="btn btn-secondary me-2">Reset</button>
            <button type="submit" class="btn btn-success me-2" id="submitButton">Save</button>
          </div>

          <form class="needs-validation" method="POST" action="program-add-code.php" id="programForm" novalidate>
          <input type="text" name="program_data" id="programData" style="width: 100%;">
          </form>

        </div>

      </div>
      </div>
    </section>
  </main>

  <!-- ======= Footer ======= -->
  <?php include '../includes/footer.php' ?>
  <script>
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
                <a class="btn btn-danger remove-resources">Remove Resource</a>
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
      const resourcesCard = document.querySelectorAll('#resourcesContainer .card-body');
      const card = document.querySelector('#myTabContent .card .card-body');

      let program_id = '';

      if (card.querySelector('.program_id')) {
        program_id = card.querySelector('.program_id').value;
        console.log(`Farmer exists! ${program_id}`);
      } else {
        console.log('Class not exists!');
      }

      const description = card.querySelector('.description').value;
      const totalBeneficiaries = card.querySelector('.totalBeneficiaries').value;
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

      if (resourcesCard.length > 0) {
        resourcesCard.forEach(card => {
          const resourcesName = card.querySelector('.resourcesName').value;
          const resourcesType = card.querySelector('.resourcesType').value;
          const resourcesNumber = card.querySelector('.resourcesNumber').value;
          const unitOfMeasure = card.querySelector('.unitOfMeasure').value;

          let program_id = '';

          if (card.querySelector('.program_id')) {
            program_id = card.querySelector('.program_id').value;
            console.log(`Farm exists! ${program_id}`);
          } else {
            console.log('Class not exists!');
          }

          if (card.querySelector('.program_id')) {
            program.push({
              resources: {
                program_id,
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
  </script>


</body>

</html>