<?php
require_once 'dao/UsuarioDAO.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    echo "Token inválido!";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lógica para redefinir a senha
    $senhaNova = filter_input(INPUT_POST, 'senha_nova');

    // Validação da nova senha
    if (strlen($senhaNova) < 5) {
        echo "A senha deve ter pelo menos 5 caracteres.";
        exit;
    }

    // Buscar usuário pelo token
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getByToken($token); // Você deve implementar este método no UsuarioDAO

    if ($usuario) {
        // Atualizar a senha
        $usuarioDAO->updatePassword($usuario->getId(), password_hash($senhaNova, PASSWORD_DEFAULT)); // Implemente updatePassword no UsuarioDAO
        echo "Senha redefinida com sucesso!";
    } else {
        echo "Token inválido ou expirado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <h2>Redefinir Senha</h2>

    <form action="" method="post">
        <label for="senha_nova">Nova Senha:</label>
        <input type="password" id="senha_nova" name="senha_nova" required>
        <br><br>
        <button type="submit">Redefinir Senha</button>
    </form>
</body>
</html>
