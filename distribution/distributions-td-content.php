<?php
try {
    if (in_array('distribution_code', $selectedColumns)) {
        echo '<td class="text-start">' . $row['distribution_code'] . '</td>';
    }
   
    if (in_array('distribution_date', $selectedColumns)) {
        echo '<td class="text-start">' . $row['distribution_date'] . '</td>';
    }
    if (in_array('quantity_distributed', $selectedColumns)) {
        echo '<td class="text-start">' . $row['quantity_distributed'] . '</td>';
    }
    if (in_array('remarks', $selectedColumns)) {
        echo '<td class="text-start">' . $row['remarks'] . '</td>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
