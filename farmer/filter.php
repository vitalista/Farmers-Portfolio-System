<?php
$tableName = "farmers";

$sql = "SELECT * FROM $tableName LIMIT 100";
$result = $conn->query($sql);

?>
<script>
    function getTotalEntries() {
        return <?= $result->num_rows ?>;
    }
</script>

<div class="modal fade" id="ExtralargeModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                <form id="filterForm" class="row">


                    <div class="col-md-3 mb-3">
                        <label for="cropAreaComparison" class="form-label">Farmer<strong>(Contains)</strong></label>
                        <div class="input-group">
                            <select id="cropAreaComparison" class="form-select">
                                <option value="last_name">Last Name</option>
                                <option value="first_name">First Name</option>
                                <option value="middle_name">Middle Name</option>
                                <option value="extension_name">Extension Name</option>
                            </select>
                            <input type="text" id="cropArea" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" class="form-select">
                            <option selected disabled>-- Select --</option>
                            <option value="female">Female</option>
                            <option value="male">Male</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="birthday" class="form-label">Birthday <strong>(Filter by date)</strong></label>
                        <input type="date" id="birthday" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cropAreaComparison" class="form-label">Farmer Address<strong>(Contains)</strong></label>
                        <div class="input-group">
                            <select id="cropAreaComparison" class="form-select">
                                <option value="farmer_barangay">Barangay</option>
                                <option value="farmer_municipality">Municipality</option>
                                <option value="farmer_address">Province</option>
                            </select>
                            <input type="text" id="cropArea" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cropAreaComparison" class="form-label">Owner Name<strong>(Contains)</strong></label>
                        <div class="input-group">
                            <select id="cropAreaComparison" class="form-select">
                                <option value="owner_fname">Owner First Name</option>
                                <option value="owner_lname">Owner Last Name</option>
                                <option value="farmer_address">Province</option>
                            </select>
                            <input type="text" id="cropArea" class="form-control" placeholder="Enter">
                        </div>
                    </div>


                    <div class="col-md-2 mb-3">
                        <label for="ownershipType" class="form-label">Ownership Type</label>
                        <select id="ownershipType" class="form-select">
                            <option selected disabled>-- Select Type --</option>
                            <option value="tenant">Tenant</option>
                            <option value="lessee">Lessee</option>
                            <option value="registered_owner">Registered Owner</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cropAreaComparison" class="form-label">Parcel Address</label>
                        <div class="input-group">
                            <select id="cropAreaComparison" class="form-select">
                                <option value="barangay">Barangay</option>
                                <option value="municipality">Municipality</option>
                                <option value="province">Province</option>
                            </select>
                            <input type="text" id="cropArea" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cropname" class="form-label">Crop/Livestock Name <strong>(Contains)</strong></label>
                        <input type="text" id="cropname" class="form-control" placeholder="Enter crop/livestock name">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="parcelAreaComparison" class="form-label">Parcel Area</label>
                        <div class="input-group">
                            <select id="parcelAreaComparison" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="parcelArea" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cropAreaComparison" class="form-label">Crop Area</label>
                        <div class="input-group">
                            <select id="cropAreaComparison" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="cropArea" class="form-control" placeholder="Enter">
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="classification" class="form-label">Classification <strong>(isExact)</strong></label>
                        <input type="text" id="classification" class="form-control" placeholder="Enter classification">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="farmType" class="form-label">Farm Type</label>
                        <select id="farmType" class="form-select">
                            <option selected disabled>-- Select Farm Type --</option>
                            <option value="irrigated">Irrigated</option>
                            <option value="upland">Upland</option>
                            <option value="lowland">Lowland</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="noHeadsComparison" class="form-label">Number of Heads</label>
                        <div class="input-group">
                            <select id="noHeadsComparison" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="noHeads" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Active?</label>
                        <div class="form-check">
                            <input class="form-check-input" style="width: 20px; height: 20px;" type="checkbox" id="activeYes" value="yes">
                            <label class="form-check-label" for="activeYes">Yes</label>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">HVC?</label>
                        <div class="form-check">
                            <input class="form-check-input" style="width: 20px; height: 20px;" type="checkbox" id="activeYes" value="yes">
                            <label class="form-check-label" for="activeYes">Yes</label>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Deceased?</label>
                        <div class="form-check">
                            <input class="form-check-input" style="width: 20px; height: 20px;" type="checkbox" id="activeYes" value="yes">
                            <label class="form-check-label" for="activeYes">Yes</label>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="cropname" class="form-label">No. of <strong>(Entries)</strong></label>
                        <input type="text" id="cropname" class="form-control" placeholder="By default 10">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </div>
</div><!-- End Filter Modal-->
<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Provide FFRS code</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="col-md-12 mb-3">

            <label for="ffrsCode" class="form-label">Enter <strong>FFRS</strong> code</label>
            <input type="text" id="ffrsCode" class="form-control" placeholder="Type here...">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button onclick="updateData(this)" type="button" id="save" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div><!-- End Unregistered Modal-->