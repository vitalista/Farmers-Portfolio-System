<?php
try {
  if (in_array('registration', $selectedColumns)) { echo '<th class="text-start notExport">Registration</th>'; }
  if (in_array('fps', $selectedColumns)) { echo '<th class="text-start">FPS</th>'; }
  if (in_array('ffrs', $selectedColumns)) { echo '<th class="text-start">FFRS</th>'; }
  if (in_array('first_name', $selectedColumns)) { echo '<th class="text-start">First Name</th>'; }
  if (in_array('middle_name', $selectedColumns)) { echo '<th class="text-start">Middle Name</th>'; }
  if (in_array('last_name', $selectedColumns)) { echo '<th class="text-start">Last Name</th>'; }
  if (in_array('ext_name', $selectedColumns)) { echo '<th class="text-start">Ext Name</th>'; }
  if (in_array('gender', $selectedColumns)) { echo '<th class="text-start">Gender</th>'; }
  if (in_array('birthday', $selectedColumns)) { echo '<th class="text-start">Birthday</th>'; }
  if (in_array('barangay', $selectedColumns)) { echo '<th class="text-start">Barangay</th>'; }
  if (in_array('municipality', $selectedColumns)) { echo '<th class="text-start">Municipality</th>'; }
  if (in_array('province', $selectedColumns)) { echo '<th class="text-start">Province</th>'; }
  if (in_array('no_of_parcels', $selectedColumns)) { echo '<th class="text-start">No. of Parcels</th>'; }
  if (in_array('house_bldg_purok', $selectedColumns)) { echo '<th class="text-start">House/BLDG/ Purok</th>'; }
  if (in_array('street_sitio_subdv', $selectedColumns)) { echo '<th class="text-start">Street/Sitio/SubDV</th>'; }
  if (in_array('region', $selectedColumns)) { echo '<th class="text-start">Region</th>'; }
  if (in_array('gov_id_type', $selectedColumns)) { echo '<th class="text-start">ID Type</th>'; }
  if (in_array('gov_id_number', $selectedColumns)) { echo '<th class="text-start">ID number</th>'; }
  
  if (in_array('selected_enrollment', $selectedColumns)) { echo '<th class="text-start">Status</th>'; }
} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}