<?php

session_start();

require_once '../model/Usuario.php';
require_once '../dao/UsuarioDAO.php';

$type = filter_input(INPUT_POST, "type");

switch($type) 
{
    case "register":
        handlerRegistration();
        break;
    case "login":
        handleLogin();
        break;
    case "logout":
        handleLogout();
        break;
    default:
        echo "Ação inválida";
        break;
}



function handlerRegistration()
{
    // Receber os dados vindos por input do HTML
    $nome = filter_input(INPUT_POST, "nome");
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "register-password");
    $confirm_password = filter_input(INPUT_POST, "confirm-password");

    // Verificar os dados informados
    if(!$email || !$nome || !$password) {
        echo "Dados de input inválidos";
        return;
    }

    if($password !== $confirm_password) {
        echo "Senhas incompatíveis.";
        return;
    }    

    // Etapa de segurança: criação da senha segura e geração do token
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $token = bin2hex(random_bytes(25));

    // Definir a data de cadastro
    $data_cadastro = date('Y-m-d H:i:s');

    // Criação do Usuário no Banco de Dados
    $usuario = new Usuario(null, $nome, $hashed_password, $email, $token, $data_cadastro);
    $usuarioDAO = new UsuarioDAO();

    if($usuarioDAO->getByEmail($email))
    {
        echo "Email já utilizado";
        return;
    }
   
    // Redirecionar para a página do index
    if($usuarioDAO->create($usuario)) 
    {
        $_SESSION['token'] = $token;
        header('Location: ../index.php');
        exit();
    } else 
    {
        echo "Erro ao registrar no banco de dados";
        exit();
    }
}

function handleLogin()
{
    // Recebimento dos dados vindos por input do HTML
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, "password");

    // Verificação do cadastro existente
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getByEmail($email);


   // Verifica se o usuário existe e se a senha informada confere com o hash armazenado
   if (!$usuario || !password_verify($senha, $usuario->getSenha())) {
    echo "Email ou senha inválidos!";
    return;
}


    // Geração de novo token e atualização do token no banco de dados
    $token = bin2hex(random_bytes(25));
    $usuarioDAO->updateToken($usuario->getId(), $token);

    $_SESSION['token'] = $token;
    header('Location: ../index.php');
    exit();
}

function handleLogout(){
    // Limpar todas as variáveis de sessão
    $_SESSION = array();
    // Destruir a sessão
    session_destroy();
    // Redireciona para a página de login
    header("Location: ../index.php");
}

?>