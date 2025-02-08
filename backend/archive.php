<?php
require '../backend/functions.php';
// if($_SESSION['LoggedInUser']['can_delete'] == 1){
  function archiveEntity($paramName, $tableName, $redirectUrl, $successMessage) {
    $id = checkParamId($paramName);

    if ($id && is_numeric($id)) {
        $id = validate($id);
        $category = getById($tableName, $id);

        $user_id = isset($_SESSION['LoggedInUser']['id']) ? $_SESSION['LoggedInUser']['id'] : 0;
        date_default_timezone_set('Asia/Taipei');
        $archivedAt =  date('Y-m-d h:i:s A');

        if ($category['status'] == 200) {
            $data = [   'is_archived' => 1,
                        'archived_by' =>  $user_id,
                        'archived_at' => $archivedAt];
            $archived = update($tableName, $id, $data);

            if ($archived) {
                
                if (!insertActivityLog($id, $user_id, $tableName, 'ARCHIVE')) {
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
    archiveEntity('parcel', 'parcels', '../farmer/farmer-view.php?id=' . checkParamId('farmer'), 'Successfully Archived');
}

// Archive parcel on list
if (checkParamId('parcel_id')) {
    archiveEntity('parcel_id', 'parcels', '../farmer-assets/parcels.php', 'Successfully Archived');
}

// Archive crop
if (checkParamId('crop')) {
  archiveEntity('crop', 'crops', '../farmer/farmer-view.php?id=' . checkParamId('farmer'), 'Successfully Archived');
}

// Archive crop on list
if (checkParamId('crop_id')) {
    archiveEntity('crop_id', 'crops', '../farmer-assets/crops.php', 'Successfully Archived');
}

// Archive livestock
if (checkParamId('livestock')) {
  archiveEntity('livestock', 'livestocks', '../farmer/farmer-view.php?id=' . checkParamId('farmer'), 'Successfully Archived');
}

// Archive livestock on list
if (checkParamId('livestock_id')) {
    archiveEntity('livestock_id', 'livestocks', '../farmer-assets/livestocks.php', 'Successfully Archived');
}

// Archive distributions on list
if (checkParamId('distributions_id')) {
    archiveEntity('distributions_id', 'distributions', '../distribution/distributions-list.php', 'Successfully Archived');
}

// Archive distributions
if (checkParamId('distributions')) {
    archiveEntity('distributions', 'distributions', '../program/program-view.php?id=' . checkParamId('program'), 'Successfully Archived');
}

// Archive farmer
if (checkParamId('id')) {
    archiveEntity('id', 'farmers', '../farmer/farmer-list.php', 'Successfully Archived');
}

// Archive program on list
if (checkParamId('program_id')) {
    archiveEntity('program_id', 'programs', '../program/programs-list.php', 'Successfully Archived');
}

// Archive recources on list
if (checkParamId('resources_id')) {
    archiveEntity('resources_id', 'resources', '../program/resources-list.php', 'Successfully Archived');
}

// Archive livestock
if (checkParamId('resources')) {
    archiveEntity('resources', 'resources', '../program/program-view.php?id=' . checkParamId('program'), 'Successfully Archived');
  }

// }else{
//   echo '<script>window.location.href = "index.html";</script>';
//   }
?>