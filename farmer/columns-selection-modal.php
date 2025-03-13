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
                        <div><input type="checkbox" class="form-check-input" name="columns[]" value="fps" 
                        <?= (isset($_GET['columns']) && in_array('fps', $_GET['columns'])) ? 'checked' : ''; ?>> FPS
                        </div>
                            
                        </div>

                    </div>
            </div>
            <div class="text-end m-3"><button type="submit" class="btn btn-sm btn-success">Update Table</button></div>
            </form>
        </div>

    </div>
</div>