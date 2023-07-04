<?php

class User
{

     // dbection
     private $db;
     // Table
     private $db_table = "users";
     // Columns
     public $id;
     public $name;
     public $email;
     public $image;
     public $address;
     public $mobile;
     public $password;

     public $result;

     // Db dbection
     public function __construct($db)
     {
          $this->db = $db;
     }

     // GET ALL
     public function getUsers()
     {
          $sqlQuery = "SELECT * FROM " . $this->db_table . "";
          $this->result = $this->db->query($sqlQuery);
          return $this->result;
     }

     // CREATE
     public function createUser()
     {
          // sanitize
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->mobile = htmlspecialchars(strip_tags($this->mobile));
          $this->address = htmlspecialchars(strip_tags($this->address));
          $this->image = htmlspecialchars(strip_tags($this->image));
          $this->password = htmlspecialchars(strip_tags($this->password));
          $sqlQuery = "INSERT INTO $this->db_table(`name`, `email`, `mobile`, `address`, `image`, `password`) VALUES ('" . $this->name . "','" . $this->email . "','" . $this->mobile . "','" . $this->address . "','" . $this->image . "','" . $this->password . "');";
          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }

     // UPDATE
     public function updateUser()
     {
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->email = htmlspecialchars(strip_tags($this->email));
          $this->mobile = htmlspecialchars(strip_tags($this->mobile));
          $this->address = htmlspecialchars(strip_tags($this->address));
          $this->image = htmlspecialchars(strip_tags($this->image));

          $sqlQuery = "UPDATE " . $this->db_table . " SET name = '" . $this->name . "', email = '" . $this->email . "', mobile = '" . $this->mobile . "', address = '" . $this->address . "', image = '" . $this->image . "' WHERE id = " . $this->id;

          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }

     // getSingleUser
     public function getSingleUsers()
     {
          $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE id = " . $this->id;
          $record = $this->db->query($sqlQuery);
          $dataRow = $record->fetch_assoc();
          if ($this->db->affected_rows > 0) {
               $this->id = $dataRow['id'];
               $this->name = $dataRow['name'];
               $this->email = $dataRow['email'];
               $this->mobile = $dataRow['mobile'];
               $this->address = $dataRow['address'];
               $this->image = $dataRow['image'];
               $this->password = $dataRow['password'];
          }
     }

     // user Login
     public function userLogin()
     {
          $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE email = '" . $this->email . "'";
          $record = $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               $dataRow = $record->fetch_assoc();
               $this->id = $dataRow['id'];
               $this->name = $dataRow['name'];
               $this->email = $dataRow['email'];
               $this->mobile = $dataRow['mobile'];
               $this->address = $dataRow['address'];
               $this->image = $dataRow['image'];
               $this->password = $dataRow['password'];
          }
     }

     // DELETE
     function deleteUser()
     {
          $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = " . $this->id;
          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }
}
