<?php

require_once './controler.php';
$stmt = "SELECT SUBSTRING_INDEX(email_name, '@', -1) domain COUNT(*) AS domain FROM email";



echo '<input type="submit" value="<?php echo $button; ?>" name="<?php echo $button; ?>" form="main-form">';
