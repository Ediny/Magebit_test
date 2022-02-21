<?php

require_once './controler.php';

// Class that deletes a task
class Delete extends Controler
{
    public function delete($id = null)
    {
        $delete = "DELETE FROM email WHERE id = '$id'";
        $db = $this->connect();
        if ($sql = $db->query($delete)) {
            return true;
        } else {
            return false;
        }
    }
}

// initialize delete class
$controler = new Delete();

$id = $_REQUEST['id'];

$delete = $controler->delete($id);

if ($delete) {
    header('Location: ../dataList.php');
}
