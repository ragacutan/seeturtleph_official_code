<?php
    include '../../session.php';
    include '../../functions.php';
    include '../../check_login.php';
    include 'check_login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Government Account <br><?= $_SESSION['firstName'] ?> <?= $_SESSION['lastName'] ?></h1>
    <br>
    <a href="../../logout.php?logout=true" class="btn-login">LOGOUT</a>
</body>
</html>