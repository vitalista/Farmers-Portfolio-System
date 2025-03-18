<?php
try {
    if (in_array('resources_code', $selectedColumns)) {
        echo '<td class="text-start">' . $row['resources_fps_code'] . '</td>';
    }
    if (in_array('resource_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['resources_name'] . '</td>';
    }
    if (in_array('resource_type', $selectedColumns)) {
        echo '<td class="text-start">' . $row['resource_type'] . '</td>';
    }
    if (in_array('total_quantity', $selectedColumns)) {
        echo '<td class="text-start">' . $row['total_quantity'] . '</td>';
    }
    if (in_array('quantity_available', $selectedColumns)) {
        echo '<td class="text-start">' . $row['quantity_available'] . '</td>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
