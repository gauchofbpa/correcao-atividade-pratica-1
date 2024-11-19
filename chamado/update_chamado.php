<?php
    include '../db.php';
    $id = $_GET['id'];
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $descricao = $_POST['descricao'];
        if ($_POST['criticidade'] == "alta") {
            $criticidade = 'Alta';   
        } else {
            if ($_POST['criticidade'] == "media") {
                $criticidade = 'Média';            
            } else {
                if ($_POST['criticidade'] == "baixa") {
                $criticidade = 'Baixa';
                }
            }
        }  
        if ($_POST['status_chamado'] == "aberto") {
            $status_chamado = 'Aberto';   
        } else {
            if ($_POST['status_chamado'] == "em_andamento") {
                $status_chamado = 'Em andamento';            
            } else {
                if ($_POST['status_chamado'] == "resolvido") {
                $status_chamado = 'Resolvido';
                }
            }
        } 
        $cliente = $_POST['cliente'];
        $colaborador = $_POST['colaborador'];
        echo $colaborador;
        $sql = "UPDATE chamado SET descricao = '$descricao', criticidade = '$criticidade', status_chamado = '$status_chamado', id_cliente = '$cliente', id_colaborador = '$colaborador' WHERE id = '$id'"; 
        if($conn -> query($sql) === TRUE) {
            echo "Registro atualizado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>". $conn -> error;
        }
        $conn -> close();
        header ("Location: read_chamado.php");
        exit();
    }
    $sql = "SELECT cliente.id AS 'id_cliente', cliente.nome AS 'nome_cliente', chamado.id AS 'id_chamado', descricao, criticidade, status_chamado, data_abertura, id_cliente, id_colaborador AS 'id_colaborador', colaborador.id, colaborador.nome AS 'nome_colaborador'
    FROM cliente
    INNER JOIN chamado
    ON chamado.id_cliente = cliente.id
    INNER JOIN colaborador
    ON colaborador.id = chamado.id_colaborador 
    WHERE chamado.id = '$id'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();
    
    $sql_status = "SELECT status_chamado FROM chamado WHERE id = '$id'";
    $result_status = $conn -> query($sql_status);
    $row_status = $result_status -> fetch_assoc();
    $status_chamado = $row['status_chamado'];

    $sql_criticidade = "SELECT criticidade FROM chamado WHERE id = '$id'";
    $result_criticidade = $conn -> query($sql_criticidade);
    $row_criticidade = $result_criticidade -> fetch_assoc();
    $criticidade = $row['criticidade'];

    $sql_cliente = $conn->query("SELECT * FROM cliente");

    $sql_colaborador = $conn->query("SELECT * FROM colaborador");
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
    <title>Gerenciamento de Chamados</title>
</head>
<body>
    <h1>Atualizar informações do chamado</h1>
    <form method="POST" action="update_chamado.php?id=<?php echo $row['id_chamado'];?>">
        <label for="descricao">Descrição:</label> <br>
        <textarea name="descricao" required> <?php echo $row['descricao'];?> </textarea> 
        <br> <br>
        <label for="criticidade">Criticidade:</label> <br>
        <input type="radio" name="criticidade" value="alta" required <?php if($criticidade == 'Alta') echo 'checked' ?>>Alta <br>
        <input type="radio" name="criticidade" value="media" <?php if($criticidade == 'Média') echo 'checked' ?>>Média <br>
        <input type="radio" name="criticidade" value="baixa" <?php if($criticidade == 'Baixa') echo 'checked' ?>>Baixa <br> 
        <br>
        <label for="status_chamado">Status do Chamado:</label> <br>
        <input type="radio" name="status_chamado" value="aberto" required <?php if($status_chamado == 'Aberto') echo 'checked' ?>>Aberto <br>
        <input type="radio" name="status_chamado" value="em_andamento" <?php if($status_chamado == 'Em andamento') echo 'checked' ?>>Em andamento <br>
        <input type="radio" name="status_chamado" value="resolvido" <?php if($status_chamado == 'Resolvido') echo 'checked' ?>>Resolvido <br>
        <br>
        <label for="cliente">Cliente:</label>
        <select name="cliente" required>
        <option disabled value="<?php echo $row['id'];?>"><?php echo $row['nome_cliente'];?></option>
        <option disabled>Acima o cliente atual</option>
        <?php 
        if ($sql_cliente -> num_rows > 0) { 
            while($row_cliente = $sql_cliente->fetch_assoc()) {
        ?> <option value="<?php echo $row_cliente['id'];?>"><?php echo $row_cliente['nome']; ?></option>
        <?php } }?>
        </select>
        <br> <br>
        <br>
        <label for="colaborador">Colaborador:</label>
        <select name="colaborador" required>
        <option disabled value="<?php echo $row['id'];?>"><?php echo $row['nome_colaborador'];?></option>
        <option disabled>Acima o cliente atual</option>
        <?php 
        if ($sql_colaborador -> num_rows > 0) { 
            while($row_colaborador = $sql_colaborador->fetch_assoc()) {
        ?> <option value="<?php echo $row_colaborador['id'];?>"><?php echo $row_colaborador['nome']; ?></option>
        <?php } }?>
        </select>
        <br>
        <br> <br>
        <input type="hidden" value="">
        <input type="submit" value="Atualizar">
    </form>
    <a href="read_chamado.php">Voltar</a>
</body>
</html>