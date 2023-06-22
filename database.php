<?php
class Database
{
    public $db;
    public function getConnection()
    {
        $this->db = null;
        try {
            $this->db = new mysqli('localhost', 'root', '', 'ebookhub');
        } catch (Exception $e) {
            echo json_encode(["Status" => 502, "message" => "Database could not be connected: " . $e->getMessage()]);
        }
        return $this->db;
    }
}
