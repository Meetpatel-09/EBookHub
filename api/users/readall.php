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
$records = $item->getUsers();
$itemCount = $records->num_rows;

if ($itemCount > 0) {
     $arr = array();
     $arr["status"] = 200;
     $arr["message"] = "Fetched successfully.";
     $arr["itemCount"] = $itemCount;
     $arr["body"] = array();
     while ($row = $records->fetch_assoc()) {
          array_push($arr["body"], $row);
     }
     echo json_encode($arr);
} else {
     echo json_encode(['status' => 502, 'message' => "Something went wrong."]);
}