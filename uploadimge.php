<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");
header("Acess-Control-Allow-Headers: Acess-Control-Allow-Headers,Content-Type,Acess-Control-Allow-Methods, Authorization");

include 'dbconfig.php'; // include database connection file

$fileName  =  $_FILES['sendimage']['name'];
$tempPath  =  $_FILES['sendimage']['tmp_name'];
$fileSize  =  $_FILES['sendimage']['size'];

if (empty($tempPath)) {
     $errorMSG = json_encode(array("message" => "please select image", "status" => false));
     echo $errorMSG;
} else {
     $upload_path = 'upload/'; // set upload folder path 

     $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get image extension

     // valid image extensions
     $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

     // allow valid image file formats
     if (in_array($fileExt, $valid_extensions)) {

          $str = rand();
          $result = md5($str);
          $fileName  = $result;

          $fileName = $fileName . "." . $fileExt;

          //check file not exist our upload folder path
          if (!file_exists($upload_path . $fileName)) {
               // check file size '5MB'
               if ($fileSize < 5000000) {
                    move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
                    http_response_code(201);
                    echo json_encode(['status' => 201, 'message' => "Saved Successfully.", 'filename' => $fileName]);
                    return;
               } else {
                    $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
                    echo $errorMSG;
               }
          } else {
               $errorMSG = json_encode(array("message" => "Sorry, file already exists check upload folder", "status" => false));
               echo $errorMSG;
          }
     } else {
          $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));
          echo $errorMSG;
     }
}