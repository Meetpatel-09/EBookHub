<?php

class Messages
{
     // dbection
     private $db;
     // Table
     private $db_table = "messages";
     // Columns
     public $id; // change
     public $message;  // change
     public $senderId; // change
     public $receiverId; // change
     public $timestamp; // change
     public $messagetime; // change

     public $result;

     // Db dbection
     public function __construct($db)
     {
          $this->db = $db;
     }

     // GET ALL
     public function getMessages()
     {
          $sqlQuery = "SELECT * FROM " . $this->db_table . "";
          $this->result = $this->db->query($sqlQuery);
          return $this->result;
     }

     // CREATE
     public function createMessages()  // change
     {
          // sanitize
          $this->message = htmlspecialchars(strip_tags($this->message));
          $this->senderId = htmlspecialchars(strip_tags($this->senderId));
          $this->receiverId = htmlspecialchars(strip_tags($this->receiverId));
          $this->messagetime = htmlspecialchars(strip_tags($this->messagetime));
          $sqlQuery = "INSERT INTO $this->db_table(`message`, `senderId`, `receiverId`, `messagetime`) VALUES ('" . $this->message . "','" . $this->senderId . "','" . $this->receiverId . "','" . $this->messagetime . "');";
          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }

     // DELETE
     function deleteMessages()
     {
          $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = " . $this->id;
          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }
}
