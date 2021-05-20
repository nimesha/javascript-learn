<?php

namespace App\Core;

use mysqli;

$dotenv = \Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();

class DB
{

    protected $host;
    protected $username;
    protected $password;
    protected $db;
    public $conn;

    public function __construct()
    {

        $this->host = $_ENV['mysql_host'];
        $this->username = $_ENV['mysql_username'];
        $this->password = $_ENV['mysql_password'];
        $this->db = $_ENV['mysql_database'];

        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    /**
     * @return Mysql Conn
     */
    public function getConnection()
    {
        return $this->conn;
    }

    public function fetchAll($results)
    {
        $data = [];
        if ($results && $results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }

    public function real_escape_string($string)
    {
        return $this->conn->real_escape_string($string);
    }

}
