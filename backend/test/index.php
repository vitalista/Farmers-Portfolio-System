<?php

// Function to check if an external URL is reachable with a timeout of 5 seconds
function checkUrl($url) {
    // Set timeout to 5 seconds
    $context = stream_context_create([
        'http' => [
            'timeout' => 3 // Timeout in seconds
        ]
    ]);
    
    // Use @ to suppress warnings if the URL is unreachable
    $headers = @get_headers($url, 0, $context);
    
    // Check if the URL is reachable (200 OK)
    if ($headers && strpos($headers[0], "200") !== false) {
        return true; // URL is reachable
    } else {
        return false; // URL is not reachable
    }
}

// List of URLs to check (CSS + JS)
$urls = [
    // "https://fonts.gstatic.com",
    "https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i",
    "https://cdn.datatables.net/2.1.7/js/dataTables.min.js",
    "https://cdn.datatables.net/buttons/3.1.2/js/dataTables.buttons.min.js",
    "https://cdn.datatables.net/buttons/3.1.2/js/buttons.html5.min.js",
    "https://cdn.datatables.net/buttons/3.1.2/js/buttons.print.min.js",
    "https://cdn.datatables.net/colreorder/2.0.4/js/dataTables.colReorder.min.js",
    "https://cdn.datatables.net/fixedheader/4.0.1/js/dataTables.fixedHeader.min.js",
    "https://cdn.datatables.net/responsive/3.0.3/js/dataTables.responsive.min.js",
    "https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.min.js",
    "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js",
    "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js",
    "https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js",
    "https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.min.css",
    "https://cdn.datatables.net/colreorder/2.0.4/css/colReorder.dataTables.min.css",
    "https://cdn.datatables.net/datetime/1.5.4/css/dataTables.dateTime.min.css",
    "https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.min.css",
    "https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.dataTables.min.css",
    "https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.css",
    // "https://unpkg.com/leaflet/dist/leaflet.css",
    "https://kit.fontawesome.com/27a54b8fcc.js",
    "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css",
    "https://code.jquery.com/jquery-3.7.0.min.js",
    "https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
];

// Check each URL
foreach ($urls as $url) {
    if (!checkUrl($url)) {
        echo "<script>console.log('Failed to load: " . $url . "');</script>";
        echo "<p style='color: red;'>('Failed to load: " . $url . "');</p><br>";
    } else {
        echo "<script>console.log('Successfully loaded: " . $url . "');</script>";
        echo "<p style='color: green;'>('Successfully loaded: " . $url . "');</p><br>";
    }
}

?>
