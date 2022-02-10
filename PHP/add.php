<?php


require_once "../PHP/controler.php";


class Insert extends Controler
{

    public function insert()
    {
        $name = $_POST['email'];
        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO `email` (`email_name`) VALUES (?)");

        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            $stmt = null;
            // Redirect to main
            sleep(2);
            header("location: ../index.html");
        } else {
            $stmt->error;
        }

        // Close statement
        $stmt->close();

        // Close connection
        $db->close();
    }
}

$add = new Insert();
$add->insert();
