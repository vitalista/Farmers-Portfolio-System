<div class="col-md-6 my-2">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="program_code" <?= (isset($_GET['columns']) && in_array('program_code', $_GET['columns'])) ? 'checked' : ''; ?>> FPS Program</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="program_name" <?= (isset($_GET['columns']) && in_array('program_name', $_GET['columns'])) ? 'checked' : ''; ?>> Program Name</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="program_type" <?= (isset($_GET['columns']) && in_array('program_type', $_GET['columns'])) ? 'checked' : ''; ?>> Program Type</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="start_date" <?= (isset($_GET['columns']) && in_array('start_date', $_GET['columns'])) ? 'checked' : ''; ?>> Start Date</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="end_date" <?= (isset($_GET['columns']) && in_array('end_date', $_GET['columns'])) ? 'checked' : ''; ?>> End Date</div>
</div>
<div class="col-md-6 my-2">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="total_beneficiaries" <?= (isset($_GET['columns']) && in_array('total_beneficiaries', $_GET['columns'])) ? 'checked' : ''; ?>> Total Beneficiaries</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="beneficiaries_available" <?= (isset($_GET['columns']) && in_array('beneficiaries_available', $_GET['columns'])) ? 'checked' : ''; ?>> Beneficiaries Available</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="sourcin_agency" <?= (isset($_GET['columns']) && in_array('sourcin_agency', $_GET['columns'])) ? 'checked' : ''; ?>> Sourcing Agency</div>
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="description" <?= (isset($_GET['columns']) && in_array('description', $_GET['columns'])) ? 'checked' : ''; ?>> Description</div>
</div>