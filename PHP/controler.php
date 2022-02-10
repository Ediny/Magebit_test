<?php


class Controler
{

    // props
    private $server = 'localhost';
    private $username = 'root';
    private $password;
    private $dbname = 'magebit';
    public $order = 'date';
    public $number_of_page = null;
    public $page_first_result = null;
    public $results_per_page = 10;



    // constructor
    public function connect()
    {
        $conn = new mysqli($this->server, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
}
