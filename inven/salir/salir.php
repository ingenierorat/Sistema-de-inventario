<?php
// Cierra la sessión abierta en el momento
session_start();
session_destroy();
echo "<script> window.location='..//lg/login.php'; </script>";                                              

?>