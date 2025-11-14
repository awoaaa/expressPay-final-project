<?php 
session_start();

#here, this unsets all the session variables that were storing the previous information from the previous sessions 
$_SESSION = [];

# "destroys" the session on the server
session_destroy();

#after logging out, we are redirected to the to welcome page
header("Location: welcome.php");
exit;
?>
