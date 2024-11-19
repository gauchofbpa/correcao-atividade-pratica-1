<?php
    include '../db.php';
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
    <h1>Criar um chamado</h1>
    <form method="POST" action="create_chamado.php">
        <label for="descricao">Descrição:</label> <br>
        <textarea name="descricao" required></textarea>
        <br> <br>
        <label for="criticidade">Criticidade</label> <br>
        <input type="radio" name="criticidade" value="alta" required>Alta <br>
        <input type="radio" name="criticidade" value="media">Média <br>
        <input type="radio" name="criticidade" value="baixa">Baixa <br>     
        <br> 
        <label for="cliente">Cliente:</label>
        <select name="cliente" required>
        <option disabled>Selecione um cliente</option>
        <?php 
        if ($sql_cliente -> num_rows > 0) { 
            while($row_cliente = $sql_cliente->fetch_assoc()) {
        ?> <option value="<?php echo $row_cliente['id'];?>"><?php echo $row_cliente['nome']; ?></option>
        <?php } ?>
        <?php } else { ?>
        <option disabled><?php echo 'Sem nenhum cliente cadastrado'; }   ?></option>
        </select>
        <br> <br>
        <label for="colaborador">Colaborador:</label>
        <select name="colaborador" required>
        <option disabled>Selecione um colaborador</option>
        <option>Sem colaborador</option>
        <?php 
        if ($sql_colaborador -> num_rows > 0) { 
            while($row_colaborador = $sql_colaborador->fetch_assoc()) {
        ?> <option value="<?php echo $row_colaborador['id'];?>"><?php echo $row_colaborador['nome']; ?></option>
        <?php } ?>
        <?php } else { ?>
        <option disabled><?php echo 'Sem nenhum colaborador cadastrado'; }   ?></option>
        </select>
        <br>
        <br>
        <input type="submit" value="Adicionar">
    </form>
    <a href="read_chamado.php">Ver todos os chamados existentes</a>
    <br> <br>
</body>
</html>
<?php
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
        $cliente = $_POST['cliente'];
        if ($_POST['colaborador'] == "Sem colaborador") {
            $colaborador = null;
        } else {
            $colaborador = $_POST['colaborador'];
        }
        
        if ($colaborador == null) {
            $sql = "INSERT INTO chamado (descricao, criticidade, status_chamado, id_cliente) VALUE ('$descricao', '$criticidade', 'Aberto', '$cliente')";
        } else {
            $sql = "INSERT INTO chamado (descricao, criticidade, status_chamado, id_cliente, id_colaborador) VALUE ('$descricao', '$criticidade', 'Aberto', '$cliente', '$colaborador')";
        }
        
        if($conn -> query($sql) === TRUE) {
            echo "Novo registro adicionado com sucesso";
        } else {
            echo "Erro: " . $sql . "<br>". $conn -> error;
        }
    }
    $conn -> close();
?>