<?php
setcookie("_enter_u_","",time()-(60*60*24),'/');
header('location:login.php');

?>