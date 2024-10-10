<?php
require_once 'dao/UsuarioDAO.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigoVerificacao = filter_input(INPUT_POST, 'codigo_verificacao', FILTER_SANITIZE_NUMBER_INT);
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getByCodigoVerificacao($codigoVerificacao); // Função para buscar usuário pelo código

    if ($usuario) {
        // Redireciona para a página de redefinir senha com o código na URL
        header("Location: redefinir_senha.php?codigo_verificacao=$codigoVerificacao");
        exit;
    } else {
        echo "Código de verificação inválido!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
</head>
<body>
    <h2>Insira o Código de Verificação</h2>
    <form action="" method="post">
        <label for="codigo_verificacao">Código de Verificação:</label>
        <input type="text" id="codigo_verificacao" name="codigo_verificacao" required>
        <br><br>
        <button type="submit">Verificar</button>
    </form>
</body>
</html>
