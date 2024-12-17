<?php

require 'database.php';

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

class Page
{
    // Step 1: Declare a static variable to hold the instance of the class
    private static $instance = null;

    // Step 2: Declare a private property to store the page filename
    private $page;

    // Step 3: Private constructor to prevent direct instantiation
    private function __construct()
    {
        // Set the page filename when the object is created
        $this->page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
    }

    // Step 4: Public static method to get the single instance of the class
    public static function getInstance()
    {
        // Check if the instance doesn't exist and create it
        if (self::$instance === null) {
            self::$instance = new Page();
        }
        // Return the instance
        return self::$instance;
    }

    // Step 5: Getter method to access the page filename
    public function getPage()
    {
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
function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
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
function checkParamId($type)
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

// Get by Data ID specifically for edit button if it exist status=200
function getById($tableName, $id){
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    $query = "SELECT * FROM $table WHERE id='$id' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $response = [
                'status' => 200,
                'data' => $row,          //get data database
                'message' => 'Record Found'
            ];
            return $response;
            
        } else {
            $response = [
                'status' => 404,
                'message' => 'No Data Found'
            ];
            return $response;
        }
    } else {
        $response = [
            'status' => 500,
            'message' => 'Something Went Wrong'
        ];
        return $response;
    }
}

?>