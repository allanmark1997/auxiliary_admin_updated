<?php 
session_start();

	if (isset($_POST['btnLogout'])) {
                session_destroy();
                header("Location: ../index.html");
         }
 ?>