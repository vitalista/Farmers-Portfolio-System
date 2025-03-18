<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="farmer_code"
            <?= (isset($_GET['columns']) && in_array('farmer_code', $_GET['columns'])) ? 'checked' : ''; ?>> farmer FPS
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="parcel_no"
            <?= (isset($_GET['columns']) && in_array('parcel_no', $_GET['columns'])) ? 'checked' : ''; ?>> Parcel No
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="owner_first_name"
            <?= (isset($_GET['columns']) && in_array('owner_first_name', $_GET['columns'])) ? 'checked' : ''; ?>> Owner First Name
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="owner_last_name"
            <?= (isset($_GET['columns']) && in_array('owner_last_name', $_GET['columns'])) ? 'checked' : ''; ?>> Owner Last Name
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="ownership_type"
            <?= (isset($_GET['columns']) && in_array('ownership_type', $_GET['columns'])) ? 'checked' : ''; ?>> Ownership Type
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="parcel_brgy_address"
            <?= (isset($_GET['columns']) && in_array('parcel_brgy_address', $_GET['columns'])) ? 'checked' : ''; ?>> Parcel Brgy Address
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="parcel_municipality_address"
            <?= (isset($_GET['columns']) && in_array('parcel_municipality_address', $_GET['columns'])) ? 'checked' : ''; ?>> Parcel Municipality Address
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="parcel_province_address"
            <?= (isset($_GET['columns']) && in_array('parcel_province_address', $_GET['columns'])) ? 'checked' : ''; ?>> Parcel Province Address
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="parcel_area"
            <?= (isset($_GET['columns']) && in_array('parcel_area', $_GET['columns'])) ? 'checked' : ''; ?>> Parcel Area
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="farm_type"
            <?= (isset($_GET['columns']) && in_array('farm_type', $_GET['columns'])) ? 'checked' : ''; ?>> Farm Type
    </div>
</div>