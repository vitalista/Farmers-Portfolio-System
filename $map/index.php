<!DOCTYPE html>
<html lang="en">

<?php include '../includes/head.php' ?>
<style>
        #map { height: 75vh; }
</style>
<body class="login-bg">

   <!-- ======= Header ======= -->
   <?php include '../includes/header.php' ?>

   <!-- ======= Sidebar ======= -->
   <?php include '../includes/sidebar.php' ?>


   <main id="main" class="main">

      <section class="section main-table p-3">
      <h1>Map</h1>
      <div id="map"></div>
      </section>
   </main><!-- End #main -->

   <!-- ======= Footer ======= -->
   <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        const map = L.map('map').setView([0, 0], 2); // Default to world view

        // Add OpenStreetMap tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        }).addTo(map);

        // Fetch locations from the PHP script
        fetch('../backend/map-code.php')
            .then(response => response.json())
            .then(locations => {
                locations.forEach(location => {
                    const { farmer_name, latitude, longitude } = location;
                    L.marker([latitude, longitude]).addTo(map)
                        .bindPopup('<b>Owner: ' + farmer_name + '</b>')
                        .openPopup();
                });

                // Optionally set the view to the first location
                if (locations.length > 0) {
                    map.setView([locations[0].latitude, locations[0].longitude], 10);
                }
            })
            .catch(error => console.error('Error fetching location data:', error));
    </script>
   <?php include '../includes/footer.php' ?>
 
</body>

</html>