<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>
<?php include '../backend/auth-check.php'; ?>
<?php include '../backend/no-access.php'; ?>

<body>
    <?php
    $paramValue = checkParamId('id');
    if (!is_numeric($paramValue)) {
        echo '<h5>Not Available</h5>';
        return false;
    }
    $program = getById('programs', $paramValue);

    if ($program['status'] == 200) {
        $data = $program['data']
    ?>

        <fieldset class="card">
            <legend class="card-title ms-3">Program Details</legend>
            <div class="card-body row">

                <table class="table table-bordered">
                    <tr>
                        <th>Name of program:</th>
                        <td><?= $data['program_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Sourcing agency:</th>
                        <td><?= $data['sourcing_agency']; ?></td>
                    </tr>
                    <tr>
                        <th>Type:</th>
                        <td><?= $data['program_type']; ?></td>
                    </tr>
                    <tr>
                        <th>Start date:</th>
                        <td><?= $data['start_date'] == '0000-00-00' ? '' : $data['start_date']; ?></td>
                    </tr>
                    <tr>
                        <th>End date:</th>
                        <td><?= $data['end_date'] == '0000-00-00' ? '' : $data['end_date']; ?></td>
                    </tr>
                    <tr>
                        <th>Total beneficiaries:</th>
                        <td><?= $data['total_beneficiaries']; ?></td>
                    </tr>
                    <tr>
                        <th>Beneficiaries Available:</th>
                        <td><?= $data['beneficiaries_available']; ?></td>
                    </tr>
                    <tr>
                        <th>Description:</th>
                        <td><?= $data['description']; ?></td>
                    </tr>
                </table>
                <?php
                    $resources = getById('resources', $paramValue, false, true);
                    if ($resources['status'] == 200) {
                        foreach ($resources['data'] as $item) {
                    ?>
                    <h5 class="card-title <?= empty($resources['data']) ? 'd-none': '';?>">Resources List</h5>

                   
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td><?= $item['resources_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Type</th>
                                        <td><?= $item['resource_type']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Quantity/Amount</th>
                                        <td><?= $item['total_quantity']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Available Quantity/Amount</th>
                                        <td><?= $item['quantity_available']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Unit of Measure</th>
                                        <td><?= $item['unit_of_measure']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                    <?php
                        }
                    } ?>

                <?php
                $tableName = "distributions";
                $sql = "SELECT * FROM $tableName WHERE is_archived = 0 AND program_id = $paramValue";
                $result = $conn->query($sql);
                ?>

                <!-- Distributions -->
                <div class="table-responsive mb-3 mt-3 <?= $result->num_rows <= 0 ? 'd-none' : '' ?>">
                    <table class="table table-bordered table-striped">
                        <thead class="thead">
                            <tr>
                                <th class="text-start">FPS</th>
                                <th class="text-start">FFRS</th>
                                <th class="text-start">Farmer Name</th>
                                <th class="text-start">Program</th>
                                <th class="text-start">Resources</th>
                                <th class="text-start">Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="tbod">
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $farmerData = getById('farmers', $row['farmer_id']);
                                    $program = getById('programs', $row['program_id']);
                                    $resources = getById('resources', $row['resource_id']);
                                    if ($farmerData['status'] == 200 || $program['status'] == 200 || $resources['status'] == 200) {
                            ?>
                                        <tr>
                                            <td class="text-start"><?= $row['fps_code']; ?></td>
                                            <td class="text-start"><?= $farmerData['data']['ffrs_system_gen']; ?></td>
                                            <td class="text-start"><?= $farmerData['data']['first_name']; ?> <?= $farmerData['data']['last_name']; ?></td>
                                            <td class="text-start"><?= $program['data']['program_name']; ?></td>
                                            <td class="text-start"><strong><?= $resources['data']['resources_name']; ?></strong></td>
                                            <td class="text-start"><strong><?= $row['quantity_distributed']; ?></strong> <?= $resources['data']['unit_of_measure']; ?></td>
                                        </tr>
                            <?php
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </fieldset>

    <?php
    }
    ?>
    <script>
       window.onload = function() {
        window.print();

        window.onafterprint = function() {
            if (!window.matchMedia('print').matches) {
                window.close();
            }
        };
        };
    </script>
</body>

</html>