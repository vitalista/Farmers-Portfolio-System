<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="registration"
            <?= (isset($_GET['columns']) && in_array('registration', $_GET['columns'])) ? 'checked' : ''; ?>> Registration
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="fps"
            <?= (isset($_GET['columns']) && in_array('fps', $_GET['columns'])) ? 'checked' : ''; ?>> FPS
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="ffrs"
            <?= (isset($_GET['columns']) && in_array('ffrs', $_GET['columns'])) ? 'checked' : ''; ?>> FFRS
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="first_name"
            <?= (isset($_GET['columns']) && in_array('first_name', $_GET['columns'])) ? 'checked' : ''; ?>> First Name
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="middle_name"
            <?= (isset($_GET['columns']) && in_array('middle_name', $_GET['columns'])) ? 'checked' : ''; ?>> Middle Name
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="last_name"
            <?= (isset($_GET['columns']) && in_array('last_name', $_GET['columns'])) ? 'checked' : ''; ?>> Last Name
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="ext_name"
            <?= (isset($_GET['columns']) && in_array('ext_name', $_GET['columns'])) ? 'checked' : ''; ?>> Ext Name
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="gender"
            <?= (isset($_GET['columns']) && in_array('gender', $_GET['columns'])) ? 'checked' : ''; ?>> Gender
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="birthday"
            <?= (isset($_GET['columns']) && in_array('birthday', $_GET['columns'])) ? 'checked' : ''; ?>> Birthday
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="barangay"
            <?= (isset($_GET['columns']) && in_array('barangay', $_GET['columns'])) ? 'checked' : ''; ?>> Barangay
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="municipality"
            <?= (isset($_GET['columns']) && in_array('municipality', $_GET['columns'])) ? 'checked' : ''; ?>> Municipality
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="province"
            <?= (isset($_GET['columns']) && in_array('province', $_GET['columns'])) ? 'checked' : ''; ?>> Province
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="no_of_parcels"
            <?= (isset($_GET['columns']) && in_array('no_of_parcels', $_GET['columns'])) ? 'checked' : ''; ?>> No. of Parcels
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="house_bldg_purok"
            <?= (isset($_GET['columns']) && in_array('house_bldg_purok', $_GET['columns'])) ? 'checked' : ''; ?>> House/BLDG/ Purok
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="street_sitio_subdv"
            <?= (isset($_GET['columns']) && in_array('street_sitio_subdv', $_GET['columns'])) ? 'checked' : ''; ?>> Street/Sitio/SubDV
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="region"
            <?= (isset($_GET['columns']) && in_array('region', $_GET['columns'])) ? 'checked' : ''; ?>> Region
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="gov_id_type"
            <?= (isset($_GET['columns']) && in_array('gov_id_type', $_GET['columns'])) ? 'checked' : ''; ?>> ID Type
    </div>
</div>
<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="gov_id_number"
            <?= (isset($_GET['columns']) && in_array('gov_id_number', $_GET['columns'])) ? 'checked' : ''; ?>> ID number
    </div>
</div>

<div class="col-md-6">
    <div><input type="checkbox" class="form-check-input" name="columns[]" value="selected_enrollment"
            <?= (isset($_GET['columns']) && in_array('selected_enrollment', $_GET['columns'])) ? 'checked' : ''; ?>> 
            Status
    </div>
</div>