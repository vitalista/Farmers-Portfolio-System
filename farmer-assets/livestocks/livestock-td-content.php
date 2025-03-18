<?php
try {
    if (in_array('parcel_code', $selectedColumns)) {
        echo '<td class="text-start">' . $row['parcel_code']  . '</td>';
    }
    if (in_array('animal_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['animal_name']  . '</td>';
    }
    if (in_array('no_of_heads', $selectedColumns)) {
        echo '<td class="text-start">' . $row['no_of_heads']  . '</td>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
