<?php

session_start();

require_once '../model/Usuario.php';
require_once '../dao/UsuarioDAO.php';
require_once 'EmailService.php';


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
    case "recover":
        handleRecuperarSenha();
        break;
    case "codigo" :
        handleCodigoVerificacao();
        break;
    case 'redefinir' :
        handleRedefinirSenha();
        break;
    case "alterar_dados" :
        handleAlterarDados();
        break;
    default:
        echo "Ação inválida";
        break;
}

function formatarDataCadastro($dataCadastro) {
    // Traduz o nome dos meses para português
    $meses = [
        'January' => 'janeiro',
        'February' => 'fevereiro',
        'March' => 'março',
        'April' => 'abril',
        'May' => 'maio',
        'June' => 'junho',
        'July' => 'julho',
        'August' => 'agosto',
        'September' => 'setembro',
        'October' => 'outubro',
        'November' => 'novembro',
        'December' => 'dezembro'
    ];

    // Obtém o mês e o ano da data de cadastro
    $mesTraduzido = $meses[date('F', strtotime($dataCadastro))];
    $ano = date('Y', strtotime($dataCadastro));

    // Retorna a data formatada
    return "{$mesTraduzido} de {$ano}";
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
        // echo "Dados de input inválidos";
        header("Location: ../index.php?erro=input_invalido");
        return;
    }

     // Verificar se a senha tem no mínimo 5 caracteres
    if(strlen($password) < 5) {
        // Redirecionar se a senha for muito curta
        header("Location: ../index.php?erro=senha_curta");
        return;
        }

    if($password !== $confirm_password) {
        // echo "Senhas incompatíveis.";
        header("Location: ../index.php?erro=senhas_incompativeis");
        return;
    }    

    // Etapa de segurança: criação da senha segura e geração do token
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $token = bin2hex(random_bytes(25));

    // Definir a data de cadastro
    $data_cadastro = date('Y-m-d H:i:s');

    // Criação do Usuário no Banco de Dados
    $usuario = new Usuario(null, $nome, $hashed_password, $email, null, $token, $data_cadastro);
    $usuarioDAO = new UsuarioDAO();

    if($usuarioDAO->getByEmail($email))
    {
        // echo "Email já utilizado";
        header("Location: ../index.php?erro=email_ja_registrado");
        return;
    }
   
    // Redirecionar para a página do index
    if($usuarioDAO->create($usuario)) 
    {
        $_SESSION['token'] = $token;
        $_SESSION['email'] = $usuario->getEmail();
        $_SESSION['nome'] = $usuario->getNome();
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
    // echo "Email ou senha inválidos!";
    header("Location: ../index.php?erroLogin=credenciais_invalidas");
    return;
}


    // Geração de novo token e atualização do token no banco de dados
    $token = bin2hex(random_bytes(25));
    $usuarioDAO->updateToken($usuario->getId(), $token);

    $_SESSION['token'] = $token;
    $_SESSION['email'] = $usuario->getEmail();
    $_SESSION['nome'] = $usuario->getNome();



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



if (isset($_POST['action']) && $_POST['action'] === 'recover_password') {
    handleRecuperarSenha();
}


function handleRecuperarSenha()
{
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getByEmail($email);

    if ($usuario) {
        // Gerar um código de verificação de 6 dígitos
        $codigoVerificacao = rand(100000, 999999);
        $usuarioDAO->updateCodigoVerificacao($usuario->getId(), $codigoVerificacao); // Atualizando o código no banco
    
        // Criar uma nova instância do EmailService
        $emailService = new EmailService();

        // Enviar e-mail com o código de verificação
        $to = $usuario->getEmail();
        $subject = 'Código de Verificação para Redefinição de Senha';
        $message = "Seu código de verificação para redefinir a senha é: <strong>$codigoVerificacao</strong>";
    
        $emailService->enviarEmail($to, $subject, $message);
    
         // Redirecionar para a página de redefinição de senha com o código na URL
         header("Location: ../index.php?codigo_enviado=1");
         exit();
    } else {
        // echo "E-mail não encontrado!";    
        header("Location: ../index.php?erroEmail=email_nao_encontrado");
    }
    
}
// ----------------Verificar Codigo----------
if (isset($_POST['action']) && $_POST['action'] === 'verificar_codigo') {
    handleCodigoVerificacao();
}
function handleCodigoVerificacao()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Concatena o código de verificação dos inputs do formulário
        $codigoVerificacao = $_POST['codigo1'] . $_POST['codigo2'] . $_POST['codigo3'] . $_POST['codigo4'] . $_POST['codigo5'] . $_POST['codigo6'];

        $usuarioDAO = new UsuarioDAO();
        // Busca o usuário pelo código de verificação
        $usuario = $usuarioDAO->getByCodigoVerificacao($codigoVerificacao);


        if ($usuario) {
            // Redireciona para o index.php com o código de verificação
            header("Location: ../index.php?codigo_verificacao=" . urlencode($codigoVerificacao));
            exit(); 
        } else {
            
            header("Location: ../index.php?codigo_enviado=1&erro=codigo_invalido");
            exit(); 
        }
    }
}

// -----------------Redefinir------------

function handleRedefinirSenha()
{
    // Receber o código de verificação
    $codigoVerificacao = filter_input(INPUT_POST, 'codigo_verificacao');
    $senhaNova = filter_input(INPUT_POST, 'senha_nova');
    $senhaConfirmacao = filter_input(INPUT_POST, 'senha_confirmacao');

    // Validação da nova senha
    if (strlen($senhaNova) < 5) {
         header("Location: ../index.php?codigo_verificacao=" . urlencode($codigoVerificacao) . "&erro=senha_curta");
        return;
    }
    
    // Verificar se as senhas coincidem
    if ($senhaNova !== $senhaConfirmacao) {
        header("Location: ../index.php?codigo_verificacao=" . urlencode($codigoVerificacao) . "&erro=senhas_nao_coincidem");
        return;
    }

    // Buscar usuário pelo código de verificação
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->getByCodigoVerificacao($codigoVerificacao); 

    if ($usuario) {
        // Atualizar a senha
        $usuarioDAO->updatePassword($usuario->getId(), password_hash($senhaNova, PASSWORD_DEFAULT)); // Função de update de senha
        header("Location: ../index.php?senha_redefinida=1");
        exit(); // Finaliza o script para garantir o redirecionamento
    } else {
        echo "Código de verificação inválido ou expirado!";
    }
}


//----------------Atualizar Alterar Dados------------

function handleAlterarDados() {
    $nome = filter_input(INPUT_POST, "nome");
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, "telefone");
    $senhaAtual = filter_input(INPUT_POST, "senha_atual");

    $usuarioDAO = new UsuarioDAO();

    // Recupera o usuário logado via sessão
    $usuario = $usuarioDAO->getByEmail($_SESSION['email']);

    if ($usuario) {
        // Verifica se a senha atual está correta
        if (password_verify($senhaAtual, $usuario->getSenha())) {
            // Atualiza os dados do usuário
            $usuario->setNome($nome);
            $usuario->setEmail($email);
           
            // Atualiza o telefone apenas se foi informado, se não fica como nulo
            if (!empty($telefone)) {
            $usuario->setTelefone($telefone);
            } else{
                $usuario->setTelefone('');
            }

            // Atualizar no banco de dados
            $usuarioDAO->update($usuario);
            
            // Atualiza a sessão com as novas informações
            $_SESSION['email'] = $email;
            $_SESSION['nome'] = $nome;

            header("Location: ../pages/alterar-dados.php?sucesso=alteracoes_salvas");
        } else {
            header("Location: ../pages/alterar-dados.php?erro=senha_incorreta");
        }
    } else {
        header("Location: ../index.php?erro=usuario_nao_encontrado");
    }
}



?>