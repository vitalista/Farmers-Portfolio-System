<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" style="display: flex;">
        <div class="farmer" style="margin-right: 50px;">

        </div>
        <div class="parcel" style="margin-right: 50px; background-color: #E8E8E8; padding: 20px;">

        </div>
        <div class="crop" style="margin-right: 50px;">

        </div>
        <div class="livestock" style="margin-right: 50px; background-color: #E8E8E8; padding: 20px;">

        </div>
    </div>
<div class="unsorted">
<?php
// Database connection
$servername = "localhost";
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "baliwag_agriculture_office"; // your database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Decode JSON data
if (isset($_POST['farms_data'])) {
    $data = json_decode($_POST['farms_data'], true);
?>
<script>
    console.log(<?php echo json_encode($data);?>);
</script>
<?php

    // Insert farmer data (if present)
    $farmerId = 0;
    if (isset($data[0]['farmer'])) {
        $farmer = $data[0]['farmer'];
        $sql = "INSERT INTO farmers (ffrs_system_gen, farmer_brgy_address, farmer_municipality_address, farmer_province_address, first_name, last_name, ext_name, gender, birthday, is_deceased, is_active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssi", $farmer['ffrs'], $farmer['brgy'], $farmer['municipality'], $farmer['province'], $farmer['firstName'], $farmer['lastName'], $farmer['extName'], $farmer['gender'], $farmer['bday'], $farmer['deceased'], $farmer['active']);
        $stmt->execute();
        $farmerId = $stmt->insert_id;
    }

    // Insert parcel data
    $parcelIds = []; // Initialize an empty array to store parcelNum and corresponding insert_id.
    foreach ($data as $item) {
        if (isset($item['parcel'])) {
            $parcel = $item['parcel'];

            // SQL query to insert parcel information.
            $sql = "INSERT INTO parcels (
                  farmer_id, 
                  parcel_no, 
                  owner_first_name, 
                  owner_last_name, 
                  ownership_type, 
                  parcel_brgy_address, 
                  parcel_municipality_address, 
                  parcel_province_address, 
                  parcel_area, 
                  farm_type
              ) VALUES (
                  ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
              )";

            // Prepare the SQL statement.
            $stmt = $conn->prepare($sql);

            // Bind the parameters to the SQL query.
            $stmt->bind_param(
                "iissssssss",
                $farmerId,
                $parcel['parcelNum'],
                $parcel['ofName'],
                $parcel['olName'],
                $parcel['ownership'],
                $parcel['farmLocationBrgy'],
                $parcel['farmLocationMunicipality'],
                $parcel['farmLocationProvince'],
                $parcel['farmSize'],
                $parcel['farmType']
            );
            // Execute the statement.
            $stmt->execute();
            // After the insert, save the parcelNum and corresponding insert_id in the $parcelIds array.
            $parcelIds[$parcel['parcelNum']] = $stmt->insert_id;
        }
    }

    // Insert crop data
    foreach ($data as $item) {
        if (isset($item['crop'])) {
            $crop = $item['crop'];
            $parcelId = $parcelIds[$crop['parcelNum']] ?? null;
            if ($parcelId) {
                $sql = "INSERT INTO crops (farmer_id, parcel_id, hvc, crop_area, classification) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiiss", $farmerId, $parcelId, $crop['hvc'], $crop['cropArea'], $crop['classification']);
                $stmt->execute();
            }
        }
    }

    // Insert livestock data
    foreach ($data as $item) {
        if (isset($item['livestock'])) {
            $livestock = $item['livestock'];
            $parcelId = $parcelIds[$livestock['parcelNum']] ?? null;
            if ($parcelId) {
                $sql = "INSERT INTO livestocks (farmer_id, parcel_id, no_of_heads, animal_name) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iiis", $farmerId, $parcelId, $livestock['numberOfHeads'], $livestock['livestockType']);
                $stmt->execute();
            }
        }
    }

    echo '<div style="position: fixed; top: 20px; right: 20px; padding: 10px 20px; background-color: green; color: white; font-size: 16px; border-radius: 5px;">Data inserted successfully!</div>';


    // Debug: Print decoded data to ensure structure is correct
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';

    // Check if decoding was successful
    if ($data) {
    foreach ($data as $item) {
        // Check if 'farmer' key exists in the current item
        if (isset($item['farmer'])) {
            echo '<div class="farmer"><h3>Farmer Information:</h3>';
            echo '<pre style="color: green; font-weight: bold;">';
            print_r($item['farmer']);
            echo '</pre></div>';
        }

        // Check if 'parcel' key exists in the current item
        if (isset($item['parcel'])) {
            echo '<div class="parcel"><h3>Parcel Information:</h3>';
            echo '<pre style="color: red; font-weight: bold;">';
            print_r($item['parcel']);
            echo '</pre></div>';
        }

        if (isset($item['crop'])) {
            echo '<div class="crop"><h3>Crop Information:</h3>';
            echo '<pre style="color: blue; font-weight: bold;">';
            print_r($item['crop']);
            echo '</pre></div>';
        }

        if (isset($item['livestock'])) {
            echo '<div class="livestock"><h3>Livestock Information:</h3>';
            echo '<pre style="font-weight: bold;">';
            print_r($item['livestock']);
            echo '</pre></div>';
        }
    }
} else {
    echo "Failed to decode JSON data.";
}

    $conn->close();
}
// Check if decoding was successful
?>
</div>
</body>
</html>
<script>
    // Get the container with the unsorted divs
let container = document.querySelector('.unsorted'); // Replace with your container selector

// Get the new parent div where matching divs will be appended
let farmer = document.querySelector('.farmer');
let parcel = document.querySelector('.parcel');
let crop = document.querySelector('.crop');
let livestock = document.querySelector('.livestock');

// Loop through all div elements inside the container
let divs = container.querySelectorAll('div'); // Select all divs in the container
divs.forEach(function(div) {
  // Check if the className of the div is '1'
  if (div.className === 'farmer') {
    // Append the div to the new parent div
    farmer.appendChild(div);
  }

  if (div.className === 'parcel') {
    // Append the div to the new parent div
    parcel.appendChild(div);
  }

  if (div.className === 'crop') {
    // Append the div to the new parent div
    crop.appendChild(div);
  }

  if (div.className === 'livestock') {
    // Append the div to the new parent div
    livestock.appendChild(div);
  }
});

</script>
