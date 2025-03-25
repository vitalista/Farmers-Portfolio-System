<?php
try {
if (in_array('parcel_code', $selectedColumns)) { 
  echo '<th class="text-start">Parcel FPS</th>'; 
}
if (in_array('animal_name', $selectedColumns)) {
  echo '<th class="text-start"> Livestock</th>';
}
if (in_array('no_of_heads', $selectedColumns)) {
  echo '<th class="text-start">No. of Heads</th>';
}
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}