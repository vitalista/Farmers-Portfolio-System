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
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="distribution_code"
                                <?= (isset($_GET['columns']) && in_array('distribution_code', $_GET['columns'])) ? 'checked' : ''; ?>> Distribution FPS
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="distribution_date"
                                <?= (isset($_GET['columns']) && in_array('distribution_date', $_GET['columns'])) ? 'checked' : ''; ?>> Distribution Date
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="quantity_distributed"
                                <?= (isset($_GET['columns']) && in_array('quantity_distributed', $_GET['columns'])) ? 'checked' : ''; ?>> Quantity Distributed
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="remarks"
                                <?= (isset($_GET['columns']) && in_array('remarks', $_GET['columns'])) ? 'checked' : ''; ?>> Remarks
                        </div>
                    </div>

                        <div class="col-md-12 mb-3 text-center">
                            <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#showMore" aria-expanded="false" aria-controls="showMore">
                                Show more <i class="fa-solid fa-arrow-down"></i>
                            </button>
                        </div>
                        <div class="collapse row" id="showMore">
                        <h5 class="text-center">Program</h5>
                        <?php include '../program/program-selection-content.php'; ?>
                        <h5 class="text-center">Farmer</h5>
                        <?php include '../farmer/farmer-selection-content.php'; ?>  
                        <h5 class="text-center">Resources</h5>
                        <?php include '../program/resources-selection-content.php'; ?>
                      
                        </div>
                    </div>
            </div>
            <div class="text-end m-3"><button type="submit" class="btn btn-sm btn-success">Update Table</button></div>
            </form>
        </div>

    </div>
</div>