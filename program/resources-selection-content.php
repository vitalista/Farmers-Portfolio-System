<div class="col-md-6 my-2">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="resources_code" <?= (isset($_GET['columns']) && in_array('resources_code', $_GET['columns'])) ? 'checked' : ''; ?>> FPS Resources</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="resource_name" <?= (isset($_GET['columns']) && in_array('resource_name', $_GET['columns'])) ? 'checked' : ''; ?>> Resource Name</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="resource_type" <?= (isset($_GET['columns']) && in_array('resource_type', $_GET['columns'])) ? 'checked' : ''; ?>> Resource Type</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="total_quantity" <?= (isset($_GET['columns']) && in_array('total_quantity', $_GET['columns'])) ? 'checked' : ''; ?>> Total Quantity</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="quantity_available" <?= (isset($_GET['columns']) && in_array('quantity_available', $_GET['columns'])) ? 'checked' : ''; ?>> Quantity Available</div>
</div>