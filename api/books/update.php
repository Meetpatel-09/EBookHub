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

$item->id = isset($_GET['id']) ? $_GET['id'] : die();

$json = file_get_contents('php://input');
$data = json_decode($json);

$item->title = $data->title;
$item->author = $data->author;
$item->publicationyear = $data->publicationyear;
$item->ISBN = $data->ISBN;
$item->language = $data->language;
$item->pages = $data->pages;
$item->price = $data->price;
$item->bookimages = $data->bookimages;
$item->userid = $data->userid;
$item->category = $data->category;

if ($item->updateBook()) {
     http_response_code(200);
     echo json_encode(['status' => 200, 'message' => "Updated successfully."]);
} else {
     http_response_code(502);
     echo json_encode(['status' => 502, 'message' => "Something went wrong."]);
}