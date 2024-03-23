<?php 
    if(!isset($_SESSION['id'])) {
        header("Location: ../admin/login.php ");
    }
?>