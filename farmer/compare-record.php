<?php
require_once '../backend/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    // echo json_encode($data);
    // exit;
    $farmer = $data[0]['farmer'];
    $farmerId = isset($farmer['farmer_id']) ? $farmer['farmer_id'] : null;
    $difference = "";
    $notMatchCount = 0;

    $changeKeyName = [
        'num_of_parcels' => 'no_of_parcels', 
        'ffrs' => 'ffrs_system_gen', 
        'lastName' => 'last_name',
        'middleName' => 'middle_name',
        'firstName' => 'first_name',
        'extName' => 'ext_name',
        'bday' => 'birthday',
        'brgy' => 'farmer_brgy_address',
        'municipality' => 'farmer_municipality_address',
        'province' => 'farmer_province_address',
        'deceased' => 'is_deceased',
        'govIdType' => 'gov_id_type',
        'govIdNumber' => 'gov_id_number',
    ];

    $dbrecordFarmer = getRecordsById('farmers', $farmerId, ['id', 'modified_times', 'selected_enrollment', 'is_archived', 'created_at', 'updated_at', 'fps_code', 'created_by']);
    $userRecordFarmer = removeAndCustomizeKeys($farmer, ['farmer_id'], $changeKeyName);

    if(!empty(array_diff($dbrecordFarmer, $userRecordFarmer))){
        $difference .= "<div style='text-align: left;'>
        <div class='text-center'><label class='fw-bold'>Farmer Information</label class='fw-bold'></div>
        <ul>";
        foreach ($userRecordFarmer as $key => $value) {
            if (array_key_exists($key, $dbrecordFarmer) && $dbrecordFarmer[$key] != $value) {
                $notMatchCount ++;
                $tittle = "";
                switch ($key) {
                    case "ffrs_system_gen":
                        $title = "FFRS number";
                        break;
                      case "gov_id_type":
                        $title = "Government ID type";
                        break;
                      case "gov_id_number":
                        $title = "Government ID number";
                        break;
                      case "hbp":
                        $title = "House/BLDG/Purok";
                        break;
                      case "sss":
                        $title = "Street/Sitio/SubDV";
                        break;
                      case "region":
                        $title = "Region";
                        break;
                      case "farmer_brgy_address":
                        $title = "Barangay";
                        break;
                      case "farmer_municipality_address":
                        $title = "Municipality";
                        break;
                      case "farmer_province_address":
                        $title = "Province";
                        break;
                      case "first_name":
                        $title = "First name";
                        break;
                      case "middle_name":
                        $title = "Middle name";
                        break;
                      case "last_name":
                        $title = "Last name";
                        break;
                      case "ext_name":
                        $title = "Extension name";
                        break;
                      case "gender":
                        $title = "Gender";
                        break;
                      case "bday":
                        $title = "Birthdate";
                        break;
                      case "no_of_parcels":
                        $title = "Number of Parcels";
                        break;
                    default:
                        $title = $key;
                        break;
                }
    
                $difference .= "
                <li><span class='fw-bold'>$title
                </span>: <span class='text-danger'>{$dbrecordFarmer[$key]}</span>
                <i class='bi bi-arrow-right'></i> 
                <span class='text-success'>$value</span>
                </li>
                ";
            }
        }
        $difference .= "</ul></div>";
    }

    foreach ($data as $item) { 

        if (isset($item['parcel'])) {
            $parcel = $item['parcel'];
            $difference .= "<div style='text-align: left;' class='mt-2'>";
            if (isset($parcel['parcel_id'])) {
            $changeKeyName = [
            'parcelNum' => 'parcel_no', 
            'ofName' => 'owner_first_name', 
            'olName' => 'owner_last_name', 
            'ownership' => 'ownership_type', 
            'farmLocationBrgy' => 'parcel_brgy_address', 
            'farmLocationMunicipality' => 'parcel_municipality_address', 
            'farmLocationProvince' => 'parcel_province_address', 
            'farmSize' => 'parcel_area', 
            'farmType' => 'farm_type'
            ];
        
            $dbrecord= getRecordsById('parcels', $parcel['parcel_id'], ['id', 'farmer_id', 'modified_times', 'is_archived', 'created_at', 'updated_at', 'fps_code']);
            $userRecord = removeAndCustomizeKeys($parcel, ['parcel_id'], $changeKeyName);
            if(!empty(array_diff($dbrecord, $userRecord)) || !empty(array_diff($userRecord, $dbrecord))){
            $difference .= "<div class='text-center'><span class='fw-bold'>Parcel #{$dbrecord['parcel_no']}</span></div>";
            foreach ($userRecord as $key => $value) {
                
                if (array_key_exists($key, $dbrecord) && $dbrecord[$key] != $value) {

                $notMatchCount ++;
                $title = "";
                switch ($key) {
                    case "owner_first_name":
                    $title = "Owner's First Name";
                    break;    
                    case "owner_last_name":
                    $title = "Owner's Last Name";
                    break;
                    case "ownership_type":
                    $title = "Ownership Type";
                    break;
                    case "parcel_brgy_address":
                    $title = "Parcel Barangay Address";
                    break;
                    case "parcel_municipality_address":
                    $title = "Parcel Municipality Address";
                    break;
                    case "parcel_province_address":
                    $title = "Parcel Province Address";
                    break;
                    case "parcel_area":
                    $title = "Parcel Area";
                    break;
                    case "parcel_no":
                    $title = "Parcel Number";
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
        

            if(!isset($parcel['parcel_id'])) {
            $userRecord = removeAndCustomizeKeys($parcel, ['parcel_id'], $changeKeyName);
            $difference .= "<div class='text-center'><span class='fw-bold'>ADD Parcel</span></div>";
            foreach ($userRecord as $key => $value) {
            $notMatchCount++;
            $title = "";
            switch ($key) {
                case 'parcel_no':
                $title = "Parcel Number";
                break;
                case 'owner_first_name':
                $title = "Owner's First Name";
                break;
                case 'owner_last_name':
                $title = "Owner's Last Name";
                break;
                case 'ownership_type':
                $title = "Ownership Type";
                break;
                case 'parcel_brgy_address':
                $title = "Parcel Barangay Address";
                break;
                case 'parcel_municipality_address':
                $title = "Parcel Municipality Address";
                break;
                case 'parcel_province_address':
                $title = "Parcel Province Address";
                break;
                case 'parcel_area':
                $title = "Parcel Area";
                break;
                case 'farm_type':
                $title = "Farm Type";
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

        if (isset($item['crop'])) {
            $crop = $item['crop'];
            $difference .= "<div style='text-align: left;' class='mt-2'>";
            $changeKeyName = [
                'cropArea' => 'crop_area',
                'cropName' => 'crop_name',
            ];
            if (isset($crop['crop_id'])) {
        
            $dbrecord = getRecordsById('crops', $crop['crop_id'], ['id', 'farmer_id', 'modified_times', 'is_archived', 'parcel_id', 'created_at', 'updated_at', 'fps_code']);
            $userRecord = removeAndCustomizeKeys($crop, ['crop_id', 'parcelNum'], $changeKeyName);
            if (!empty(array_diff($dbrecord, $userRecord)) || !empty(array_diff($userRecord, $dbrecord))) {
            $difference .= "<div class='text-center'><span class='fw-bold'>Crop</span></div>
            <li class='fw-bold'>Parcel #{$crop['parcelNum']}</li>
            ";
            foreach ($userRecord as $key => $value) {
            if (array_key_exists($key, $dbrecord) && $dbrecord[$key] != $value) {
                $notMatchCount++;
                $title = "";
                switch ($key) {
                case "crop_area":
                $title = "Crop Area";
                break;
                case "crop_name":
                $title = "Crop Name";
                break;
                case "hvc":
                $title = "High Value Crop?";
                $dbrecord[$key] = $dbrecord[$key] == 1? 'Yes': 'No';
                $value = $value == 1? 'Yes': 'No';
                break;
                case "classification":
                $title = "Classification";
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
        
            if (!isset($crop['crop_id'])) {
            $userRecord = removeAndCustomizeKeys($crop, ['crop_id', 'parcelNum'], $changeKeyName);
            $difference .= "<div class='text-center'><span class='fw-bold'>ADD Crop</span></div>
            <li class='fw-bold'>Parcel #{$crop['parcelNum']}</li>
            ";
            foreach ($userRecord as $key => $value) {
            $notMatchCount++;
            $title = "";
            switch ($key) {
            case 'crop_area':
                $title = "Crop Area";
                break;
            case 'crop_name':
                $title = "Crop Name";
                break;
            case "hvc":
                $title = "High Value Crop?";
                $value = $value == 1? 'Yes': 'No';
                break;
            case "classification":
                $title = "Classification";
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

        if (isset($item['livestock'])) {
            $livestock = $item['livestock'];
            $difference .= "<div style='text-align: left;' class='mt-2'>";
            $changeKeyName = [
                'numberOfHeads' => 'no_of_heads',
                'livestockType' => 'animal_name',
            ];
            if (isset($livestock['livestock_id'])) {

            $dbrecord = getRecordsById('livestocks', $livestock['livestock_id'], ['id', 'farmer_id', 'modified_times', 'is_archived', 'parcel_id', 'classification', 'created_at', 'updated_at', 'fps_code']);
            $userRecord = removeAndCustomizeKeys($livestock, ['livestock_id', 'parcelNum'], $changeKeyName);
            if (!empty(array_diff($dbrecord, $userRecord)) || !empty(array_diff($userRecord, $dbrecord))) {
                $difference .= "<div class='text-center'><span class='fw-bold'>Livestock</span></div>
                <li class='fw-bold'>Parcel #{$livestock['parcelNum']}</li>
                ";
                foreach ($userRecord as $key => $value) {
                if (array_key_exists($key, $dbrecord) && $dbrecord[$key] != $value) {
                    $notMatchCount++;
                    $title = "";
                    switch ($key) {
                    case "no_of_heads":
                        $title = "Number of Heads";
                        break;
                    case "animal_name":
                        $title = "Livestock Type";
                        break;
                    case "classification":
                        $title = "Classification";
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

            if (!isset($livestock['livestock_id'])) {
            $userRecord = removeAndCustomizeKeys($livestock, ['livestock_id', 'parcelNum'], $changeKeyName);
            $difference .= "<div class='text-center'><span class='fw-bold'>ADD Livestock</span></div>
                <li class='fw-bold'>Parcel #{$livestock['parcelNum']}</li>
            ";
            foreach ($userRecord as $key => $value) {
                $notMatchCount++;
                $title = "";
                switch ($key) {
                case 'no_of_heads':
                    $title = "Number of Heads";
                    break;
                case 'animal_name':
                    $title = "Livestock Type";
                    break;
                case "classification":
                    $title = "Classification";
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