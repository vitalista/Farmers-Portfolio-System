<?php
require '../backend/functions.php';
// if($_SESSION['LoggedInUser']['can_delete'] == 1){
  function archiveEntity($paramName, $tableName, $redirectUrl, $successMessage) {
    $id = checkParamId($paramName);

    if ($id && is_numeric($id)) {
        $id = validate($id);
        $category = getById($tableName, $id);

        if ($category['status'] == 200) {
            $data = ['is_archived' => 1];
            $archived = update($tableName, $id, $data);

            if ($archived) {
                redirect($redirectUrl, $successMessage);
                exit; // Ensure we exit after redirect
            } else {
                redirect('', 'Something Went Wrong');
                exit; // Ensure we exit after redirect
            }
        } else {
            redirect('', $category['message']);
            exit; // Ensure we exit after redirect
        }
    } else {
        redirect('', 'Something Went Wrong');
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

// Archive livestock
if (checkParamId('livestock')) {
  archiveEntity('livestock', 'livestocks', '../farmer/farmer-view.php?id=' . checkParamId('farmer'), 'Successfully Archived');
}


// Archive farmer
if (checkParamId('id')) {
    archiveEntity('id', 'farmers', '../farmer/farmer-list.php', 'Successfully Archived');
}

// }else{
//   echo '<script>window.location.href = "index.html";</script>';
//   }
?>