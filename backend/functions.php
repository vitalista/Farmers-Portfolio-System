<?php
require 'database.php';
session_set_cookie_params([
    'lifetime' => 3600,  
    'path' => '/',
    'domain' => '', 
    'secure' => true,  
    'httponly' => true, 
    'samesite' => 'Lax'
]);

session_start();
if (isset($_SESSION['LoggedInUser']) || !empty($_SESSION['LoggedInUser'])) {
if (isset($_SESSION["LAST_ACTIVITY"])) {
    $session_timout = 6000; // dont set less than 60
    $session_timout_reset = 60;
    if ((time() - $_SESSION["LAST_ACTIVITY"]) > $session_timout) { 
        setLastAct();       
        session_unset();   
        session_destroy();
        session_start();
        redirect('../login', 404, 'Session Expired');
    } else if ((time() - $_SESSION["LAST_ACTIVITY"]) > $session_timout_reset) {    
        $_SESSION["LAST_ACTIVITY"] = time();  
    }
}
$_SESSION["LAST_ACTIVITY"] = time();
}

$_SESSION['LoggedIn'] = true;
$_SESSION['LoggedInUser']['role'] = 1;
$_SESSION['LoggedInUser']['can_edit'] = 1;
$_SESSION['LoggedInUser']['can_create'] = 1;
$_SESSION['LoggedInUser']['can_archive'] = 1;
$_SESSION['LoggedInUser']['can_export'] = 1;
$_SESSION['LoggedInUser']['id'] = 3;
$_SESSION['LoggedInUser']['full_name'] = "DEV";

function setLastAct() {
    $id = (int)$_SESSION['LoggedInUser']['id'];

    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        redirect('../logout.php?=notINT', 500, 'Something Went Wrong');
        return false;
    }

    global $conn;
    $query = "UPDATE users SET last_activity = NOW() WHERE id = ?";

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        redirect('../logout.php?=STMTX', 500, 'Something Went Wrong');
        return false;
    }
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    return true;
}


function includes($file_path)
{
    if (file_exists($file_path) && is_file($file_path)) {
        return include $file_path;
    }

    return '';
}

function page($path, $page, $border = false)
{
    if ($path == $page) {
        if (file_exists($page) && is_file($page)) {
            if ($border) {
                return 'border-left: 5px solid var(--li-text-color-hover);';
            }
            return 'color: var(--li-text-color-hover);';
        }
    }

    return '';
}

class Page{
    private static $instance = null;
    private $page;
    private function __construct(){
        $this->page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
    }

    public static function getInstance(){
        if (self::$instance === null) {
            self::$instance = new Page();
        }
        // Return the instance
        return self::$instance;
    }

    public function getPage(){
        return $this->page;
    }
}

?>

<script>
    const entryFade = (card) => {
        card.setAttribute('data-aos', 'fade-out');
        card.setAttribute('data-aos-duration', '500');
    }

    const removalFade = (card) => {
        card.style.opacity = '1';
        card.style.transition = 'opacity 0.5s ease';
        card.style.opacity = '0';
    }
    <?php if(isset($_SESSION['LoggedInUser']['can_export'])){?>
    const canExport = () =>{
        return <?= $_SESSION['LoggedInUser']['can_export'] === 1? true: false;?>
    }

    localStorage.setItem('fullName', '<?= addslashes($_SESSION['LoggedInUser']['full_name']); ?>');
    
    <?php }?>
</script>

<?php

// Input field validation
function validate($inputData)
{
    global $conn;
    $validatedData = mysqli_real_escape_string($conn, $inputData);
    $data = trim($validatedData);
    return htmlspecialchars($data);
}

// Redirect from one page to another page with a message (Status)
function redirect($url, $status, $message)
{
    $_SESSION['status'] = $status;
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit(0);
}

function checkPassword($userInputPassword, $storedPasswordHash) {

    if (password_verify($userInputPassword, $storedPasswordHash)) {
        return true; // Password matches
    } else {
        return false; // Password does not match
    }
}

// Display messages or status after any process
function alertMessage()
{
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert"
        style="text-align: center; font-weight: bold;"
        >' .
            $_SESSION['status'] .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        unset($_SESSION['status']);
    }
}

function countRows($table, $condition = "", $brgy = "", $gender = "") {
    // Validate inputs
    $tableName = validate($table);
    $conditions = validate($condition);
    $brgy = validate($brgy);
    $gender = validate($gender);

    global $conn;

    // Base query for counting rows
    $query = "";

    // Handle special cases for 'parcels', 'livestocks', and 'crops'
    if ($tableName == 'parcels') {
        $query = "SELECT COUNT(*) AS totalRows FROM parcels p, farmers f WHERE p.farmer_id = f.id AND p.is_archived = 0 AND f.is_archived = 0";
    } elseif ($tableName == 'livestocks' || $tableName == 'crops') {
        $query = "SELECT COUNT(*) AS totalRows FROM parcels p, farmers f, $tableName l WHERE 
                  l.farmer_id = f.id AND 
                  l.parcel_id = p.id AND 
                  l.is_archived = 0 AND 
                  f.is_archived = 0 AND 
                  p.is_archived = 0";
    } else {
        // Default query for other tables
        $query = "SELECT COUNT(*) AS totalRows FROM $tableName WHERE is_archived = 0";
    }

    // Add barangay filter if provided
    if (!empty($brgy)) {
        if ($tableName == 'farmers') {
            $query .= " AND farmer_brgy_address = '$brgy'";
        } else {
            $query .= " AND f.farmer_brgy_address = '$brgy'";
        }
    }

    // Add gender filter if provided
    if (!empty($gender) && ($gender == 'MALE' || $gender == 'FEMALE')) {
        $gender = validate($gender);
        $query .= " AND UPPER(gender) = '$gender'";
    }

    // Add conditions for programs if provided
    if (!empty($conditions)) {
        switch ($conditions) {
            case 'pending_programs':
                $query .= " AND start_date > CURDATE() AND start_date != '0000-00-00'";
                break;
            case 'expired_programs':
                $query .= " AND end_date < CURDATE() AND end_date != '0000-00-00'";
                break;
            case 'ongoing_programs':
                $query .= " AND start_date <= CURDATE() AND end_date >= CURDATE() AND end_date != '0000-00-00' AND start_date != '0000-00-00'";
                break;
        }
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['totalRows'];
    } else {
        // Log the error and return 0
        error_log("Database error: " . mysqli_error($conn));
        return 0;
    }
}

function returnNullRows($table, $brgy = "") {

    global $conn;

    if(empty($table)) {
        return 0;
    }

        // Validate and sanitize inputs
        $validTables = ['parcels'];  // List of allowed tables
        if (!in_array($table, $validTables)) {
            return 0;  // Invalid table name
        }

    
    $query = "SELECT SUM(p.owner_first_name = '' AND p.owner_last_name = '') AS all_null_rows FROM $table p, farmers f WHERE p.farmer_id = f.id AND p.is_archived = 0 AND f.is_archived = 0";

    if (!empty($brgy)) {
        validate($brgy);
        $query = "SELECT SUM(p.owner_first_name = '' AND p.owner_last_name = '') AS all_null_rows FROM parcels p, farmers f WHERE p.farmer_id = f.id AND p.is_archived = 0 AND f.is_archived = 0 AND f.farmer_brgy_address = '$brgy'";
    }
   

//    echo "<script>console.log('returnNullRows Query: " . addslashes($query) . "');</script>";

   $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        return $row['all_null_rows'] == null? 0 : $row['all_null_rows'];
    } else {
        echo "Error: " . mysqli_error($conn);
        return 0;
    }
    
}


function sumColumn($table, $column, $brgy = "") {

    $tableName = validate($table);
    $columnName = validate($column);
    $brgy = validate($brgy);

    global $conn;
    $query = "SELECT SUM(p.$columnName) AS totalSum FROM $tableName p, farmers f WHERE p.farmer_id = f.id AND p.is_archived = 0 AND f.is_archived = 0";

    if (!empty($brgy)) {
       $query = " SELECT SUM(p.$columnName) AS totalSum FROM $tableName p, farmers f WHERE p.farmer_id = f.id AND p.is_archived = 0 AND f.is_archived = 0 AND f.farmer_brgy_address ='$brgy'";
    }

//    echo "<script>console.log('Query: " . addslashes($query) . "');</script>";

    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        return $row['totalSum'];
    } else {
        echo "Error: " . mysqli_error($conn);
        return 0;
    }
}


// Create/Delete function
function insert($tableName, $data)
{
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    $finalColumns = implode(',', $columns);
    $finalValues = "'" . implode("', '", $values) . "'";

    $query = "INSERT INTO $table ($finalColumns) VALUES ($finalValues)";
    $result = mysqli_query($conn, $query);
    return $result;
}

// Update data using this function
function update($tableName, $id, $data)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $updateDataString = '';

    foreach ($data as $column => $value) {
        $updateDataString .= $column . '=' . "'$value',";
    }

    $finalUpdateData = substr(trim($updateDataString), 0, -1);

    $query = "UPDATE $table SET $finalUpdateData WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function addFpsCode($tableName, $id, $brgy = ''){

    $brgy = validate($brgy);
    $fpsCode = '';
    $currentYear = date("Y");
    $fpsCode .= $currentYear;

    switch ($tableName) {
        case 'farmers':
            $fpsCode .= '-FAR';
            break;
        case 'parcels':
            $fpsCode .= '-PAR';
            break;

        case 'crops':
            $fpsCode .= '-CRO';
            break;
        
        case 'livestocks':
            $fpsCode .= '-LIV';
            break;

        case 'resources':
            $fpsCode .= '-RES-';
            break;
        case 'programs':
            $fpsCode .= '-PRO-';
            break;
        
        case 'distributions':
            $fpsCode .= '-DIS';
            break;
        
        default:
            $fpsCode .= '-FPS-';
            break;
    }
 
    if (!empty($brgy) || $brgy != '') {
        switch (strtolower($brgy)) {
            case "bagong Nayon":
                $code = "-03-14-03-001-";
                break;
            case "barangca":
                $code = "-03-14-03-002-";
                break;
            case "calantipay":
                $code = "-03-14-03-003-";
                break;
            case "catulinan":
                $code = "-03-14-03-004-";
                break;
            case "concepcion":
                $code = "-03-14-03-005-";
                break;
            case "hinukay":
                $code = "-03-14-03-006-";
                break;
            case "makinabang":
                $code = "-03-14-03-007-";
                break;
            case "matangtubig":
                $code = "-03-14-03-008-";
                break;
            case "pagala":
                $code = "-03-14-03-010-";
                break;
            case "paitan":
                $code = "-03-14-03-011-";
                break;
            case "piel":
                $code = "-03-14-03-012-";
                break;
            case "pinagbarilan":
                $code = "-03-14-03-013-";
                break;
            case "poblacion":
                $code = "-03-14-03-014-";
                break;
            case "sabang":
                $code = "-03-14-03-016-";
                break;
            case "san jose":
                $code = "-03-14-03-017-";
                break;
            case "san roque":
                $code = "-03-14-03-018-";
                break;
            case "santa barbara":
                $code = "-03-14-03-019-";
                break;
            case "santo cristo":
                $code = "-03-14-03-020-";
                break;
            case "santo niño":
                $code = "-03-14-03-021-";
                break;
            case "subic":
                $code = "-03-14-03-022-";
                break;
            case "sulivan":
                $code = "-03-14-03-023-";
                break;
            case "tangos":
                $code = "-03-14-03-024-";
                break;
            case "tarcan":
                $code = "-03-14-03-025-";
                break;
            case "tiaong":
                $code = "-03-14-03-026-";
                break;
            case "tibag":
                $code = "-03-14-03-027-";
                break;
            case "tilapayong":
                $code = "-03-14-03-028-";
                break;
            case "virgen delas flores":
                $code = "-03-14-03-030-";
                break;
            default:
                $code = "-00-00-00-000-";
                break;
        }
        // $formatted = substr($code, 0, 2) . '-' . substr($code, 2, 2) . '-' . substr($code, 4, 2) . '-' . substr($code, 6);
        $fpsCode .= $code;
    }

    $idWithPadd = $id;
    $fpsCode = $fpsCode . str_pad($idWithPadd, 5, '0', STR_PAD_LEFT);

    return update($tableName, $id, [
        'fps_code' => $fpsCode
    ]);

}

// Delete data from the database using ID
function delete($tableName, $id)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "DELETE FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);
    return $result;
}

//checks param or in the url 
function checkParamIdDump($type)
{
    if (isset($_GET[$type])) {

        if ($_GET[$type] != '') {

            return $_GET[$type];
        } else {
            return '<h4>No ID Found </h4>';
        }
    } else {
        return '<h4>No ID Given </h4>';
    }
}

function checkParamId($type)
{
    if (isset($_GET[$type])) {

        if ($_GET[$type] != '') {

            return $_GET[$type];
        } else {
            return false;
        }
    } else {
        return false;
    }
}



function jsonResponse($status, $status_type,  $message)
{


    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
    ];

    echo json_encode($response);
    return;
}

function getAll($tableName, $program = 0, $brgy = ""){
    global $conn;

    $table = validate($tableName);
    $program = validate($program);
    $brgy = validate($brgy);
 
    $query = "SELECT * FROM $table WHERE is_archived = 0";

    if($table ==  "barangays"){
        $query = "SELECT farmer_brgy_address AS brgy
        FROM farmers WHERE is_archived = 0
        GROUP BY farmer_brgy_address";
    }

    if($table ==  "distributions"){
        $query = "SELECT * FROM $table d, farmers f WHERE d.farmer_id = f.id AND d.is_archived = 0 ";
    }

    if(!empty($program)){
        $query .= "AND d.program_id = $program ";
    }

    if(!empty($brgy)){
        $query .= "AND f.farmer_brgy_address = '$brgy'";
    }
    
    return mysqli_query($conn, $query);
}

function getPrograms($table){
    global $conn;
    $query = "";
    if (!empty($table) && $table == 'pending_programs') {
        $query .= "SELECT * FROM programs WHERE is_archived = 0 AND start_date > CURDATE() AND start_date != '0000-00-00'";
    }

    if (!empty($table) && $table == 'expired_programs') {
        $query .= "SELECT * FROM programs WHERE is_archived = 0 AND end_date <= CURDATE() AND end_date != '0000-00-00'";
    }
    return mysqli_query($conn, $query);
}

function getById($tableName, $id, $isFarmer = true, $isProgram = false) {
    global $conn;

    // Validate and sanitize inputs
    $table = validate($tableName);
    $id = validate($id);

    // Prepare the query based on whether it's a farmer or not
    if ($isFarmer) {
        $query = "SELECT * FROM $table WHERE id = ? LIMIT 1";
    } else {
        $query = "SELECT * FROM $table WHERE farmer_id = ? AND is_archived = 0";
    }

    if($isProgram){
        $query = "SELECT * FROM $table WHERE program_id = ? AND is_archived = 0";
    }

    // Prepare the statement
    if ($stmt = mysqli_prepare($conn, $query)) {

        // Bind the parameters (assuming id is an integer or string)
        mysqli_stmt_bind_param($stmt, 's', $id); // 's' for string, use 'i' for integer if applicable

        // Execute the query
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            // If only one row, return the single record
            if ($isFarmer && mysqli_num_rows($result) == 1) {
                $data = mysqli_fetch_assoc($result);
                $response = [
                    'status' => 200,
                    'data' => $data,
                    'message' => 'Record Found'
                ];
            } else {
                // Otherwise, return all rows
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                $response = [
                    'status' => 200,
                    'data' => $rows,
                    'message' => 'Records Found'
                ];
            }
        } else {
            // No data found
            $response = [
                'status' => 404,
                'message' => 'No Data Found'
            ];
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);

    } else {
        // Query preparation failed
        $response = [
            'status' => 500,
            'message' => 'Database Query Preparation Failed'
        ];
    }

    return $response;
}

function getCountArray($tableName, $columnName, $condition, $brgy = "") {
    global $conn;

    // Validate inputs
    $tableName = validate($tableName);
    $columnName = validate($columnName);
    $condition = validate($condition);
    $brgy = validate($brgy);

    // Base query for counting
    $query = "";

    // Handle special cases for 'livestocks' and 'crops'
    if ($tableName == "livestocks" || $tableName == "crops") {
        $query = "SELECT t.$columnName AS id, COUNT(*) AS count 
                  FROM $tableName t, farmers f, parcels p 
                  WHERE t.farmer_id = f.id 
                  AND t.parcel_id = p.id 
                  AND t.is_archived = 0 
                  AND p.is_archived = 0 
                  AND f.is_archived = 0";

        // Add barangay filter if provided
        if (!empty($brgy)) {
            $query .= " AND f.farmer_brgy_address = '$brgy'";
        }

        $query .= " GROUP BY t.$columnName";
    } else {
        // Default query for other tables
        $query = "SELECT $columnName AS id, COUNT(*) AS count 
                  FROM $tableName 
                  WHERE is_archived = 0 
                  GROUP BY $columnName";

        // Add barangay filter for 'farmers' table if provided
        if ($tableName == "farmers" && !empty($brgy)) {
            $query = "SELECT $columnName AS id, COUNT(*) AS count 
                      FROM $tableName 
                      WHERE is_archived = 0 
                      AND farmer_brgy_address = '$brgy' 
                      GROUP BY $columnName";
        }

        // Add sorting for 'farmers' table
        if ($tableName == "farmers") {
            $query .= " ORDER BY id ASC";
        }
    }

    // Execute the query
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Log the error and return an empty array
        error_log("Database error: " . mysqli_error($conn));
        return [];
    }

    // Build the count array
    $countArray = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $countArray[$row['id']] = $row['count'];
    }

    // Return the result based on the condition
    if ($condition == 'count') {
        return array_values($countArray);
    } elseif ($condition == 'id') {
        return array_keys($countArray);
    } else {
        // Default: return the full associative array
        return $countArray;
    }
}

function insertActivityLog($table_id, $created_by, $table_name, $action_type, $related_table = '') {
    global $conn;
    $created_at = date('Y-m-d H:i:s');

    // Prepare the SQL query
    $sql = "INSERT INTO activity_logs (table_id, created_by, table_name, created_at, action_type, related_table) 
            VALUES (?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind parameters (i = integer, s = string)
    $stmt->bind_param("iissss", $table_id, $created_by, $table_name, $created_at, $action_type, $related_table);

    // Execute the query
    if ($stmt->execute()) {
        $stmt->close();
        return true;  // Success
    } else {
        $stmt->close();
        echo "Error: " . $stmt->error;
        return false;  // Failure
    }
}

function removeAndCustomizeKeys($arr, $keysToRemove, $keyMap = []) {
    // Remove keys from the array
    foreach ($keysToRemove as $key) {
        if (array_key_exists($key, $arr)) {
            unset($arr[$key]);
        }
    }

    // Customize the keys based on $keyMap
    foreach ($keyMap as $oldKey => $newKey) {
        if (array_key_exists($oldKey, $arr)) {
            $arr[$newKey] = $arr[$oldKey];  // Assign value to new key
            unset($arr[$oldKey]);  // Remove old key
        }
    }

    return $arr;
}

function getRecordsById($table_name, $id, $exclude_fields = []) {
    global $conn;
    $query = "SHOW COLUMNS FROM $table_name";
    $result = $conn->query($query);
    $columns = [];
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
    $fields_to_select = array_diff($columns, $exclude_fields);

    if (empty($fields_to_select)) {
        $fields_to_select = $columns;
    }
    $fields_string = implode(", ", $fields_to_select);
    $query = "SELECT $fields_string FROM $table_name WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $records = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close(); 
    return $records[0];
}

function compareArrays($arr1, $arr2) {
    if (count($arr1) !== count($arr2)) {
        // redirect('../logout.php', 500, 'Invalid Request');
    }

    $differences = [];
    
    foreach ($arr1 as $key => $value) {
        // Check if the key exists in the second array
        if (!array_key_exists($key, $arr2)) {
            $differences[] = "Key '$key' is missing in the second array.";
            continue;
        }

        if (is_double($value)) {
            $value = (string)$value;
        }

        // Check if the types are different
        if (gettype($arr2[$key]) !== gettype($value)) {
            $differences[] = "Type mismatch for key '$key': '" . gettype($value) . "' (DBarr1) vs '" . gettype($arr2[$key]) . "' (arr2).";
        }

        // Check if the values are different
        if ($arr2[$key] !== $value) {
            $differences[] = "Value mismatch for key '$key': '{$arr1[$key]}' (DBarr1) vs '{$arr2[$key]}' (arr2).";
        }
    }
    if (!empty($differences)) {
        return false;
        // return $differences;
    }

    return true;
}

function emailExists($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT email FROM users WHERE email = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
        redirect('register-farmer.php', 500, 'Something Went Wrong.');
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        return true; // Email exists
    } else {
        return false; // Email does not exist
    }
    $stmt->close();
}



?>