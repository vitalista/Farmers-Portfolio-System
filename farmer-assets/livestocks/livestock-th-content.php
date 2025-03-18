<?php
try {
if (in_array('parcel_code', $selectedColumns)) { 
  echo '<th class="text-start notExport">Parcel FPS</th>'; 
}
if (in_array('animal_name', $selectedColumns)) {
  echo '<td class="text-start"> Livestock</td>';
}
if (in_array('no_of_heads', $selectedColumns)) {
  echo '<td class="text-start">No. of Heads</td>';
}
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}