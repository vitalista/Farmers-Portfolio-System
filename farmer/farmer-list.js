let totalEntries = getTotalEntries();

// Calculate 25%, 50%, and 75% of the total entries
let twentyFivePercent = Math.ceil(totalEntries * 0.25);
let fiftyPercent = Math.ceil(totalEntries * 0.50);
let seventyFivePercent = Math.ceil(totalEntries * 0.75);

let lengthMenuValues = [10, twentyFivePercent, fiftyPercent, seventyFivePercent, -1];
let lengthMenuLabels = [10,
  `${twentyFivePercent} (25%)`,
  `${fiftyPercent} (50%)`,
  `${seventyFivePercent} (75%)`,
  "Show All"
];

document.addEventListener("DOMContentLoaded", function() {
  const example = document.getElementById("example");

  setTimeout(() => {
    example.classList.remove("d-none");
    $('#example').DataTable({
      language: {
        emptyTable: `<span class="text-danger"><strong>No Farmer's Information Available</strong></span>`
      },
      dom: 'B<"table-top"lf>t<"table-bottom"ip>',
      responsive: true,
      buttons: [
        'copy', 'csv', 'print', 'excel', 'pdf'
      ],
      colReorder: true,
      fixedHeader: true,
      rowReorder: false,
      lengthMenu: [
        lengthMenuValues, // Values for entries
        lengthMenuLabels // Labels for entries
      ],

      columnDefs: [{
        targets: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9],
        render: function(data, type, row, meta) {
          if (type === 'display' || type === 'filter') {

            if (meta.col === 0) {
              if (data === "UNREGISTERED") {
                return `<button type="button" class="btn btn-danger ms-4" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-question-diamond-fill"></i></button>`;
              }
              if (data === "No information Available") {
                return data;
              }
              return `<button class="btn btn-success ms-4"><i class="bi bi-check-circle-fill"></i></button>`;
            }

          }
          return data;
        }
      }]
    });
  }, 500);
});

