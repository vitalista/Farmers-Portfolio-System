<?php
try {
if (in_array('farmer_code', $selectedColumns)) { echo '<th class="text-start">Farmer FPS</th>'; }
if (in_array('parcel_no', $selectedColumns)) { echo '<th class="text-start">Parcel No</th>'; }
if (in_array('owner_first_name', $selectedColumns)) { echo '<th class="text-start">Owner First Name</th>'; }
if (in_array('owner_last_name', $selectedColumns)) { echo '<th class="text-start">Owner Last Name</th>'; }
if (in_array('ownership_type', $selectedColumns)) { echo '<th class="text-start">Ownership Type</th>'; }
if (in_array('parcel_brgy_address', $selectedColumns)) { echo '<th class="text-start">Parcel Brgy Address</th>'; }
if (in_array('parcel_municipality_address', $selectedColumns)) { echo '<th class="text-start">Parcel Municipality Address</th>'; }
if (in_array('parcel_province_address', $selectedColumns)) { echo '<th class="text-start">Parcel Province Address</th>'; }
if (in_array('parcel_area', $selectedColumns)) { echo '<th class="text-start">Parcel Area</th>'; }
if (in_array('farm_type', $selectedColumns)) { echo '<th class="text-start">Farm Type</th>'; }

} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}