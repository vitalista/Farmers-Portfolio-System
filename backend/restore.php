<?php
require '../backend/functions.php';
// if($_SESSION['LoggedInUser']['can_archive'] == 1){
  function archiveEntity($paramName, $tableName, $redirectUrl, $successMessage, $relatedTable = '') {
    $id = checkParamId($paramName);

    if ($id && is_numeric($id)) {
        $id = validate($id);
        $category = getById($tableName, $id);
        $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;

        if ($category['status'] == 200) {
            $data = [   'is_archived' => 0];
            $archived = update($tableName, $id, $data);

            if ($archived) {
                
                if (!insertActivityLog($id, $user_id, $tableName, 'RESTORE', $relatedTable)) {
                    redirect('programs-list.php', 500, 'Something Went Wrong');
                    exit;
                }

                redirect($redirectUrl, 200,$successMessage);
                exit; // Ensure we exit after redirect
            } else {
                redirect($redirectUrl, 500, 'Something Went Wrong');
                exit; // Ensure we exit after redirect
            }
        } else {
            redirect($redirectUrl, 500, $category['message']);
            exit; // Ensure we exit after redirect
        }
    } else {
        redirect($redirectUrl, 500, 'Something Went Wrong');
        exit; // Ensure we exit after redirect
    }
}

// Archive parcel
if (checkParamId('parcel')) {
    archiveEntity('parcel', 'parcels', '../farmer/farmer-view.php?id=' . checkParamId('farmer'), 'Successfully restored', 'farmers');
}

// Archive parcel on list
if (checkParamId('parcel_id')) {
    archiveEntity('parcel_id', 'parcels', '../farmer-assets/parcels.php', 'Successfully restored', 'farmers');
}

// Archive crop
if (checkParamId('crop')) {
  archiveEntity('crop', 'crops', '../farmer/farmer-view.php?id=' . checkParamId('farmer'), 'Successfully restored', 'farmers, parcels');
}

// Archive crop on list
if (checkParamId('crop_id')) {
    archiveEntity('crop_id', 'crops', '../farmer-assets/crops.php', 'Successfully restored', 'farmers, parcels');
}

// Archive livestock
if (checkParamId('livestock')) {
  archiveEntity('livestock', 'livestocks', '../farmer/farmer-view.php?id=' . checkParamId('farmer'), 'Successfully restored', 'farmers, parcels');
}

// Archive livestock on list
if (checkParamId('livestock_id')) {
    archiveEntity('livestock_id', 'livestocks', '../farmer-assets/livestocks.php', 'Successfully restored', 'farmers, parcels');
}

// Archive distributions on list
if (checkParamId('distributions_id')) {
    archiveEntity('distributions_id', 'distributions', '../distribution/distributions-list.php', 'Successfully restored', 'farmers');
}

// Archive distributions
if (checkParamId('distributions')) {
    archiveEntity('distributions', 'distributions', '../program/program-view.php?id=' . checkParamId('program'), 'Successfully restored', 'farmers');
}

// Archive farmer
if (checkParamId('id')) {
    archiveEntity('id', 'farmers', '../farmer/farmer-list.php', 'Successfully restored');
}

// Archive program on list
if (checkParamId('program_id')) {
    archiveEntity('program_id', 'programs', '../program/programs-list.php', 'Successfully restored');
}

// Archive recources on list
if (checkParamId('resources_id')) {
    archiveEntity('resources_id', 'resources', '../program/resources-list.php', 'Successfully restored', 'programs');
}

// Archive livestock
if (checkParamId('resources')) {
    archiveEntity('resources', 'resources', '../program/program-view.php?id=' . checkParamId('program'), 'Successfully restored', 'programs');
  }

// }else{
//   echo '<script>window.location.href = "index.html";</script>';
//   }
?>