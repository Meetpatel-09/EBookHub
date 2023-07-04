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

$json = file_get_contents('php://input');
$data = json_decode($json);

$item->name = $data->name;
$item->email = $data->email;
$item->mobile = $data->mobile;
$item->address = $data->address;
$item->image = $data->image;
$item->password = $data->password;

if ($item->updateUser()) {
     http_response_code(200);
     echo json_encode(['status' => 200, 'message' => "Updated successfully.", 'data' => $data]);
} else {
     http_response_code(502);
     echo json_encode(['status' => 502, 'message' => "Something went wrong."]);
}