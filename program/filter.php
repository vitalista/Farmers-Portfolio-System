<?php
$archived = isset($_GET['archived']) && $_GET['archived'] == 1 ? '1' : '0';
$query = "
    SELECT
    * FROM programs
    WHERE 
        is_archived = ".$archived."
";

$whereConditions = [];
$params = [];
$types = "";


if (!empty($_GET['startDate'])) {
    $whereConditions[] = "start_date = ?";
    $params[] = validate($_GET['startDate']);
    $types .= "s"; 
}

if (!empty($_GET['endDate'])) {
    $whereConditions[] = "end_date = ?";
    $params[] = validate($_GET['endDate']);
    $types .= "s"; 
}

if (!empty($_GET['programName'])) {
    $whereConditions[] = "program_name = ?";
    $params[] = validate($_GET['programName']);
    $types .= "s";
}

if (!empty($_GET['programtype'])) {
    $whereConditions[] = "program_type = ?";
    $params[] = validate($_GET['programtype']);
    $types .= "s";
}

if (!empty($_GET['sourcingAgency'])) {
    $whereConditions[] = "sourcing_agency = ?";
    $params[] = validate($_GET['sourcingAgency']);
    $types .= "s";
}

if (!empty($_GET['totalBeneficiaries'])) {
    $totalBeneficiariesComp = validate($_GET['totalBeneficiariesComp']) ?? 'exact';
    $totalBeneficiaries = validate($_GET['totalBeneficiaries']);
    
    switch ($totalBeneficiariesComp) {
        case 'lessThan':
            $whereConditions[] = "total_beneficiaries < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "total_beneficiaries > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "total_beneficiaries = ?";
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
            $whereConditions[] = "beneficiaries_available < ?";
            break;
        case 'greaterThan':
            $whereConditions[] = "beneficiaries_available > ?";
            break;
        case 'exact':
        default:
            $whereConditions[] = "beneficiaries_available = ?";
            break;
    }
    $params[] = $availableBeneficiaries;
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</div>