<?php
$archived = isset($_GET['archived']) && $_GET['archived'] == 1 ? '1' : '0';
$query = "
     SELECT * FROM farmers WHERE is_archived =  ".$archived."
";
$whereConditions = [];
$params = [];
$types = "";

if (!empty($_GET['farmer']) && !empty($_GET['farmerComparison'])) {
    $column = validate($_GET['farmerComparison']);
    $value = '%' . validate($_GET['farmer']) . '%';

    $whereConditions[] = "$column LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}

if (!empty($_GET['gender'])) {
    $whereConditions[] = "gender = ?";
    $params[] = validate($_GET['gender']);
    $types .= "s"; 
}

if (!empty($_GET['deceased'])) {
    $whereConditions[] = "is_deceased = ?";
    $params[] = validate($_GET['deceased']);
    $types .= "i"; 
}

if (!empty($_GET['birthday'])) {
    $whereConditions[] = "birthday = ?";
    $params[] = validate($_GET['birthday']);
    $types .= "s"; 
}

if (!empty($_GET['ffrs'])) {
    $whereConditions[] = "ffrs_system_gen = ?";
    $params[] = validate($_GET['ffrs']);
    $types .= "s"; 
}

if (!empty($_GET['farmerAdd']) && !empty($_GET['farmerAddComparison'])) {
    $column = validate($_GET['farmerAddComparison']);
    $value = '%' . validate($_GET['farmerAdd']) . '%';

    $whereConditions[] = "$column LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}


if (!empty($_GET['numberOfParcels'])) {
    $numberOfParcelsComp = validate($_GET['numberOfParcelsComp']) ?? 'exact';
    $numberOfParcels = validate($_GET['numberOfParcels']);
    
    switch ($numberOfParcelsComp) {
        case 'lessThan':
            $whereConditions[] = "no_of_parcels < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "no_of_parcels > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "no_of_parcels = ?";
            break;
    }
    $params[] = $numberOfParcels;
    $types .= "i";
}


if(!empty('created') && isset($_GET['created'])) {
    $created = validate($_GET['created']);
    switch ($created) {
        case 'today':
            $whereConditions[] = "created_at >= CURDATE() 
                                  AND created_at < CURDATE() + INTERVAL 1 DAY";
            break;
        case 'thisWeek':
            $whereConditions[] = "YEARWEEK(created_at, 1) = YEARWEEK(CURDATE(), 1)";
            break;
        case 'thisMonth':
            $whereConditions[] = "MONTH(created_at) = MONTH(CURDATE()) AND YEAR(created_at) = YEAR(CURDATE())";
            break;
        case 'thisYear':
            $whereConditions[] = "YEAR(created_at) = YEAR(CURDATE())";
            break;
        case 'dateRange':
            $fromCreated = validate($_GET['fromCreated']);
            $toCreated = validate($_GET['toCreated']);
            $whereConditions[] = "created_at BETWEEN ? AND ?";
            $params[] = $fromCreated;
            $params[] = $toCreated;
            $types .= "ss";
            break;
    }
}

if (!empty($whereConditions)) {
    $query .= " AND " . implode(" AND ", $whereConditions);
}

$limit = 10;
if (!empty($_GET['numOfEntries']) && is_numeric($_GET['numOfEntries'])) {
    $limit = (int)validate($_GET['numOfEntries']);
}

$query .= " LIMIT ?";

$params[] = $limit;
$types .= "i";

$stmt = $conn->prepare($query);

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();

$result = $stmt->get_result();

?>

<script>
    function getTotalEntries() {
        return <?= $result->num_rows; ?>
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
            <form id="filterForm" class="row" method="get">

                    <div class="col-md-4 mb-3">
                        <label for="created" class="form-label">Created</label>
                        <select id="created" name="created" class="form-select" onchange="toggleDateInputs(this.value)">
                            <option selected disabled>-- Choose --</option>
                            <option value="today">Today</option>
                            <option value="thisWeek">This Week</option>
                            <option value="thisMonth">This Month</option>
                            <option value="thisYear">This Year</option>
                            <option value="dateRange">Date Range</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="fromCreated" class="form-label">From</label>
                        <input type="date" name="fromCreated" id="fromCreated" class="form-control" disabled>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="toCreated" class="form-label">To</label>
                        <input type="date" name="toCreated" id="toCreated" class="form-control" disabled>
                    </div>

                    <script>
                        function toggleDateInputs(value) {
                            const fromDateInput = document.getElementById('fromCreated');
                            const toDateInput = document.getElementById('toCreated');
                            
                            if (value === 'dateRange') {
                                fromDateInput.disabled = false;
                                toDateInput.disabled = false;
                            } else {
                                fromDateInput.disabled = true;
                                toDateInput.disabled = true;
                            }
                        }
                    </script>

                    <div class="col-md-12 mb-3 text-center">
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#moreFilters" aria-expanded="false" aria-controls="moreFilters">
                            Show more <i class="fa-solid fa-arrow-down"></i>
                        </button>
                    </div>

                <div class="collapse row" id="moreFilters">

                    <div class="col-md-3 mb-3">
                        <label for="ffrs" class="form-label">FFRS SYSTEM GEN</label>
                        <input type="text" name="ffrs" id="ffrs" class="form-control" placeholder="Type here...">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="farmerComparison" class="form-label">Farmer<strong>(Contains)</strong></label>
                        <div class="input-group">
                            <select id="farmerComparison" class="form-select" name="farmerComparison">
                                <option value="last_name">Last Name</option>
                                <option value="first_name">First Name</option>
                                <option value="middle_name">Middle Name</option>
                                <option value="ext_name">Extension Name</option>
                            </select>
                            <input type="text" id="farmer" name="farmer" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" name="gender" class="form-select">
                            <option selected disabled>-- Select --</option>
                            <option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="birthday" class="form-label">Birthday <strong>(Filter by date)</strong></label>
                        <input type="date" name="birthday" id="birthday" class="form-control">
                    </div>

                   
                    <div class="col-md-3 mb-3">
                        <label for="farmerAddComparison" class="form-label">Farmer Address<strong>(Contains)</strong></label>
                        <div class="input-group">
                            <select id="farmerAddComparison" name="farmerAddComparison" class="form-select">
                                <option value="farmer_brgy_address">Barangay</option>
                                <option value="farmer_municipality_address">Municipality</option>
                                <option value="farmer_province_address">Province</option>
                            </select>
                            <input type="text" id="farmerAdd" name="farmerAdd" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="numberOfParcelsComp" class="form-label">Number of Parcels</label>
                        <div class="input-group">
                            <select id="numberOfParcelsComp" name="numberOfParcelsComp" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="noHeads" name="numberOfParcels" min="0" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Deceased?</label>
                        <div class="form-check">
                            <input class="form-check-input" name="deceased" style="width: 20px; height: 20px;" type="radio" id="decYes" value="1">
                            <label class="form-check-label" for="decYes">Yes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="deceased" style="width: 20px; height: 20px;" type="radio" id="decNo" value="0">
                            <label class="form-check-label" for="decNo">No</label>
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Archived?</label>
                        <div class="form-check">
                            <label class="form-check-label" for="archived">Yes</label>
                            <input class="form-check-input" style="width: 20px; height: 20px;" type="checkbox" id="archived" name="archived" value="1">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="numOfEntries" class="form-label">No. of <strong>(Entries)</strong></label>
                        <input type="number" id="numOfEntries" name="numOfEntries" class="form-control" min="0" placeholder="By default 10">
                    </div>

                </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>


                </form>
            </div>
            
        </div>
    </div>
</div>
<!-- End Filter Modal-->

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
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
          <button onclick="updateData(this)" type="button" id="save" class="btn btn-sm btn-primary"> <i class="fa-solid fa-floppy-disk"></i> Save</button>
        </div>
      </div>
    </div>
  </div><!-- End Unregistered Modal-->