<?php
require '../backend/functions.php';
// if($_SESSION['LoggedInUser']['can_delete'] == 1){
$paramResult = checkParamId('id');

if (is_numeric($paramResult)) {

  $id = validate($paramResult);
  $category = getById('farmers', $id);

  if ($category['status'] == 200) {

    $data = [
      'is_archived' => 1
    ];

    $archived = update('farmers', $id, $data);
    if ($archived) {

      redirect('farmer-list.php', 'Successfully Archived');
    } else {
      redirect('', 'Something Went Wrong');
    }
  } else {
    redirect('', $category['message']);
  }

  //echo $id;

} else {

  redirect('', 'Something Went Wrong');
}
// }else{
//   echo '<script>window.location.href = "index.html";</script>';
//   }
?>