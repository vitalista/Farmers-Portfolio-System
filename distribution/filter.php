<?php
$archived = isset($_GET['archived']) && $_GET['archived'] == 1 ? '1' : '0';
$query = "
     SELECT   
		d.id,
		d.fps_code,
        d.program_id,
        d.farmer_id,
        d.resource_id,
        f.ffrs_system_gen, 
        f.first_name, 
        f.middle_name,
        f.last_name,
		f.farmer_brgy_address,
        f.farmer_municipality_address,
        f.farmer_province_address,
        p.program_name, 
        p.program_type, 
        r.resources_name, 
        r.unit_of_measure, 
        r.resource_type, 
        d.quantity_distributed
    FROM 
        farmers AS f
    JOIN 
        distributions AS d ON f.id = d.farmer_id
    JOIN 
        programs AS p ON p.id = d.program_id
    JOIN 
        resources AS r ON r.id = d.resource_id
    WHERE 
        d.is_archived = ".$archived."
";

// echo $query;

$whereConditions = [];
$params = [];
$types = "";

if (!empty($_GET['farmer']) && !empty($_GET['farmerComparison'])) {
    $column = validate($_GET['farmerComparison']);
    $value = '%' . validate($_GET['farmer']) . '%';

    $whereConditions[] = "f.$column LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}

if (!empty($_GET['farmerAdd']) && !empty($_GET['farmerAddComparison'])) {
    $column = validate($_GET['farmerAddComparison']);
    $value = '%' . validate($_GET['farmerAdd']) . '%';

    $whereConditions[] = "f.$column LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}

if (!empty($_GET['programName'])) {
    $value = '%' . validate($_GET['programName']) . '%';
    $whereConditions[] = "p.program_name LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}

if (!empty($_GET['programType'])) {
    $value = '%' . validate($_GET['programType']) . '%';
    $whereConditions[] = "p.program_type LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}

if(!empty('created') && isset($_GET['created'])) {
    $created = validate($_GET['created']);
    switch ($created) {
        case 'today':
            $whereConditions[] = "d.created_at >= CURDATE() 
                                  AND d.created_at < CURDATE() + INTERVAL 1 DAY";
            break;
        case 'thisWeek':
            $whereConditions[] = "YEARWEEK(d.created_at, 1) = YEARWEEK(CURDATE(), 1)";
            break;
        case 'thisMonth':
            $whereConditions[] = "MONTH(d.created_at) = MONTH(CURDATE()) AND YEAR(d.created_at) = YEAR(CURDATE())";
            break;
        case 'thisYear':
            $whereConditions[] = "YEAR(d.created_at) = YEAR(CURDATE())";
            break;
        case 'dateRange':
            $fromCreated = validate($_GET['fromCreated']);
            $toCreated = validate($_GET['toCreated']);
            $whereConditions[] = "d.created_at BETWEEN ? AND ?";
            $params[] = $fromCreated;
            $params[] = $toCreated;
            $types .= "ss";
            break;
    }
}

if (!empty($_GET['resourcesName'])) {
    $value = '%' . validate($_GET['resourcesName']) . '%';
    $whereConditions[] = "r.resources_name LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}

if (!empty($_GET['resourceType'])) {
    $value = '%' . validate($_GET['resourceType']) . '%';
    $whereConditions[] = "r.resource_type LIKE ?";
    $params[] = $value;
    $types .= "s"; 
}

if (!empty($_GET['quantityDistributed'])) {
    $quantityDistributedComparison = validate($_GET['quantityDistributedComparison']) ?? 'exact';
    $quantityDistributed = validate($_GET['quantityDistributed']);
    
    switch ($quantityDistributedComparison) {
        case 'lessThan':
            $whereConditions[] = "d.quantity_distributed < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "d.quantity_distributed > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "d.quantity_distributed = ?";
            break;
    }
    $params[] = $quantityDistributed;
    $types .= "i";
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
                     <option selected disabled>--Choose--</option>
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
                        <label for="farmerComparison" class="form-label">Farmer<strong>(Contains)</strong></label>
                        <div class="input-group">
                            <select id="farmerComparison" class="form-select" name="farmerComparison">
                                <option value="last_name">Last Name</option>
                                <option value="first_name">First Name</option>
                                <option value="middle_name">Middle Name</option>
                                <option value="extension_name">Extension Name</option>
                            </select>
                            <input type="text" id="farmer" name="farmer" class="form-control" placeholder="Enter">
                        </div>
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
                        <label for="quantityDistributedComparison" class="form-label">Quantity Distributed</label>
                        <div class="input-group">
                            <select id="quantityDistributedComparison" name="quantityDistributedComparison" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="noHeads" name="quantityDistributed" min="0" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="programName" class="form-label">Program Name</label>
                        <input type="text" id="programName" name="programName" class="form-control" placeholder="Type here...">
                    </div>

                  
                    <div class="col-md-3 mb-3">
                        <label for="programType" class="form-label">Program Type</label>
                        <input type="text" id="programType" name="programType" class="form-control" placeholder="Type here...">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="resourcesName" class="form-label">Resources Name</label>
                        <input type="text" id="resourcesName" name="resourcesName" class="form-control" placeholder="Type here...">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="resourceType" class="form-label">Resources Type</label>
                        <input type="text" id="resourceType" name="resourceType" class="form-control" placeholder="Type here...">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="numOfEntries" class="form-label">No. of <strong>(Entries)</strong></label>
                        <input type="number" id="numOfEntries" name="numOfEntries" class="form-control" min="0" placeholder="By default 10">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Archived?</label>
                        <div class="form-check">
                            <label class="form-check-label" for="archived">Yes</label>
                            <input class="form-check-input" style="width: 20px; height: 20px;" type="checkbox" id="archived" name="archived" value="1">
                        </div>
                        </div>
                </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
        </div>
    </div>
</div><!-- End Large Modal-->