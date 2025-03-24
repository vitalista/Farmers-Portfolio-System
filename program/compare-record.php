<?php
require_once '../backend/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    // echo json_encode($data);
    // exit;
    $program = $data[0]['program'];
    $programId = isset($program['program_id']) ? $program['program_id'] : null;
    $difference = "";
    $notMatchCount = 0;

    $changeKeyName = [
        'nameOfProgram' => 'program_name',
        'programType' => 'program_type',
        'startDate' => 'start_date',
        'endDate' => 'end_date',
        'totalBeneficiaries' => 'total_beneficiaries',
        'beneficiaries' => 'beneficiaries_available',
        'sourcingAgency' => 'sourcing_agency',
        'programColor' => 'color'
    ];

    $dbrecord = getRecordsById('programs', $programId, ['id', 'modified_times', 'is_archived', 'created_at', 'updated_at', 'fps_code']);
    $userRecord = removeAndCustomizeKeys($program, ['program_id'], $changeKeyName);

    if (!empty(array_diff($dbrecord, $userRecord))) {
        $difference .= "<div style='text-align: left;'>
        <div class='text-center'><label class='fw-bold'>Program Information</label></div>
        <ul>";
        foreach ($userRecord as $key => $value) {
            if (array_key_exists($key, $dbrecord) && $dbrecord[$key] != $value) {
                $notMatchCount++;
                $title = "";
                switch ($key) {
                    case "program_name":
                        $title = "Program Name";
                        break;
                    case "program_type":
                        $title = "Program Type";
                        break;
                    case "start_date":
                        $title = "Start Date";
                        break;
                    case "end_date":
                        $title = "End Date";
                        break;
                    case "total_beneficiaries":
                        $title = "Total Beneficiaries";
                        break;
                    case "beneficiaries_available":
                        $title = "Beneficiaries Available";
                        break;
                    case "sourcing_agency":
                        $title = "Sourcing Agency";
                        break;
                    default:
                        $title = $key;
                        break;
                }

                $difference .= "
                <li><span class='fw-bold'>$title
                </span>: <span class='text-danger'>{$dbrecord[$key]}</span>
                <i class='bi bi-arrow-right'></i> 
                <span class='text-success'>$value</span>
                </li>
                ";
            }
        }
        $difference .= "</ul></div>";
    }

    foreach ($data as $item) { 

        if (isset($item['resources'])) {
            $resources = $item['resources'];
            $difference .= "<div style='text-align: left;' class='mt-2'>";
            $changeKeyName = [
                'resourcesName' => 'resources_name',
                'unitOfMeasure' => 'unit_of_measure',
                'resourcesType' => 'resource_type',
                'resourcesAvailable' => 'quantity_available',
                'resourcesNumber' => 'total_quantity',
            ];

            if (isset($resources['resources_id'])) {
                $dbrecord = getRecordsById('resources', $resources['resources_id'], ['id', 'modified_times', 'program_id', 'is_archived', 'created_at', 'updated_at', 'fps_code', 'color']);
                $userRecord = removeAndCustomizeKeys($resources, ['program_id', 'resources_id'], $changeKeyName);

                if (!empty(array_diff($dbrecord, $userRecord))) {
                    $difference .= "<div class='text-center'><span class='fw-bold'>Resources</span></div>";
                    foreach ($userRecord as $key => $value) {
                        if (array_key_exists($key, $dbrecord) && $dbrecord[$key] != $value) {
                            $notMatchCount++;
                            $title = "";
                            switch ($key) {
                                case "resources_name":
                                    $title = "Resource Name";
                                    break;
                                case "unit_of_measure":
                                    $title = "Unit of Measure";
                                    break;
                                case "resource_type":
                                    $title = "Resource Type";
                                    break;
                                case "quantity_available":
                                    $title = "Quantity Available";
                                    break;
                                case "total_quantity":
                                    $title = "Total Quantity";
                                    break;
                                default:
                                    $title = $key;
                                    break;
                            }

                            $difference .= "
                            <li><span class='fw-bold'>$title
                            </span>: <span class='text-danger'>{$dbrecord[$key]}</span>
                            <i class='bi bi-arrow-right'></i> 
                            <span class='text-success'>$value</span>
                            </li>
                            ";
                        }
                    }
                }
            }

            if (!isset($resources['resources_id'])) {
                $userRecord = removeAndCustomizeKeys($resources, ['program_id', 'resources_id'], $changeKeyName);
                $difference .= "<div class='text-center'><span class='fw-bold'>ADD Resources</span></div>";
                foreach ($userRecord as $key => $value) {
                    $notMatchCount++;
                    $title = "";
                    switch ($key) {
                        case 'resources_name':
                            $title = "Resource Name";
                            break;
                        case 'unit_of_measure':
                            $title = "Unit of Measure";
                            break;
                        case 'resource_type':
                            $title = "Resource Type";
                            break;
                        case 'quantity_available':
                            $title = "Quantity Available";
                            break;
                        case 'total_quantity':
                            $title = "Total Quantity";
                            break;
                        default:
                            $title = $key;
                            break;
                    }
                    $difference .= "
                    <li><span class='fw-bold'>$title</span>: 
                    <span class='text-success'>$value</span>
                    </li>
                    ";
                }
            }
            $difference .= "</div>";
        }
    }



    if ($notMatchCount == 0) {
    echo "<div class='text-center fw-bold'>No difference Found</div>";
    exit;
    }

    echo $difference;


} else {
    echo 'Invalid request method.';
}