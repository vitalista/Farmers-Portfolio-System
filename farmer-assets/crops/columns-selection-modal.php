<div class="modal fade" id="columnSelectionModal" tabindex="-1">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose columns to display:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <form method="get">
                    <div class="form-group row">

                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="parcel_code"
                                <?= (isset($_GET['columns']) && in_array('parcel_code', $_GET['columns'])) ? 'checked' : ''; ?>> Parcel FPS
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="crop_name"
                                <?= (isset($_GET['columns']) && in_array('crop_name', $_GET['columns'])) ? 'checked' : ''; ?>> Crop Name
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="crop_area"
                                <?= (isset($_GET['columns']) && in_array('crop_area', $_GET['columns'])) ? 'checked' : ''; ?>> Crop Area
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="classification"
                                <?= (isset($_GET['columns']) && in_array('classification', $_GET['columns'])) ? 'checked' : ''; ?>> Classification
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="hvc"
                                <?= (isset($_GET['columns']) && in_array('hvc', $_GET['columns'])) ? 'checked' : ''; ?>> HVC
                        </div>
                    </div>

                        <div class="col-md-12 mb-3 text-center">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#showMore" aria-expanded="false" aria-controls="showMore">
                                Show more <i class="fa-solid fa-arrow-down"></i>
                            </button>
                        </div>
                        <div class="collapse row" id="showMore">
                        <?php include 'parcels/parcel-selection-content.php'; ?>
                       <?php include '../farmer/farmer-selection-content.php'; ?>
                        </div>
                    </div>
            </div>
            <div class="text-end m-3"><button type="submit" class="btn btn-sm btn-success">Update Table</button></div>
            </form>
        </div>

    </div>
</div>