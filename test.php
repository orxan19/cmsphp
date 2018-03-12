<?php 
echo "<h1>" . password_hash('secret', PASSWORD_BCRYPT, array('cost' => 12)) . "</h1>";



 ?>



