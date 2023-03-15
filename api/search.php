<?php
include_once './config/database.php';
require "../vendor/autoload.php";

//set header for post request and allow from all origin 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$email = '';

//setting up connection from config file import 
$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;

$table_name = 'Users';

//create sql and 
$query = "SELECT  * FROM " . $table_name . " WHERE email = ? ";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;

if ($num > 0) {
    // email exists in the database
    $row = $result->fetch_assoc();
    // create a response object
    $response = array(
        "status" => "success",
        "message" => "Email exists",
        "data" => $row
    );
} else {
    // email does not exist in the database
    $response = array(
        "status" => "error",
        "message" => "Email does not exist"
    );
}

echo json_encode(
    array(
        "message" => "you got!",
        "data" => $response
    )
)

?>