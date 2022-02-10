<?php

require_once '../PHP/controler.php';


class Fetch extends Controler
{

    public $page_number = null;
    public $first_page = null;
    // Fetch all tasks

    public function pagination()
    {
        //define total number of results you want per page  
        $page = null;
        //find the total number of results stored in the database  
        $query = "SELECT * FROM email";
        $result = mysqli_query($this->connect(), $query);
        $number_of_result = mysqli_num_rows($result);

        //determine the total number of pages available  
        $this->page_number = $this->number_of_page = ceil($number_of_result / $this->results_per_page);
        $this->first_page = $this->page_first_result = ($page - 1) * $this->results_per_page;
    }
    public function getNumber()
    {
        return $this->number_of_page;
    }
    // Viss virs šī ir mēģinājums uztaisīt papildus lapas

    public function setOrder($order)
    {
        $this->order = $order;
    }
    public function fetch()
    {
        $search = '';
        $search = $this->connect()->real_escape_string($_POST['input-search']);
        $res = null;
        $select = "SELECT * FROM email
        WHERE email_name LIKE '%$search%'
        ORDER BY $this->order
        ASC LIMIT 20" . $this->page_first . ',' . $this->results_per_page;

        if ($sql = $this->connect()->query($select)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $res[] = $row;
            }
        }
        return $res;
    }
}
