<?php
try {
    if (in_array('distribution_code', $selectedColumns)) {
        echo '<th class="text-start">Distribution FPS</th>';
    }
   
    if (in_array('distribution_date', $selectedColumns)) {
        echo '<th class="text-start">Distribution Date</th>';
    }
    if (in_array('quantity_distributed', $selectedColumns)) {
        echo '<th class="text-start">Quantity Distributed</th>';
    }
    if (in_array('remarks', $selectedColumns)) {
        echo '<th class="text-start">Remarks</th>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
