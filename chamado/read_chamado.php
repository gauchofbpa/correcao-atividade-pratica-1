<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Gerenciamento de Chamados</title>
</head>
<body>
    <h1>Visualizar os chamados</h1>
    <table>
        <thead>
            <th>Código do Chamado</th>
            <th>Descrição do problema</th>
            <th>Criticidade</th>
            <th>Status</th>
            <th>Data de abertura</th>
            <th>Cliente</th>
            <th>Colaborador Responsável</th>
        </thead>
        <tbody>
            <?php
                include '../db.php';
                $sql = "SELECT cliente.id AS 'id_cliente', cliente.nome AS 'nome_cliente', chamado.id AS 'id_chamado', descricao, criticidade, status_chamado, data_abertura, id_cliente, id_colaborador AS 'id_colaborador', colaborador.id, colaborador.nome AS 'nome_colaborador'
                FROM cliente
                INNER JOIN chamado
                ON chamado.id_cliente = cliente.id
                LEFT JOIN colaborador
                ON colaborador.id = chamado.id_colaborador;";
                $result = $conn -> query($sql);
                if ($result -> num_rows > 0) {
                    while ($row = $result -> fetch_assoc()) {
                        echo "<tr>
                        <th scope='row'> {$row['id_chamado']} </th>
                        <td>{$row['descricao']}</td>
                        <td>{$row['criticidade']}</td>
                        <td>{$row['status_chamado']}</td>
                        <td>{$row['data_abertura']}</td>
                        <td>{$row['nome_cliente']}</td>
                        <td>{$row['nome_colaborador']}</td>
                        <td>
                            <a href='update_chamado.php?id={$row['id_chamado']}'>Editar</a> |
                            <a href='delete_chamado.php?id={$row['id_chamado']}'>Excluir</a>
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
    <a href="create_chamado.php">Inserir novo chamado</a>
    <br> <br>
    <a href="../cliente/read_cliente.php">Visualizar todos os clientes</a>
    <br> <br>
    <a href="../colaborador/read_colaborador.php">Visualizar todos os colaboradores</a>
</body>
</html>