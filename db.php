<?php
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "pratica_1_gaucho";
    $conn = new mysqli($servername, $username, $password, $dbname);
    if($conn-> connect_error) {
        die("Conexão falhou:" . $conn-> connect_error);
    }
?>