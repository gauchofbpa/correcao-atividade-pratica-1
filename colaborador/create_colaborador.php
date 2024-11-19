<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Gerenciamento de Chamados</title>
</head>
<body>
    <h1>Registrar colaborador</h1>
    <form method="POST" action="create_colaborador.php">
        <label for="name">Nome:</label>
        <input type="text" name="name" required>
        <br> <br>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br> <br>
        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone" required>
        <br>
        <br>
        <input type="submit" value="Adicionar">
    </form>
    <a href="read_colaborador.php">Ver todos os colaboradores cadastrados</a>
    <br> <br>
</body>
</html>
<?php
    include '../db.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $sql = "INSERT INTO colaborador (nome, email, telefone) VALUE ('$name', '$email', '$telefone')";
        if($conn -> query($sql) === TRUE) {
            echo "Novo registro adicionado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>". $conn -> error;
        }
    }
    $conn -> close();
?>