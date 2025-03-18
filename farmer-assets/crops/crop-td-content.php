<?php
try {
    if (in_array('parcel_code', $selectedColumns)) {
        echo '<td class="text-start">' . $row['parcel_code']  . '</td>';
    }
    if (in_array('crop_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['crop_name']  . '</td>';
    }
    if (in_array('crop_area', $selectedColumns)) {
        echo '<td class="text-start">' . $row['crop_area']  . '</td>';
    }
    if (in_array('classification', $selectedColumns)) {
        echo '<td class="text-start">' . $row['classification']  . '</td>';
    }
    if (in_array('hvc', $selectedColumns)) {
        echo '<td class="text-start">' . ($row['hvc'] == 1 ? 'yes' : 'no') . '</td>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
