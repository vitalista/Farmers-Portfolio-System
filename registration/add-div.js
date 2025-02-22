let farmCounter = 0;
document.getElementById('addFarmButton').addEventListener('click', async function() {
    farmCounter++;
    const farmContainer = document.getElementById('farmContainer');

    // Create a new farm input card
    const newFarmCard = document.createElement('fieldset');
    newFarmCard.className = 'card border p-3';

    // Add initial HTML structure
    newFarmCard.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title fw-bold">Parcel #${farmCounter}</h5>
            <a class="remove-farm btn btn-sm btn-danger"><i class="fas fa-x text-white"></i></a>
        </div>
        <div id="farmContent-${farmCounter}" class="farmContent">
          <input type="hidden" class="parcelNum" value="${farmCounter}">
            <!-- Content from the fetched file will go here -->
        </div>
    `;

    try {
        // Fetch the HTML file
        const response = await fetch('parcel.html');
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const htmlContent = await response.text();

        // Insert the fetched content into the specific section of the card
        const farmContentContainer = newFarmCard.querySelector(`#farmContent-${farmCounter}`);
        farmContentContainer.insertAdjacentHTML( "beforeend",htmlContent);

        // Append the new farm card to the container
        farmContainer.appendChild(newFarmCard);
    } catch (error) {
        console.error('Error fetching the HTML file:', error);
    }

    //Add Crop
    newFarmCard.querySelector('.addCropButton').addEventListener('click', async function() {
        const cropsContainer = newFarmCard.querySelector('#commodityContainer');
        const cropInputDiv = document.createElement('div');
        cropInputDiv.className = 'col-md-6 mt-1 cropsContainer';
        cropInputDiv.innerHTML = `
        <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: rgb(149,200,4);">
                  <h3 class="text-white">Crop/Commodity</h3>
                  <a class="btn btn-danger btn-sm removeCropButton"><i class="fas fa-x text-white"></i></a>
                </div>
                <div class="card-body">
                <input type="hidden" class="parcelNum" value="${farmCounter}" style="width: 100%;">
                  <label class="form-label d-block mb-2" style="font-size: 19px; font-weight: bold;">
                    Crop Name:
                    <input type="text" class="form-control rounded-3 cropName">
                  </label>
                  <label class="form-label d-block mb-2" style="font-size: 19px; font-weight: bold;">
                    Size (Ha):
                    <input type="text" class="form-control rounded-3 cropArea" placeholder="(Ha)">
                  </label>

                   <label class="form-label d-block mb-2" style="font-size: 19px; font-weight: bold;">
                    Classification:
                    <input type="text" class="form-control rounded-3 classification">
                  </label>
                  
                  <fieldset class="mt-3">
                    <legend style="font-size: 19px; font-weight: bold;">High Value Crop?</legend>
                    <div class="form-check form-check-inline">
                      <input type="checkbox" class="form-check-input hvc" name="organicPractitioner1">
                      <label class="form-check-label" for="organicYes1">Yes</label>
                    </div>
                  </fieldset>
                </div>
          
        </div>
        `;

        cropsContainer.appendChild(cropInputDiv);
        // Add event listener for the remove button
        cropInputDiv.querySelector('.removeCropButton').addEventListener('click', function() {
          setTimeout(() => {
            cropsContainer.removeChild(cropInputDiv);
          }, 250);
        });
    });
    //Add Livestock
    newFarmCard.querySelector('.addLivestockButton').addEventListener('click', function() {
        const livestockContainer = newFarmCard.querySelector('#commodityContainer');
        const livestockInputDiv = document.createElement('div');
        livestockInputDiv.className = 'col-md-6 mt-1 livestockContainer';
        livestockInputDiv.innerHTML = `      
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: #619c79;">
                  <h3 class="text-white">Livestock</h3>
                  <a class="btn btn-danger btn-sm removeLivestockButton"><i class="fas fa-x text-white"></i></a>
                </div>
                <div class="card-body">
                <input type="hidden" class="parcelNum" value="${farmCounter}" style="width: 100%;">
                  <label class="form-label d-block mb-2" style="font-size: 19px; font-weight: bold;">
                    Livestock Name:
                    <input type="text" class="form-control rounded-3 livestockType">
                  </label>
                  <label class="form-label d-block mb-2" style="font-size: 19px; font-weight: bold;">
                    No. of Livestock (Per Head):
                    <input type="text" class="form-control rounded-3 numberOfHeads" placeholder="Per Head">
                  </label>
                </div>
              </div>
      `;
        livestockContainer.appendChild(livestockInputDiv);
    
        // Add event listener for the remove button
        livestockInputDiv.querySelector('.removeLivestockButton').addEventListener('click', function() {
          setTimeout(() => {
            livestockContainer.removeChild(livestockInputDiv);
          }, 250);
        });
      });

    //Parcel 
    const parcelTitle = newFarmCard.querySelector('.card-title').textContent;
    const farmNumber = parseInt(parcelTitle.replace('Parcel #', '').trim());
    console.log(farmNumber);

    newFarmCard.querySelector('.remove-farm').addEventListener('click', function() {

    const cardTitles = document.querySelectorAll('.card-title');
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
  
    if (targetFarmCard) {
      setTimeout(() => {
        farmCounter = farmCounter - 1;
        farmContainer.removeChild(targetFarmCard); 
      }, 250);
    }

  });

});
