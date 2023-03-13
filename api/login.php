<?php

include_once './config/database.php';
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$email = '';
$password = '';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));

$email = $data->email;
$password = $data->password;

$table_name = 'Users';

$query = "SELECT  firstName, lastName, password FROM " . $table_name . " WHERE email = ? LIMIT 0,1";

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$num = $result->num_rows;

if ($num > 0) {
    $row = $result->fetch_assoc();
    $id = $row['id'];
    $firstname = $row['firstName'];
    $lastname = $row['lastName'];
    $password2 = $row['password'];

    if (password_verify($password, $password2)) {
        $secret_key = "YOUR_SECRET_KEY";
        $issuer_claim = "THE_ISSUER";
        $audience_claim = "THE_AUDIENCE";
        $issuedat_claim = 1356999524; // issued at
        $notbefore_claim = 1357000000; //not before
        $token = array(
            "iss" => $issuer_claim,
            "aud" => $audience_claim,
            "iat" => $issuedat_claim,
            "nbf" => $notbefore_claim,
            "data" => array(
                "id" => $id,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email
            )
        );

        http_response_code(200);

        $jwt = JWT::encode($token, $secret_key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );
    } else {
        http_response_code(401);
        echo json_encode(
            array(
                "message" => "Login failed.",
                "password" => $password,
                "password2" => $password2
            )
        );
    }
}

$stmt->close();
$conn->close();
?>
