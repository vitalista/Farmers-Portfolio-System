<?php
try {
if (in_array('parcel_code', $selectedColumns)) { 
  echo '<th class="text-start">Parcel FPS</th>'; 
}
if (in_array('crop_name', $selectedColumns)) { 
  echo '<th class="text-start">Crop Name</th>'; 
}
if (in_array('crop_area', $selectedColumns)) { 
  echo '<th class="text-start">Crop Area</th>'; 
}
if (in_array('classification', $selectedColumns)) { 
  echo '<th class="text-start">Classification</th>'; 
}
if (in_array('hvc', $selectedColumns)) { 
  echo '<th class="text-start">HVC</th>'; 
}

} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}