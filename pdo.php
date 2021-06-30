<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=coloredcowa2', 
    'kush', 'blah');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
