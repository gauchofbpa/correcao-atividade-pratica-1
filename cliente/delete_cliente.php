<?php
    include '../db.php';
    $id = $_GET['id'];
    $sql = "DELETE FROM cliente WHERE id = '$id'";
    if($conn -> query($sql) === TRUE) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>". $conn -> error;
    }
    $conn -> close();
    header ("Location: read_cliente.php");
    exit();
?>