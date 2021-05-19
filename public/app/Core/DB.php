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

    public function ex()
    {


        $date_string = "O-Brand";
        $query = "select * from brands where name = ? ";
        $stmt = $this->getConnection()->prepare($query);
        $stmt->bind_param("s", $date_string);
        $stmt->execute();

        //$stmt = $this->getConnection()->stmt_init();

        $district = "";
        /* bind result variables */
        //order $stmt->bind_result($district);

        /* fetch value */
        $stmt->fetch();
        var_dump($stmt);

        // printf("%s is in district %s\n", $city, $district);


        // $stmt = $this->conn->prepare($query);
        // var_dump($stmt);
        //$stmt->close();
        // $stmt->bind_param("s", $date_string);
        // $stmt->execute();
        // $result = $stmt->get_result();
        // if ($result->num_rows === 0) exit('No rows');
        // while ($row = $result->fetch_assoc()) {
        //     var_dump($row);
        // }

        // $stmt->close();
    }
}
