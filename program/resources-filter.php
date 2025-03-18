<?php
$archived = isset($_GET['archived']) && $_GET['archived'] == 1 ? '1' : '0';
$query = "
    SELECT
    r.id,
    r.fps_code AS resources_fps_code,
    r.program_id,
    r.resources_name,
    r.resource_type,
    r.total_quantity,
    r.quantity_available,
    r.unit_of_measure,

    p.fps_code AS program_fps_code,
    p.program_name,
    p.program_type,
    p.description,
    p.start_date,
    p.end_date,
    p.total_beneficiaries,
    p.beneficiaries_available,
    p.sourcing_agency,
    p.color

    FROM 
        resources AS r
    JOIN 
        programs AS p ON p.id = r.program_id
    WHERE 
        r.is_archived = ".$archived."
";

$whereConditions = [];
$params = [];
$types = "";


if (!empty($_GET['startDate'])) {
    $whereConditions[] = "p.start_date = ?";
    $params[] = validate($_GET['startDate']);
    $types .= "s"; 
}

if (!empty($_GET['endDate'])) {
    $whereConditions[] = "p.end_date = ?";
    $params[] = validate($_GET['endDate']);
    $types .= "s"; 
}

if (!empty($_GET['programName'])) {
    $whereConditions[] = "p.program_name = ?";
    $params[] = validate($_GET['programName']);
    $types .= "s";
}

if (!empty($_GET['programtype'])) {
    $whereConditions[] = "p.program_type = ?";
    $params[] = validate($_GET['programtype']);
    $types .= "s";
}

if (!empty($_GET['resourcesName'])) {
    $whereConditions[] = "r.resources_name = ?";
    $params[] = validate($_GET['resourcesName']);
    $types .= "s";
}

if (!empty($_GET['resourcestype'])) {
    $whereConditions[] = "r.resource_type = ?";
    $params[] = validate($_GET['resourcestype']);
    $types .= "s";
}

if (!empty($_GET['unitOfMeasure'])) {
    $whereConditions[] = "r.unit_of_measure = ?";
    $params[] = validate($_GET['unitOfMeasure']);
    $types .= "s";
}


if (!empty($_GET['sourcingAgency'])) {
    $whereConditions[] = "p.sourcing_agency = ?";
    $params[] = validate($_GET['sourcingAgency']);
    $types .= "s";
}

if (!empty($_GET['totalBeneficiaries'])) {
    $totalBeneficiariesComp = validate($_GET['totalBeneficiariesComp']) ?? 'exact';
    $totalBeneficiaries = validate($_GET['totalBeneficiaries']);
    
    switch ($totalBeneficiariesComp) {
        case 'lessThan':
            $whereConditions[] = "p.total_beneficiaries < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "p.total_beneficiaries > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "p.total_beneficiaries = ?";
            break;
    }
    $params[] = $totalBeneficiaries;
    $types .= "i";
}

if (!empty($_GET['availableBeneficiaries'])) {
    $availableBeneficiariesComp = validate($_GET['availableBeneficiariesComp']) ?? 'exact';
    $availableBeneficiaries = validate($_GET['availableBeneficiaries']);
    
    switch ($availableBeneficiariesComp) {
        case 'lessThan':
            $whereConditions[] = "p.beneficiaries_available < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "p.beneficiaries_available > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "p.beneficiaries_available = ?";
            break;
    }
    $params[] = $availableBeneficiaries;
    $types .= "i";
}

if (!empty($_GET['totalQuantity'])) {
    $totalQuantityComp = validate($_GET['totalQuantityComp']) ?? 'exact';
    $totalQuantity = validate($_GET['totalQuantity']);
    
    switch ($totalQuantityComp) {
        case 'lessThan':
            $whereConditions[] = "r.total_quantity < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "r.total_quantity > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "r.total_quantity = ?";
            break;
    }
    $params[] = $totalQuantity;
    $types .= "i";
}

if (!empty($_GET['quantityAvailable'])) {
    $quantityAvailableComp = validate($_GET['quantityAvailableComp']) ?? 'exact';
    $quantityAvailable = validate($_GET['quantityAvailable']);
    
    switch ($quantityAvailableComp) {
        case 'lessThan':
            $whereConditions[] = "r.quantity_available < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "r.quantity_available > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "r.quantity_available = ?";
            break;
    }
    $params[] = $quantityAvailable;
    $types .= "i";
}

if(!empty('created') && isset($_GET['created'])) {
    $created = validate($_GET['created']);
    switch ($created) {
        case 'today':
            $whereConditions[] = "r.created_at >= CURDATE() 
                                  AND r.created_at < CURDATE() + INTERVAL 1 DAY";
            break;
        case 'thisWeek':
            $whereConditions[] = "YEARWEEK(r.created_at, 1) = YEARWEEK(CURDATE(), 1)";
            break;
        case 'thisMonth':
            $whereConditions[] = "MONTH(r.created_at) = MONTH(CURDATE()) AND YEAR(r.created_at) = YEAR(CURDATE())";
            break;
        case 'thisYear':
            $whereConditions[] = "YEAR(r.created_at) = YEAR(CURDATE())";
            break;
        case 'dateRange':
            $fromCreated = validate($_GET['fromCreated']);
            $toCreated = validate($_GET['toCreated']);
            $whereConditions[] = "r.created_at BETWEEN ? AND ?";
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
                        <label for="programName" class="form-label">Program Name <strong>(Contains)</strong></label>
                        <input type="text" id="programName" name="programName" class="form-control" placeholder="Enter program">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="programtype" class="form-label">Program Type <strong>(Contains)</strong></label>
                        <input type="text" id="programtype" name="programtype" class="form-control" placeholder="Enter program type">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="sourcingAgency" class="form-label">Sourcing Agency<strong>(Contains)</strong></label>
                        <input type="text" id="sourcingAgency" name="sourcingAgency" class="form-control" placeholder="Enter program type">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="startDate" class="form-label">Start Date</label>
                        <input type="date" name="startDate" id="startDate" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="endDate" class="form-label">End Date</label>
                        <input type="date" name="endDate" id="endDate" class="form-control">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="totalBeneficiariesComp" class="form-label">Total Beneficiaries</label>
                        <div class="input-group">
                            <select id="totalBeneficiariesComp" name="totalBeneficiariesComp" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="totalBeneficiaries" name="totalBeneficiaries" min="0" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="availableBeneficiariesComp" class="form-label">Available Beneficiaries</label>
                        <div class="input-group">
                            <select id="availableBeneficiariesComp" name="availableBeneficiariesComp" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="availableBeneficiaries" name="availableBeneficiaries" min="0" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="resourcesName" class="form-label">Resources Name <strong>(Contains)</strong></label>
                        <input type="text" id="resourcesName" name="resourcesName" class="form-control" placeholder="Enter resources">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="resourcestype" class="form-label">Resources Type <strong>(Contains)</strong></label>
                        <input type="text" id="resourcestype" name="resourcestype" class="form-control" placeholder="Enter resources type">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="totalQuantityComp" class="form-label">Resources Total Quantity</label>
                        <div class="input-group">
                            <select id="totalQuantityComp" name="totalQuantityComp" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="totalQuantity" name="totalQuantity" min="0" class="form-control" placeholder="Enter">
                        </div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="quantityAvailableComp" class="form-label">Resources Quantity Available</label>
                        <div class="input-group">
                            <select id="quantityAvailableComp" name="quantityAvailableComp" class="form-select">
                                <option value="exact">Is Exact</option>
                                <option value="lessThan">Less Than</option>
                                <option value="greaterThan">Greater Than</option>
                            </select>
                            <input type="number" id="quantityAvailable" name="quantityAvailable" min="0" class="form-control" placeholder="Enter">
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