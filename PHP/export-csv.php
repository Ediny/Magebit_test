<?php

require_once '../PHP/controler.php';

class Export extends Controler
{
    public function export()
    {
        if (isset($_POST["csv"])) {

            header('Content-Type: text/csv; charset=utf-8');
            header('Content-Disposition: attachment; filename=data.csv');
            $output = fopen("php://output", "w");
            fputcsv($output, array('ID', 'Email', 'Date'));
            $arr = null;
            foreach ($_REQUEST['check_list'] as $check) {
                $arr[] = $check;
            }

            $sql = "SELECT * from email WHERE id IN (" . implode(',', $arr) . ")";
            $result = $this->connect()->query($sql);
            while ($row = mysqli_fetch_assoc($result)) {
                fputcsv($output, $row);
            }
            fclose($output);
        }
    }
}

$export = new Export();
$export->export();
