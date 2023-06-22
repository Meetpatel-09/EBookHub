<?php

class Books
{

     // dbection
     private $db;
     // Table
     private $db_table = "books";
     // Columns
     public $id; // change
     public $title;  // change
     public $author; // change
     public $publicationyear; // change
     public $ISBN; // change
     public $language; // change
     public $pages; // change
     public $price; // change
     public $bookimages; // change
     public $userid; // change
     public $category; // change

     public $result;

     // Db dbection
     public function __construct($db)
     {
          $this->db = $db;
     }

     // GET ALL
     public function getBooks()
     {
          $sqlQuery = "SELECT * FROM " . $this->db_table . "";
          $this->result = $this->db->query($sqlQuery);
          return $this->result;
     }

     // CREATE
     public function createBook()  // change
     {
          // sanitize
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->publicationyear = htmlspecialchars(strip_tags($this->publicationyear));
          $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
          $this->language = htmlspecialchars(strip_tags($this->language));
          $this->pages = htmlspecialchars(strip_tags($this->pages));
          $this->price = htmlspecialchars(strip_tags($this->price));
          $this->bookimages = htmlspecialchars(strip_tags($this->bookimages));
          $this->userid = htmlspecialchars(strip_tags($this->userid));
          $this->category = htmlspecialchars(strip_tags($this->category));

          $sqlQuery = "INSERT INTO $this->db_table(`title`, `author`, `publicationyear`, `ISBN`, `language`, `pages`, `price`, `bookimages`, `userid`, `category`) VALUES ('" . $this->title . "','" . $this->author . "','" . $this->publicationyear . "','" . $this->ISBN . "','" . $this->language . "','" . $this->pages . "','" . $this->price . "','" . $this->bookimages . "','" . $this->userid . "','" . $this->category . "');";
          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }

     // UPDATE
     public function updateBook()  // change
     {
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->title = htmlspecialchars(strip_tags($this->title));
          $this->author = htmlspecialchars(strip_tags($this->author));
          $this->publicationyear = htmlspecialchars(strip_tags($this->publicationyear));
          $this->ISBN = htmlspecialchars(strip_tags($this->ISBN));
          $this->language = htmlspecialchars(strip_tags($this->language));
          $this->pages = htmlspecialchars(strip_tags($this->pages));
          $this->price = htmlspecialchars(strip_tags($this->price));
          // $this->bookimages = htmlspecialchars(strip_tags($this->bookimages));
          $this->userid = htmlspecialchars(strip_tags($this->userid));
          $this->category = htmlspecialchars(strip_tags($this->category));

          $sqlQuery = "UPDATE " . $this->db_table . " SET title = '" . $this->title . "', author = '" . $this->author . "', publicationyear = '" . $this->publicationyear . "', ISBN = '" . $this->ISBN . "', language = '" . $this->language . "', pages = '" . $this->pages . "', price = '" . $this->price . "', userid = '" . $this->userid . "', category = '" . $this->category . "' WHERE id = " . $this->id;

          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }

     // getSingleUser
     public function getSingleBook()  // change
     {
          $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE id = " . $this->id;
          $record = $this->db->query($sqlQuery);
          $dataRow = $record->fetch_assoc();
          $this->id = $dataRow['id'];
          $this->title = $dataRow['title'];
          $this->author = $dataRow['author'];
          $this->publicationyear = $dataRow['publicationyear'];
          $this->ISBN = $dataRow['ISBN'];
          $this->language = $dataRow['language'];
          $this->pages = $dataRow['pages'];
          $this->price = $dataRow['price'];
          $this->bookimages = $dataRow['bookimages'];
          $this->userid = $dataRow['userid'];
          $this->category = $dataRow['category'];
          
     }

     // DELETE
     function deleteBook()
     {
          $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = " . $this->id;
          $this->db->query($sqlQuery);
          if ($this->db->affected_rows > 0) {
               return true;
          }
          return false;
     }
}