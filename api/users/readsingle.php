<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../user.php';
include_once '../../database.php';

$database = new Database();
$db = $database->getConnection();

$item = new User($db);

$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$item->getSingleUsers();

if ($item->name != null) {

     // create array
     $users_arr = array(
          "id" => $item->id,
          "name" => $item->name,
          "email" => $item->email,
          "mobile" => $item->mobile,
          "address" => $item->address,
          "image" => $item->image,
          "password" => $item->password,
     );
     http_response_code(200);
     echo json_encode(['status' => 200, 'message' => "Found successfully.", "user_details" => $users_arr]);
} else {
     http_response_code(404);
     echo json_encode(['status' => 404, 'message' => "Something went wrong."]);
}
