
// Initialize Select2
$(document).ready(function () {
    $('.mySelect').select2({
        width: '100%'
    });

});


const columns = [0, 1, 2, 3, 4];

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

document.addEventListener("DOMContentLoaded", function () {
    const example = document.getElementById("example");

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
            action: function (e, dt, node, config) {
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
            action: function (e, dt, node, config) {

                config.customize = function (win) {
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
            action: function (e, dt, node, config) {
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
            action: function (e, dt, node, config) {
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
    if (!canExport()) {
        const dtButtons = document.querySelector('.dt-buttons');
        if (dtButtons) {
            dtButtons.style.display = 'none';
        }
    }

});