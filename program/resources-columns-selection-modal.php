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



                        <div class="col-md-6 my-2">
                            <div><input type="checkbox" class="form-check-input" name="columns[]" value="fps" <?= (isset($_GET['columns']) && in_array('fps', $_GET['columns'])) ? 'checked' : ''; ?>> FPS Resources</div>
                            <div><input type="checkbox" class="form-check-input" name="columns[]" value="resourceName" <?= (isset($_GET['columns']) && in_array('resourceName', $_GET['columns'])) ? 'checked' : ''; ?>> Resource Name</div>
                            <div><input type="checkbox" class="form-check-input" name="columns[]" value="resourceType" <?= (isset($_GET['columns']) && in_array('resourceType', $_GET['columns'])) ? 'checked' : ''; ?>> Resource Type</div>
                            <div><input type="checkbox" class="form-check-input" name="columns[]" value="totalQuantity" <?= (isset($_GET['columns']) && in_array('totalQuantity', $_GET['columns'])) ? 'checked' : ''; ?>> Total Quantity</div>
                            <div><input type="checkbox" class="form-check-input" name="columns[]" value="quantityAvailable" <?= (isset($_GET['columns']) && in_array('quantityAvailable', $_GET['columns'])) ? 'checked' : ''; ?>> Quantity Available</div>
                        </div>

                        <div class="col-md-12 mb-3 text-center">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#showMore" aria-expanded="false" aria-controls="showMore">
                                Show more <i class="fa-solid fa-arrow-down"></i>
                            </button>
                        </div>
                        <div class="collapse row" id="showMore">
                            <div class="col-md-6 my-2">
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="p.fps" <?= (isset($_GET['columns']) && in_array('p.fps', $_GET['columns'])) ? 'checked' : ''; ?>> FPS Program</div>
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="programName" <?= (isset($_GET['columns']) && in_array('programName', $_GET['columns'])) ? 'checked' : ''; ?>> Program Name</div>
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="programType" <?= (isset($_GET['columns']) && in_array('programType', $_GET['columns'])) ? 'checked' : ''; ?>> Program Type</div>
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="startDate" <?= (isset($_GET['columns']) && in_array('startDate', $_GET['columns'])) ? 'checked' : ''; ?>> Start Date</div>
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="endDate" <?= (isset($_GET['columns']) && in_array('endDate', $_GET['columns'])) ? 'checked' : ''; ?>> End Date</div>
                            </div>
                            <div class="col-md-6 my-2">
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="totalBeneficiaries" <?= (isset($_GET['columns']) && in_array('totalBeneficiaries', $_GET['columns'])) ? 'checked' : ''; ?>> Total Beneficiaries</div>
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="beneficiariesAvailable" <?= (isset($_GET['columns']) && in_array('beneficiariesAvailable', $_GET['columns'])) ? 'checked' : ''; ?>> Beneficiaries Available</div>
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="sourcingAgency" <?= (isset($_GET['columns']) && in_array('sourcingAgency', $_GET['columns'])) ? 'checked' : ''; ?>> Sourcing Agency</div>
                                <div><input type="checkbox" class="form-check-input" name="columns[]" value="description" <?= (isset($_GET['columns']) && in_array('description', $_GET['columns'])) ? 'checked' : ''; ?>> Description</div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="text-end m-3"><button type="submit" class="btn btn-sm btn-success">Update Table</button></div>
            </form>
        </div>

    </div>
</div>