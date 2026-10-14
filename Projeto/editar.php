<?php
    include "conexao/conexao.php";

    //Pegar na URL o valor do ID
    $id = $_GET['id'];

    //Consulta para ser enviada a base de dados
    $query = "SELECT * FROM dados WHERE id = $id";

    //Enviar consulta para a base dados
    $resultado = mysqli_query($link, $query);

    // retorna os dados numa linha
    $dado = mysqli_fetch_array($resultado);

     session_start(); // Inicia a sessão em todas as páginas
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: index.php"); // Redireciona se não estiver logado
        exit(); }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <link href= "css/estilo.css" type = "text/css" rel = "stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Móvel</title>
        <script src="js/script.js"></script>
    </head>
    <body>
        <h1>Editar Móvel</h1>
        <a href= "lista.php">Voltar</a><br><br>
        <form name="atualizarDado" action="" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="nome" value= "<?php echo $dado['nome']?>" required><br>
        <label for="valor">Valor</label>
        <input type="number" name="valor" step=0.01 value= "<?php echo $dado['valor']?>" required><br>
        <label for="quant">Quantidade</label>
        <input type="number" name="quant" value= "<?php echo $dado['quantidade']?>" required><br>
        <button type="submit">Salvar</button>
        <button type="reset">Limpar</button>
    </form>

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nome = $_POST['nome'];
            $valor = $_POST['valor'];
            $quantidade = $_POST['quant'];

            //montagem da consulta para o banco de dados
            $query = "UPDATE dados SET nome = '$nome', valor = '$valor' ,quantidade = '$quantidade' WHERE id = $id";

            //envia consulta para a base de dados
            mysqli_query($link, $query);

            //fecha a conexão com a base de dados
            mysqli_close($link);
        }
    ?>

    </body>
</html>