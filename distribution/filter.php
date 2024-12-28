<?php
$query = "
     SELECT   
		d.id,
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
        d.is_archived = 0
";

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

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
        </div>
    </div>
</div><!-- End Large Modal-->