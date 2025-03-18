<?php
if (in_array('program_code', $selectedColumns)) echo '<td  class="text-start">' . $row['program_fps_code'] . '</td>';
if (in_array('program_name', $selectedColumns)) echo '<td  class="text-start">' . $row['program_name'] . '</td>';
if (in_array('program_type', $selectedColumns)) echo '<td  class="text-start">' . $row['program_type'] . '</td>';
if (in_array('start_date', $selectedColumns)) echo '<td  class="text-start">' . $row['start_date'] . '</td>';
if (in_array('end_date', $selectedColumns)) echo '<td  class="text-start">' . $row['end_date'] . '</td>';
if (in_array('total_beneficiaries', $selectedColumns)) echo '<td  class="text-start">' . $row['total_beneficiaries'] . '</td>';
if (in_array('beneficiaries_available', $selectedColumns)) echo '<td  class="text-start">' . $row['beneficiaries_available'] . '</td>';
if (in_array('sourcing_agency', $selectedColumns)) echo '<td  class="text-start">' . $row['sourcing_agency'] . '</td>';
if (in_array('description', $selectedColumns)) echo '<td  class="text-start">' . $row['description'] . '</td>';
