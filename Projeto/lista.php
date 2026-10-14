<?php
    include "conexao/conexao.php";

    //Consulta que busca na base dados
    $query = "SELECT * FROM dados";

    //Enviar a consulta para a base de dados
    $dados = mysqli_query($link, $query);

    //tratando os dados
    $lista = mysqli_fetch_all($dados);

    //fecha a conexão com a base de dados
    mysqli_close($link);

     session_start(); // Inicia a sessão em todas as páginas
    if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
        header("Location: index.php"); // Redireciona se não estiver logado
        exit();}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lista de Dados</title>
    <link href= "css/estilo.css" type = "text/css" rel = "stylesheet">
</head>
<body>
    <h1>Móveis</h1>
    <a href= "novodado.php">Adicionar</a><br><br>
    <table>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Valor</th>
            <th>Quantidade</th>
            <th coll_spawn = "2">Ações</th>
        </tr>
        <?php
        foreach($lista as $dado){
        ?>
        <tr>
            <td><?php echo $dado[0] ?></td>
            <td><?php echo $dado[1] ?></td>
            <td><?php echo $dado[2] ?></td>
            <td><?php echo $dado[3] ?></td>
            <td><a href ="deletar.php?id=<?php echo $dado[0] ?>">Deletar</td>
            <td><a href ="editar.php?id=<?php echo $dado[0] ?>">Alterar</td>
            <td><a href ="ver.php?id=<?php echo $dado[0] ?>">Ver</a></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>