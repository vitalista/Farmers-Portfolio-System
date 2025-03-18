<?php
try {
    if (in_array('resources_code', $selectedColumns)) {
        echo '<th  class="text-start">Resources FPS</th>';
    }

    if (in_array('resource_name', $selectedColumns)) {
        echo '<th  class="text-start">Resources Name</th>';
    }
    if (in_array('resource_type', $selectedColumns)) {
        echo '<th  class="text-start">Resources Type</th>';
    }
    if (in_array('total_quantity', $selectedColumns)) {
        echo '<th  class="text-start">Total Quantity</th>';
    }
    if (in_array('quantity_available', $selectedColumns)) {
        echo '<th  class="text-start">Quantity Available</th>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
