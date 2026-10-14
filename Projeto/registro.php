<?php
session_start();
include "conexao/conexao.php";

$mensagemFeedback = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = mysqli_real_escape_string($link, $_POST['usuario']);
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    // 1. Validação de Senha
    if ($senha !== $confirma_senha) {
        $mensagemFeedback = "<p class='erro'>As senhas não coincidem. Tente novamente.</p>";
    } elseif (strlen($senha) < 6) {
        $mensagemFeedback = "<p class='erro'>A senha deve ter pelo menos 6 caracteres.</p>";
      } else {
        // 2. Verifica se o usuário já existe
        $query_check = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
        $resultado_check = mysqli_query($link, $query_check);
        
        if ($resultado_check === false) {
            // Se a consulta falhar, mostre o erro real (apenas para depuração)
            $mensagemFeedback = "<p class='erro'>Erro Crítico de DB: Não foi possível verificar o usuário. <br>Detalhe: " . mysqli_error($link) . "</p>";
        } 
        
        elseif (mysqli_num_rows($resultado_check) > 0) {
            $mensagemFeedback = "<p class='erro'>Este usuário (ou e-mail) já está em uso.</p>";
        } else {
// ... restante do código para criptografar e inserir ...
            // 3. Criptografa a senha e insere
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $query_insert = "INSERT INTO usuarios (usuario, senha) VALUES ('$usuario', '$senha_hash')";

            if (mysqli_query($link, $query_insert)) {
                $mensagemFeedback = "<p class='sucesso'>Conta criada com sucesso! Faça login abaixo.</p>";
                // Opcional: Redirecionar para o login
                // header("Refresh: 3; URL=login.php");
            } else {
                $mensagemFeedback = "<p class='erro'>Erro ao registrar. Tente novamente.</p>";
            }
        }
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuário</title>
    <link href="css/estilo.css" type="text/css" rel="stylesheet">
    <style>
        .sucesso { color: green; font-weight: bold; }
        .erro { color: red; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container-login">
        <h1>Criar Nova Conta</h1>
        <?php echo $mensagemFeedback; ?>
        <form name="registroForm" action="registro.php" method="post">
            <label for="usuario">Usuário (ou E-mail)</label>
            <input type="text" name="usuario" required><br>
            <label for="senha">Senha (mínimo 6 caracteres)</label>
            <input type="password" name="senha" required><br>
            <label for="confirma_senha">Confirmar Senha</label>
            <input type="password" name="confirma_senha" required><br>
            <button type="submit">Registrar</button>
        </form>
        <p>Já tem uma conta? <a href="index.php">Faça Login</a></p>
    </div>
</body>
</html>