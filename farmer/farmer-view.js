const cropBtns = document.querySelectorAll('[id^="cropBtns"]');

cropBtns.forEach(function(button) {
    button.addEventListener('click', function() {
        const parcelNo = button.getAttribute('data-parcel-no');
        const cropInputDiv = document.createElement('div');
        cropInputDiv.className = 'row dynamic-input my-2 p-2';
        cropInputDiv.style.boxShadow = "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
        cropInputDiv.innerHTML = `

        <div class="col-md-3 mb-3">
            <label class="ms-1">Crop Name</label>
            <input id="" type="text" placeholder="Type here..." class="form-control crop cropName" required>
        </div>

        <div class="col-md-3 mb-3">
            <label class="ms-1">Crop Area</label>
            <input id="" type="number" placeholder="In hectares" class="form-control crop cropArea no-spin-button" required>
        </div>
        <div class="col-md-3 mb-3">
            <label>Classification</label>
            <input type="number" class="form-control crop no-spin-button classification" required>
        </div>

        <div class="col-md-3 mb-3 mt-3 d-flex align-items-center">
            <label class="form-check-label">High value crop?</label>
            <div class="form-check ms-2">
            <input class="form-check-input crop hvc" style="width: 2rem; height: 2rem;" type="checkbox" id="">
            <input type="hidden" class="parcelNum" value="${parcelNo}" style="width: 100%;"> 
            </div>
        </div>

        <div class="d-flex justify-content-end col-md-12 mb-3 mt-4">
            <a class="btn btn-sm btn-danger removeCropButton" onclick="removeClosestDiv(this)"><i class="fa-solid fa-trash-can"></i></a>
        </div>
    `;
        button.closest('#cropsContainer').appendChild(cropInputDiv);
    });
});


const livestockBtns = document.querySelectorAll('[id^="livestockBtns"]');
livestockBtns.forEach(function(button) {
    button.addEventListener('click', function() {
        const parcelNo = button.getAttribute('data-parcel-no');
        const livestockInputDiv = document.createElement('div');
        livestockInputDiv.className = 'row dynamic-input mt-2 px-2 pt-3 mb-2';
        livestockInputDiv.style.boxShadow = "rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
        livestockInputDiv.innerHTML = `
            <div class="col-md-6 mb-3">
                <label>Number of heads</label>
                <input type="number" placeholder="Number of heads" class="form-control no-spin-button numberOfHeads" required max="9999999999" min="0" step="1">
                <input type="hidden" class="parcelNum" value="${parcelNo}" style="width: 100%;">
                <div class="invalid-feedback">Please enter.</div>
            </div>
            
            <div class="col-md-6 mb-3">
            <div class="form-group">
                <label for="livestockType">Animal type</label>
                <div class="input-group">
                <input type="text" id="livestockType" class="form-control livestockType" placeholder="Enter animal type" required>
                <div class="input-group-append">
                    <a class="btn btn-sm btn-danger removeLivestockButton mt-1" onclick="removeClosestDiv(this)"><i class="fa-solid fa-trash-can"></i></a>
                </div>
                </div>
            </div>
            `;
            button.closest('#livestockContainer').appendChild(livestockInputDiv);
    });
});

function removeClosestDiv(button) {
    var closestDiv = button.closest('.row'); // Find the closest div to the button
    if (closestDiv) {
        closestDiv.remove(); // Remove the closest div from the DOM
    }
}

const parcels = document.querySelectorAll('[id^="parcel"]');
const crops = document.querySelectorAll('[id^="crop"]');
const livestocks = document.querySelectorAll('[id^="livestock"]');

const addRemoveCardEvent = (buttons, parcel = false) => {
    let closest = '.card';
    if (!parcel) {
        closest = '.row';
    }
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const parentDiv = button.closest(closest);
            if (parentDiv) {
                parentDiv.remove();
            }
        });
    });
};

// addRemoveCardEvent(parcels, true);
// addRemoveCardEvent(crops);
// addRemoveCardEvent(livestocks);