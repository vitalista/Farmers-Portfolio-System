<?php
try {
    if (in_array('farmer_code', $selectedColumns)) {
        echo '<td class="text-start">' . $row['farmer_code']  . '</td>';
    }
    if (in_array('parcel_no', $selectedColumns)) {
        echo '<td class="text-start">' . $row['parcel_no']  . '</td>';
    }
    if (in_array('owner_first_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['owner_first_name']  . '</td>';
    }
    if (in_array('owner_last_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['owner_last_name']  . '</td>';
    }
    if (in_array('ownership_type', $selectedColumns)) {
        echo '<td class="text-start">' . $row['ownership_type']  . '</td>';
    }
    if (in_array('parcel_brgy_address', $selectedColumns)) {
        echo '<td class="text-start">' . $row['parcel_brgy_address']  . '</td>';
    }
    if (in_array('parcel_municipality_address', $selectedColumns)) {
        echo '<td class="text-start">' . $row['parcel_municipality_address']  . '</td>';
    }
    if (in_array('parcel_province_address', $selectedColumns)) {
        echo '<td class="text-start">' . $row['parcel_province_address']  . '</td>';
    }
    if (in_array('parcel_area', $selectedColumns)) {
        echo '<td class="text-start">' . $row['parcel_area']  . '</td>';
    }
    if (in_array('farm_type', $selectedColumns)) {
        echo '<td class="text-start">' . $row['farm_type']  . '</td>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
