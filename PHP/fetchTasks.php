<?php

require_once '../PHP/controler.php';


class Fetch extends Controler
{

    public $order = 'date';
    public $domain = array();
    public $dom = array();

    // Selects all the records for future use
    public function getEmails()
    {
        $sql = "SELECT email_name FROM email";
        $stmt = $this->connect()->query($sql);
        while ($dn = $stmt->fetch_array()) {
            $domain[] = $dn;
        }
        return $domain;
    }

    // Gets domain names
    public function getDomainName()
    {
        $emails = $this->getEmails();
        $providers = array();
        foreach ($emails as $email) {
            $domain = explode("@", $email["email_name"])[1];
            $domainParts = explode(".", $domain);
            $provider = $domainParts[count($domainParts) - 2];
            if (!in_array($provider, $providers)) array_push($providers, $provider);
        }
        return $providers;
    }

    // Sets sorting order
    public function setOrder($order)
    {
        $this->order = $order;
    }

    // fetches all records with specific 
    public function fetch()
    {
        $search = isset($_POST['input-search']) ? $_POST['input-search'] : '';
        $clean_search = $this->connect()->real_escape_string($search);
        $res = null;
        $select = "SELECT * FROM email
        WHERE email_name LIKE '%$clean_search%'
        ORDER BY $this->order
        ASC LIMIT 10";

        if ($sql = $this->connect()->query($select)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $res[] = $row;
            }
        }
        return $res;
    }
}

