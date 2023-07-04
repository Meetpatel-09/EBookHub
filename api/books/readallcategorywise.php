<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../books.php';
include_once '../../database.php';

$database = new Database();
$db = $database->getConnection();

$item = new Books($db);

$item->category = isset($_GET['category']) ? $_GET['category'] : die();

$records = $item->getBooksCategoryWise();
$itemCount = $records->num_rows;

if ($itemCount > 0) {
     $arr = array();
     $arr["status"] = 200;
     $arr["message"] = "Fetched successfully.";
     $arr["itemCount"] = $itemCount;
     $arr["books"] = array();
     while ($row = $records->fetch_assoc()) {
          array_push($arr["books"], $row);
     }
     echo json_encode($arr);
} else {
     echo json_encode(['status' => 404, 'message' => "Data Not Found"]);
}
