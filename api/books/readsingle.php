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

$item->getSingleBook();

if ($item->title != null) {

     // create array
     $users_arr = array(
          "id" => $item->id,
          "title" => $item->title,
          "author" => $item->author,
          "publicationyear" => $item->publicationyear,
          "ISBN" => $item->ISBN,
          "language" => $item->language,
          "pages" => $item->pages,
          "price" => $item->price,
          "bookimages" => $item->bookimages,
          "userid" => $item->userid,
          "category" => $item->category
     );
     http_response_code(200);
     echo json_encode(['status' => 200, 'message' => "Found successfully.", "data" => $users_arr]);
} else {
     http_response_code(404);
     echo json_encode(['status' => 404, 'message' => "Something went wrong."]);
}
