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
                        <?php include 'program-selection-content.php'; ?>
                    </div>
                    <div class="text-end"><button type="submit" class="btn btn-sm btn-success">Update Table</button></div>
                </form>
            </div>

        </div>
    </div>
</div>