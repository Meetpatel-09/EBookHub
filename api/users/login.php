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

$json = file_get_contents('php://input');
$data = json_decode($json);

if (isset($data->email)) {
     $item->email = $data->email;
     $password = $data->password;
} else {
     http_response_code(404);
     echo json_encode(['status' => 404, 'message' => "Please Send Email and Password"]);
     return;
}

$item->userLogin();

if ($item->name != null) {

     if ($item->password != $password) {
          http_response_code(401);
          echo json_encode(['status' => 404, 'message' => "Invalid Password."]);
          return;
     } else {
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
          echo json_encode(['status' => 200, 'message' => "Login successful.", "data" => $users_arr]);
     }
} else {
     http_response_code(404);
     echo json_encode(['status' => 404, 'message' => "Account Not Found"]);
}