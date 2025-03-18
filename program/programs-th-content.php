<?php
if (in_array('program_code', $selectedColumns)) echo '<th  class="text-start">Program FPS</th>';
if (in_array('program_name', $selectedColumns)) echo '<th  class="text-start">Program Name</th>';
if (in_array('program_type', $selectedColumns)) echo '<th  class="text-start">Program Type</th>';
if (in_array('start_date', $selectedColumns)) echo '<th  class="text-start">Start Date</th>';
if (in_array('end_date', $selectedColumns)) echo '<th  class="text-start">End Date</th>';
if (in_array('total_beneficiaries', $selectedColumns)) echo '<th  class="text-start">Total Beneficiaries</th>';
if (in_array('beneficiaries_available', $selectedColumns)) echo '<th  class="text-start">Beneficiaries Available</th>';
if (in_array('sourcing_agency', $selectedColumns)) echo '<th  class="text-start">Sourcing Agency</th>';
if (in_array('description', $selectedColumns)) echo '<th  class="text-start">Description</th>';