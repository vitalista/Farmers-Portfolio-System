<?php
try {
if (in_array('farmer_code', $selectedColumns)) { echo '<th class="text-start notExport">Farmer FPS</th>'; }
if (in_array('parcel_no', $selectedColumns)) { echo '<th class="text-start notExport">Parcel No</th>'; }
if (in_array('owner_first_name', $selectedColumns)) { echo '<th class="text-start notExport">Owner First Name</th>'; }
if (in_array('owner_last_name', $selectedColumns)) { echo '<th class="text-start notExport">Owner Last Name</th>'; }
if (in_array('ownership_type', $selectedColumns)) { echo '<th class="text-start notExport">Ownership Type</th>'; }
if (in_array('parcel_brgy_address', $selectedColumns)) { echo '<th class="text-start notExport">Parcel Brgy Address</th>'; }
if (in_array('parcel_municipality_address', $selectedColumns)) { echo '<th class="text-start notExport">Parcel Municipality Address</th>'; }
if (in_array('parcel_province_address', $selectedColumns)) { echo '<th class="text-start notExport">Parcel Province Address</th>'; }
if (in_array('parcel_area', $selectedColumns)) { echo '<th class="text-start notExport">Parcel Area</th>'; }
if (in_array('farm_type', $selectedColumns)) { echo '<th class="text-start notExport">Farm Type</th>'; }

} catch (Exception $e) {
  echo 'Error: ' . $e->getMessage();
}