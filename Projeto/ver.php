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
        exit();}

        include "conexao/conexao.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href= "css/estilo.css" type = "text/css" rel = "stylesheet">
    <meta charset="UTF-8">
    <title>Ver</title>
</head>
<body>
    <a href = "lista.php">Voltar</a>
    <p><b>Nome:</b> <?php echo $dado['nome']?></p>
    <p><b>Valor:</b> <?php echo $dado['valor']?></p>
    <p><b>Quantidade:</b> <?php echo $dado['quantidade']?></p>
</body>
</html>