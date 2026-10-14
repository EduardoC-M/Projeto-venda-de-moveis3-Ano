<?php
session_start();
include "conexao/conexao.php";

$mensagemErro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($link, $_POST['usuario']);
    $senha = $_POST['senha'];

    // 1. Busca o usuário
    $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
    $resultado = mysqli_query($link, $query);
    $usuarioDB = mysqli_fetch_assoc($resultado);

    // 2. Verifica a senha
    if ($usuarioDB && password_verify($senha, $usuarioDB['senha'])) {
        // Sucesso: Inicia a sessão
        $_SESSION['logado'] = true;
        $_SESSION['usuario_nome'] = $usuarioDB['usuario'];
        header("Location: lista.php");
        exit();
    } else {
        $mensagemErro = "Usuário ou senha inválidos.";
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="css/estilo.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container-login">
        <h1>Login - Project Moveless</h1>
        <?php if ($mensagemErro): ?>
            <p class="erro"><?php echo $mensagemErro; ?></p>
        <?php endif; ?>
        <form name="loginForm" action="index.php" method="post">
            <label for="usuario">Usuário:</label>
            <input type="text" name="usuario" required><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" required><br>
            <button type="submit">Entrar</button>
        </form>
         <p>Não tem uma conta? <a href="registro.php">Crie uma aqui</a></p> 
    </div>
</body>
</html>