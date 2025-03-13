<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<body class="login-bg">
    <?php include '../includes/header.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../includes/sidebar.php' ?>
    <!-- Database -->

    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body main-table">
                            <?php include '../backend/status-messages.php'; ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-header">Programs list</h5>
                                <div>
                                    <a href="programs-list.php" class="btn btn-sm btn-danger"> 
                                        <i class="bi bi-arrow-counterclockwise"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                                        <i class="bi bi-sort-down"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success d-none" data-bs-toggle="modal" data-bs-target="#columnSelectionModal">
                                    <i class="bi bi-table"></i>
                                    </button>
                                    <?php if ($_SESSION['LoggedInUser']['can_create'] == 1) { ?>
                                        <a href="program-add.php" class="btn btn-sm btn-secondary"><i class="bi bi-plus-lg"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php include 'filter.php'; ?>
                            <?php include 'column-selection-modal.php'; ?>

                            <table id="example"  class="display nowrap d-none">
                                <thead>
                                    <tr>
                                        <?php
                                        $selectedColumns = isset($_GET['columns']) ? $_GET['columns'] : ['programName', 'startDate', 'endDate', 'fps'];

                                        if (in_array('fps', $selectedColumns)) echo '<th  class="text-start">FPS</th>';
                                        if (in_array('programName', $selectedColumns)) echo '<th  class="text-start">Program Name</th>';
                                        if (in_array('programType', $selectedColumns)) echo '<th  class="text-start">Program Type</th>';
                                        if (in_array('startDate', $selectedColumns)) echo '<th  class="text-start">Start Date</th>';
                                        if (in_array('endDate', $selectedColumns)) echo '<th  class="text-start">End Date</th>';
                                        if (in_array('totalBeneficiaries', $selectedColumns)) echo '<th  class="text-start">Total Beneficiaries</th>';
                                        if (in_array('beneficiariesAvailable', $selectedColumns)) echo '<th  class="text-start">Beneficiaries Available</th>';
                                        if (in_array('sourcingAgency', $selectedColumns)) echo '<th  class="text-start">Sourcing Agency</th>';
                                        if (in_array('description', $selectedColumns)) echo '<th  class="text-start">Description</th>';
                                        ?>

                                        <th class="text-start notExport">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <?php
                                                if (in_array('fps', $selectedColumns)) echo '<td  class="text-start">' . $row['fps_code'] . '</td>';
                                                if (in_array('programName', $selectedColumns)) echo '<td  class="text-start">' . $row['program_name'] . '</td>';
                                                if (in_array('programType', $selectedColumns)) echo '<td  class="text-start">' . $row['program_type'] . '</td>';
                                                if (in_array('startDate', $selectedColumns)) echo '<td  class="text-start">' . $row['start_date'] . '</td>';
                                                if (in_array('endDate', $selectedColumns)) echo '<td  class="text-start">' . $row['end_date'] . '</td>';
                                                if (in_array('totalBeneficiaries', $selectedColumns)) echo '<td  class="text-start">' . $row['total_beneficiaries'] . '</td>';
                                                if (in_array('beneficiariesAvailable', $selectedColumns)) echo '<td  class="text-start">' . $row['beneficiaries_available'] . '</td>';
                                                if (in_array('sourcingAgency', $selectedColumns)) echo '<td  class="text-start">' . $row['sourcing_agency'] . '</td>';
                                                if (in_array('description', $selectedColumns)) echo '<td  class="text-start">' . $row['description'] . '</td>';
                                                ?>


                                                <?php if (!isset($_GET['archived'])): ?>
                                                    <td class="text-start">
                                                        <?php if ($_SESSION['LoggedInUser']['can_edit'] == 1) { ?>
                                                            <a href="program-view.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-box2-fill"></i></a>
                                                        <?php } ?>
                                                        <?php if ($_SESSION['LoggedInUser']['can_archive'] == 1) { ?>
                                                            <a onclick="return confirm('Are you sure you want to archive it?')"
                                                                href="../backend/archive.php?program_id=<?= $row['id']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-archive-fill"></i></a>
                                                        <?php } ?>
                                                        <?php if ($_SESSION['LoggedInUser']['role'] == 1) { ?>
                                                            <a href="../backend/activity-logs.php?id=<?= $row['id']; ?>&programs=Program"
                                                                class="btn btn-sm btn-secondary"><i class="bi bi-info-circle-fill"></i></a>
                                                        <?php } ?>
                                                    </td>
                                                <?php else: ?>
                                                    <td class="text-start">
                                                        <a onclick="return confirm('Are you sure you want to restore it?')"
                                                            href="../backend/restore.php?program_id=<?= $row['id']; ?>" class="btn btn-sm btn-primary"><i class="bi bi-arrow-repeat"></i></a>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>

                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>
    <script src="../assets/js/dttable.js"></script>
</body>

</html>