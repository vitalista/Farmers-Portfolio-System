<?php
try {
    if (in_array('registration', $selectedColumns)) {
        echo '<td class="text-start">' . ($row['ffrs_system_gen'] === "" ? "UNREGISTERED" : "REGISTERED") . '</td>';
    }
    if (in_array('fps', $selectedColumns)) {
        echo '<td class="text-start"><strong>' . $row['fps_code'] . '</strong></td>';
    }
    if (in_array('ffrs', $selectedColumns)) {
        echo '<td class="text-start"><strong>' . $row['ffrs_system_gen'] . '</strong></td>';
    }
    if (in_array('first_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['first_name'] . '</td>';
    }
    if (in_array('middle_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['middle_name'] . '</td>';
    }
    if (in_array('last_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['last_name'] . '</td>';
    }
    if (in_array('ext_name', $selectedColumns)) {
        echo '<td class="text-start">' . $row['ext_name'] . '</td>';
    }
    if (in_array('gender', $selectedColumns)) {
        echo '<td class="text-start">' . $row['gender'] . '</td>';
    }
    if (in_array('birthday', $selectedColumns)) {
        echo '<td class="text-start">' . $row['birthday'] . '</td>';
    }
    if (in_array('barangay', $selectedColumns)) {
        echo '<td class="text-start">' . $row['farmer_brgy_address'] . '</td>';
    }
    if (in_array('municipality', $selectedColumns)) {
        echo '<td class="text-start">' . $row['farmer_municipality_address'] . '</td>';
    }
    if (in_array('province', $selectedColumns)) {
        echo '<td class="text-start">' . $row['farmer_province_address'] . '</td>';
    }
    if (in_array('no_of_parcels', $selectedColumns)) {
        echo '<td class="text-start">' . $row['no_of_parcels'] . '</td>';
    }
    if (in_array('house_bldg_purok', $selectedColumns)) {
        echo '<td class="text-start">' . $row['hbp'] . '</td>';
    }
    if (in_array('street_sitio_subdv', $selectedColumns)) {
        echo '<td class="text-start">' . $row['sss'] . '</td>';
    }
    if (in_array('region', $selectedColumns)) {
        echo '<td class="text-start">' . $row['region'] . '</td>';
    }
    if (in_array('gov_id_type', $selectedColumns)) {
        echo '<td class="text-start">' . $row['gov_id_type'] . '</td>';
    }
    if (in_array('gov_id_number', $selectedColumns)) {
        echo '<td class="text-start">' . $row['gov_id_number'] . '</td>';
    }
    if (in_array('selected_enrollment', $selectedColumns)) {
        echo '<td class="text-start">' . ($row['selected_enrollment'] === "" ? "NONE" : $row['selected_enrollment']) . '</td>';
    }
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
