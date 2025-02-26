let totalEntries = getTotalEntries();
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
    $('#example').DataTable({
      dom: 'ftp',
      responsive: true,
      colReorder: true,
      fixedHeader: true,
      rowReorder: false,
      lengthMenu: [
        lengthMenuValues, // Values for entries
        lengthMenuLabels // Labels for entries
      ],
      columnDefs: [{
        targets: 0,
        render: function(data, type, row) {
          if (type === 'display' || type === 'filter') {
            return `<strong>${data}</strong>`;
          }
          return null;
        }
      }]
    });
  }, 500);
});