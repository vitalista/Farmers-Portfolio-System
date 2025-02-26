<?php
    $target_id = $paramValue;

    $sql = "SELECT parcel_no FROM parcels WHERE farmer_id = ? ORDER BY parcel_no ASC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $target_id);

    $stmt->execute();
    $result = $stmt->get_result();

    $numbers = [];
    $missingNumbers = [];

    while ($row = $result->fetch_assoc()) {
        $numbers[] = $row['parcel_no'];
    }

    $has_gap = false;
    $largest_number = 0;
    for ($i = 0; $i < count($numbers); $i++) {
        if ($i > 0 && $numbers[$i] != $numbers[$i - 1] + 1) {
            $has_gap = true;
            for ($missing = $numbers[$i - 1] + 1; $missing < $numbers[$i]; $missing++) {
                array_push($missingNumbers, $missing - 1);
            }
        }
        $largest_number = max($largest_number, $numbers[$i]);
    }

    if (empty($missingNumbers)) {
        array_push($missingNumbers, $largest_number);
    }

    // print_r($missingNumbers);
    $missingNumbersJson = json_encode($missingNumbers);

    $conn->close();
?>
<script type="text/javascript">let missingNumbers = <?php echo $missingNumbersJson; ?>;</script>
