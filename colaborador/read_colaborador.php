<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Gerenciamento de Chamados</title>
</head>
<body>
    <h1>Visualizar os colaboradores</h1>
    <table>
        <thead>
            <th>Código do Colaborador</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Telefone</th>
        </thead>
        <tbody>
            <?php
                include '../db.php';
                $sql = "SELECT * FROM colaborador";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                    while ($row = $result -> fetch_assoc()) {
                        echo "<tr>
                        <th scope='row'> {$row['id']} </th>
                        <td>{$row['nome']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['telefone']}</td>
                        <td>
                            <a href='update_colaborador.php?id={$row['id']}'>Editar</a> |
                            <a href='delete_colaborador.php?id={$row['id']}'>Excluir</a>
                        </td>
                        </tr>";
                        }
                    } else {
                        echo "Nenhum registro encontrado";
                    }
                    $conn -> close();
            ?>
        </tbody>    
    </table>  
    <br>
    <a href="create_colaborador.php">Inserir novo colaborador</a>  
    <br> <br>
    <a href="../chamado/read_chamado.php">Visualizar todos os chamados</a>
    <br> <br>
    <a href="../cliente/read_cliente.php">Visualizar todos os clientes</a>
</body>
</html>