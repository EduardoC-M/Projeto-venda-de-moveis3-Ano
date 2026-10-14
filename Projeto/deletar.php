<?php
    include "conexao/conexao.php";

    //Pegar na URL o valor do ID
    $id = $_GET['id'];

    if(isset($_GET['delete'])){
        //montagem da consulta para o banco de dados
        $query = "DELETE FROM dados WHERE id = $id";

        //Enviar consulta para a base dados
        $resultado = mysqli_query($link, $query);

        //Retorna para a base de dados
        header("Location: lista.php");

         session_start(); // Inicia a sessão em todas as páginas
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: index.php"); // Redireciona se não estiver logado
        exit();}
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head><link href= "css/estilo.css" type = "text/css" rel = "stylesheet">
        <meta charset="UTF-8">
        <title>Editar Móvel</title>
    </head>
    <body>
        <h1>Deletar Móvel</h1>
        <p>Deseja <b>apagar</b> esse móvel?</p><br>
        <a href = "deletar.php?id=<?php echo $id?>&delete=sim">Sim</a> <a href = "lista.php">Não</a>

    </body>
</html>