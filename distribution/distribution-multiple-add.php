<!DOCTYPE html>
<html lang="en">

<?php
include '../includes/head.php';

if (!isset($_SESSION['resourceItems'])) {
    $_SESSION['resourceItems'] = [];
}

?>

<body class="login-bg">
    <?php include '../includes/header.php' ?>

    <!-- ======= Sidebar ======= -->
    <?php include '../includes/sidebar.php' ?>

    <!-- ======= Main ======= -->
    <main class="main" id="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12 main-table">
                    <?php include '../backend/status-messages.php'; ?>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Distribution</h5>
                            <div>
                                <a onclick="window.history.back()" class="btn btn-sm btn-danger">Back</a>
                            </div>
                        </div>

                        <!-- Default Tabs -->

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Single</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Multiple</button>
                            </li>
                        </ul>



                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="card mt-4 shadow-sm">

                                    <div class="card-header d-flex justify-content-between">
                                        <h5>Single distribution</h5>
                                    </div>

                                    <div class="card-body">

                                        <?php

                                        // if (isset($_SESSION['resourceItems'])) {
                                        //     echo '<pre>';
                                        //     print_r($_SESSION['resourceItems']);
                                        //     echo '</pre>';
                                        // }
                                        // session_unset();
                                        ?>

                                        <form action="distribution-code.php" method="POST">
                                            <div class="row">
                                                <style>
                                                    .select2-container .select2-selection--single {
                                                        padding-bottom: 40px;
                                                    }

                                                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                                                        line-height: 40px;
                                                    }
                                                </style>

                                                <div class="col-md-4 mb-3">
                                                    <label for="farmers">Farmers</label>
                                                    <select id="farmers" class="mySelect" name="farmer_id">
                                                        <option selected disabled>-- Select Farmer --</option>
                                                        <?php
                                                        $farmers = getAll('farmers');
                                                        if (mysqli_num_rows($farmers) > 0) {
                                                            foreach ($farmers as $item) {
                                                        ?>
                                                                <option value="<?= $item['id'] ?>"><?= $item['ffrs_system_gen'] ?> -
                                                                    <?= $item['first_name'] ?>
                                                                    <?= $item['last_name'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-4 mb-3">
                                                    <label for="resources">Resources</label>
                                                    <select id="resources" class="mySelect" name="resources_id">
                                                        <option selected disabled>-- Select Resources --</option>
                                                        <?php
                                                        $farmers = getAll('resources');
                                                        if (mysqli_num_rows($farmers) > 0) {
                                                            foreach ($farmers as $item) {
                                                        ?>
                                                                <option value="<?= $item['id'] ?>"><?= $item['quantity_available'] ?> -
                                                                    <?= $item['unit_of_measure'] ?>
                                                                    <?= $item['resource_type'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <div class="col-md-1 mb-3">
                                                    <label>Quantity</label>
                                                    <input type="number" name="quantity" min="1" value="1" required class="form-control">
                                                </div>

                                                <div class="col-md-3 mb-3 text-end mt-4">
                                                    <button type="submit" name="addItem" class="btn btn-sm btn-warning">Distribute</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                                <div class="card mt-4 shadow-sm">

                                    <div class="card-header d-flex justify-content-between">
                                        <h5>Multiple distributions</h5>
                                    </div>

                                    <div class="card-body">

                                        <?php
                                        // if (isset($_SESSION['resourceItems'])) {
                                        //     echo '<pre>';
                                        //     print_r($_SESSION['resourceItems']);
                                        //     echo '</pre>';
                                        // }
                                        // session_unset();
                                        ?>

                                        <form action="distribution-code.php" method="POST">
                                            <div class="row">
                                                <!-- Resources Dropdown -->
                                                <div class="col-md-4 mb-3">
                                                    <label for="resources1">Resources</label>
                                                    <select id="resources1" class="mySelect" name="resources_id">
                                                        <option selected disabled>-- Select Resources --</option>
                                                        <?php
                                                        $farmers = getAll('resources');
                                                        if (mysqli_num_rows($farmers) > 0) {
                                                            foreach ($farmers as $item) {
                                                        ?>
                                                                <option value="<?= $item['id'] ?>"><?= $item['quantity_available'] ?> -
                                                                    <?= $item['unit_of_measure'] ?>
                                                                    <?= $item['resource_type'] ?></option>
                                                        <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                                <!-- Criteria Button (Modal Trigger) -->
                                                <div class="col-md-1 mb-3">
                                                    <label>Criteria</label>
                                                    <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">Select</button>
                                                </div>

                                                <!-- Quantity Input -->
                                                <div class="col-md-1 mb-3">
                                                    <label>Quantity</label>
                                                    <input type="number" name="quantity" min="1" value="1" required class="form-control">
                                                </div>

                                                <!-- Submit Button -->
                                                <div class="col-md-6 mb-3 text-end mt-4">
                                                    <button type="submit" name="addItems" class="btn btn-sm btn-warning">Distribute</button>
                                                </div>
                                            </div>

                                            <!-- Modal Form (Filter Options) -->
                                            <div class="modal fade" id="ExtralargeModal" tabindex="-1" aria-labelledby="ExtralargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="ExtralargeModalLabel">Criteria</h5>
                                                            <button type="button" class="btn btn-sm-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                                                            <div class="row">
                                                                <!-- Filter Form -->
                                                                <!-- <div class="col-md-3 mb-3">
                                                                    <label for="farmerComparison" class="form-label">Farmer (Contains)</label>
                                                                    <div class="input-group">
                                                                        <select id="farmerComparison" class="form-select" name="farmerComparison">
                                                                            <option value="last_name">Last Name</option>
                                                                            <option value="first_name">First Name</option>
                                                                            <option value="middle_name">Middle Name</option>
                                                                            <option value="extension_name">Extension Name</option>
                                                                        </select>
                                                                        <input type="text" id="farmer" name="farmer" class="form-control" placeholder="Enter">
                                                                    </div>
                                                                </div> -->

                                                                <div class="col-md-3 mb-3">
                                                                    <label for="farmerAddComparison" class="form-label">Farmer Address (Contains)</label>
                                                                    <div class="input-group">
                                                                        <select id="farmerAddComparison" name="farmerAddComparison" class="form-select">
                                                                            <option value="farmer_brgy_address">Barangay</option>
                                                                            <option value="farmer_municipality_address">Municipality</option>
                                                                            <option value="farmer_province_address">Province</option>
                                                                        </select>
                                                                        <input type="text" id="farmerAdd" name="farmerAdd" class="form-control" placeholder="Enter">
                                                                    </div>
                                                                </div>

                                                                <!-- Other fields like Program Name, Resources, etc. -->
                                                                <!-- <div class="col-md-3 mb-3">
                                                                    <label for="programName" class="form-label">Program Name</label>
                                                                    <input type="text" id="programName" name="programName" class="form-control" placeholder="Type here...">
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <label for="programType" class="form-label">Program Type</label>
                                                                    <input type="text" id="programType" name="programType" class="form-control" placeholder="Type here...">
                                                                </div>

                                                                <div class="col-md-3 mb-3">
                                                                    <label class="form-label">Archived?</label>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" id="archived" name="archived" value="1">
                                                                        <label class="form-check-label" for="archived">Yes</label>
                                                                    </div>
                                                                </div> -->
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="addItems" class="btn btn-sm btn-warning">Distribute</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-3">

                            <div class="card-header">
                                <h5 class="mb-0"></h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered table-striped" id="example">
                                        <?php //$_SESSION['status']; 
                                        ?>
                                        <thead class="thead">
                                            <tr>
                                                <th class="text-start">FFRS</th>
                                                <th class="text-start">Farmer Name</th>
                                                <th class="text-start">Program</th>
                                                <th class="text-start">Resources</th>
                                                <th class="text-start">Quantity</th>
                                                <th class="text-start">Remove</th>
                                            </tr>
                                        </thead>




                                        <tbody class="tbod">
                                            <?php
                                            if (isset($_SESSION['resourceItems']) && $_SESSION['resourceItems'] != null) {
                                                $sessionProducts = $_SESSION['resourceItems'];
                                                if (empty($sessionProducts)) {
                                                    unset($sessionProducts['resourceItems']);
                                                }
                                                foreach ($sessionProducts as $key => $item) :
                                            ?>
                                                    <tr>
                                                        <td class="text-start"><strong><?= $item['ffrs_code']; ?></strong></td>
                                                        <td class="text-start"><?= $item['farmer_name']; ?></td>
                                                        <td class="text-start"><?= $item['program']; ?></td>
                                                        <td class="text-start"><?= $item['resource_name']; ?> - <?= $item['resource_type']; ?></td>
                                                        <td class="text-start">
                                                            <div class="input-group qtyBox">
                                                                <p style="width: 50px; padding: 6px 3px; text-align: center; border: 1px solid #cfb1b1; outline: 0; margin-right: 1px;"><?= $item['quantity']; ?></p>

                                                                <p class="ms-1 mb-0"><?= $item['unit_of_measure']; ?></p>
                                                            </div>
                                                        </td>
                                                        <td class="text-start">
                                                            <a href="distribution-code.php?index=<?= $item['farmer_id']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></a>
                                                        </td>
                                                    </tr>

                                            <?php
                                                endforeach;
                                            }
                                            ?>

                                        </tbody>


                                    </table>
                                </div>

                                <hr>

                            </div>
                        </div>

                        <div class="row d-flex justify-content-end">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="distribution-code.php?clear=true" class="btn btn-sm btn-secondary me-2"><i class="bi bi-trash3-fill" style="color: red;"></i></a>

                                <form action="distribution-code.php" method="post">
                                    <button type="submit" class="btn btn-sm btn-success" name="saveItem"><i class="fa-solid fa-floppy-disk"></i> Save</button>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </section>
    </main>

    <!-- ======= Footer ======= -->
    <?php include '../includes/footer.php' ?>
    <script>
        // Initialize Select2
        $(document).ready(function() {
            $('.mySelect').select2({
                width: '100%'
            });

        });

        let totalEntries = <?= count($_SESSION['resourceItems']); ?>;

        // Calculate 25%, 50%, and 75% of the total entries
        let twentyFivePercent = Math.ceil(totalEntries * 0.25);
        let fiftyPercent = Math.ceil(totalEntries * 0.5);
        let seventyFivePercent = Math.ceil(totalEntries * 0.75);

        let lengthMenuValues = [
            10,
            twentyFivePercent,
            fiftyPercent,
            seventyFivePercent,
            -1,
        ];
        let lengthMenuLabels = [
            10,
            `${twentyFivePercent} (25%)`,
            `${fiftyPercent} (50%)`,
            `${seventyFivePercent} (75%)`,
            "Show All",
        ];

        document.addEventListener("DOMContentLoaded", function() {
            const example = document.getElementById("example2");
            const columns = [0, 1, 2, 3, 4];

            setTimeout(() => {
                example.classList.remove("d-none");
                $("#example2").DataTable({
                    language: {
                        emptyTable: `<span class="text-danger"><strong>No Item Available</strong></span>`
                    },
                    dom: 'B<"table-top"lf>t<"table-bottom d-flex"ip>',
                    responsive: true,
                    buttons: [{
                            extend: "copy",
                            title: "Baliwag Agriculture Office",
                            exportOptions: {
                                columns: columns, // Specify the columns you want to copy
                                modifier: {
                                    page: "all", // Only copy the data on the all page
                                },
                            },
                        },

                        {
                            extend: "csv",
                            title: "Baliwag Agriculture Office",
                            action: function(e, dt, node, config) {
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.csvHtml5.action(e, dt, node, config);
                            },
                        },
                        {
                            extend: "print",
                            action: function(e, dt, node, config) {

                                config.customize = function(win) {
                                    $(win.document.body)
                                        .css("font-size", "12pt")
                                        .find("h1")
                                        .replaceWith(
                                            '<h4 style="font-weight: bold;"><img style="width: 30px; margin: 0px 0px 4px 0px" src="../assets/img/Agri Logo.png" alt="">Baliwag Agriculture Office</h4>'
                                        );
                                };
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.print.action(e, dt, node, config);
                            },
                        },
                        {
                            extend: "excel",
                            title: "Baliwag Agriculture Office",
                            action: function(e, dt, node, config) {
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, node, config);
                            },
                        },
                        {
                            extend: "pdf",
                            title: "Baliwag Agriculture Office",
                            action: function(e, dt, node, config) {
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, node, config);
                            },
                        },
                    ],
                    colReorder: true,
                    fixedHeader: true,
                    rowReorder: false,
                    lengthMenu: [lengthMenuValues, lengthMenuLabels],
                });
            }, 500);

        });

        document.addEventListener("DOMContentLoaded", function() {
            const example = document.getElementById("example");
            const columns = [0, 1, 2, 3, 4];

            setTimeout(() => {
                example.classList.remove("d-none");
                $("#example").DataTable({
                    language: {
                        emptyTable: `<span class="text-danger"><strong>No Item Available</strong></span>`,
                    },
                    dom: 'B<"table-top"lf>t<"table-bottom"ip>',
                    responsive: true,
                    buttons: [{
                            extend: "copy",
                            title: "Baliwag Agriculture Office",
                            exportOptions: {
                                columns: columns, // Specify the columns you want to copy
                                modifier: {
                                    page: "all", // Only copy the data on the all page
                                },
                            },
                        },

                        {
                            extend: "csv",
                            title: "Baliwag Agriculture Office",
                            action: function(e, dt, node, config) {
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.csvHtml5.action(e, dt, node, config);
                            },
                        },
                        {
                            extend: "print",
                            action: function(e, dt, node, config) {

                                config.customize = function(win) {
                                    $(win.document.body)
                                        .css("font-size", "12pt")
                                        .find("h1")
                                        .replaceWith(
                                            '<h4 style="font-weight: bold;"><img style="width: 30px; margin: 0px 0px 4px 0px" src="../assets/img/Agri Logo.png" alt="">Baliwag Agriculture Office</h4>'
                                        );
                                };
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.print.action(e, dt, node, config);
                            },
                        },
                        {
                            extend: "excel",
                            title: "Baliwag Agriculture Office",
                            action: function(e, dt, node, config) {
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.excelHtml5.action(e, dt, node, config);
                            },
                        },
                        {
                            extend: "pdf",
                            title: "Baliwag Agriculture Office",
                            action: function(e, dt, node, config) {
                                config.exportOptions = {
                                    columns: columns,
                                    modifier: {
                                        page: "all",
                                    },
                                };

                                $.fn.dataTable.ext.buttons.pdfHtml5.action(e, dt, node, config);
                            },
                        },
                    ],
                    colReorder: true,
                    fixedHeader: true,
                    rowReorder: false,
                    lengthMenu: [lengthMenuValues, lengthMenuLabels],
                });
            }, 500);

        });
    </script>






</body>

</html>