<?php

 session_start(); // Inicia a sessão em todas as páginas
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: index.php"); // Redireciona se não estiver logado
        exit();}
        include "conexao/conexao.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href= "css/estilo.css" type = "text/css" rel = "stylesheet">
    <title>Novo dado</title>
</head>
<body>
    <h1>Novo movel</h1>
    <script src="js/script.js"></script>
    <form name="novoMovel" action="" method="post">
        <label for="nome">Nome</label>
        <input type="text" name="nome" required><br>
        <label for="valor">Valor</label>
        <input type="number" name="valor" step="0.01" required><br>
        <label for="quant">Quantidade</label>
        <input type="number" name="quant" required><br>
        <button type="submit">Salvar</button>
    </form>
    <a href = "lista.php">Voltar</a>

    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $nome = $_POST['nome'];
            $valor = $_POST['valor'];
            $quant = $_POST['quant'];

            //montagem da consulta para o banco de dados
            $query = "INSERT INTO dados (nome,valor,quantidade) VALUES ('$nome','$valor','$quant')";

            //chama o arquivo conexao.php
            include "conexao/conexao.php";

            //envia consulta para a base de dados
            mysqli_query($link, $query);

            //fecha a conexão com a base de dados
            mysqli_close($link);
        }
    ?>
    
</body>
</html>