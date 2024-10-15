<?php
    session_start();
    require_once '../dao/UsuarioDAO.php';
    require_once '../model/Usuario.php';

      // Verifique se o usuário está logado e os dados estão na sessão
      if (!isset($_SESSION['email'])) {
        // Redirecionar para a página de login se o usuário não estiver logado
        header('Location: ../index.php');
        exit();
    }
    $usuarioDAO = new UsuarioDAO();
    $email = $_SESSION['email'];
    $dataCadastroFormatada = $usuarioDAO->getDataCadastroFormatada($_SESSION['email']);

    
    // Buscar o usuário pelo email
    if ($email) {
        $usuario = $usuarioDAO->getByEmail($email);
    } else {
        $usuario = null; // Se não houver email na sessão, defina como nulo
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EloJob XCrONOS | Meus Pedidos</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/meus-pedidos.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

        <!--Icon baixada gratuitamente pela Flaticon-->
        <link rel="icon" href="../assets/images/gladiador.png">

        <meta name="description" content="Altere suas informações de conta na EloJob XCrONOS de forma segura e rápida.">
        <meta name="author" content="EloJob XCrONOS">
        <meta name="keywords" content="meus pedidos, conta EloJob, pedidos feitos, serviços de LOL">
        
        <meta property="og:locale" content="pt_BR">
        <meta property="og:title" content="Meus Pedidos - EloJob XCrONOS">
        <meta property="og:site_name" content="EloJob XCrONOS">
        <meta property="og:description" content="Veja status dos seus pedidos da conta na EloJob XCrONOS.">
        <meta property="og:image" content="https://www.elojobxcronos.com/assets/images/logoCronos.png">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://elojobxcronos.com/meus-pedidos">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>


<body>
<header>
        <div id="align-logoHambu">
            <a href="../index.php"><img src="../assets/images/logoCronos.png" alt="Logo XCrONOS" class="logo"></a>
            <span id="IconMenu" class="material-symbols-outlined">
                menu
            </span>
        </div>
        <nav id="itens">
            <ul>
                <li><a href="../index.php">INÍCIO</a></li>
                <li><a href="elojob.php">ELOJOB</a></li>
                <li><a href="duoboost.php">DUOBOOST</a></li>
                <li><a href="md5.php">MD5</a></li>
                <li><a href="coach.php">COACH</a></li>
                <li><a href="eventos.php">EVENTOS</a></li>

                <?php if(isset($_SESSION['token'])) : ?>
                <div class="itens-logado">
                    <!-- Meus Pedidos Em Breve -->
                    <!-- <li><a href="meus-pedidos.php">Meus Pedidos</a></li> -->
                    <li><a href="alterar-dados.php">Alterar dados</a></li>
                    <li>
                        <form action="../service/AuthService.php" method="post">
                            <input type="hidden" name="type" value="logout">
                            <button type="submit">
                                Sair
                            </button>
                        </form>
                    </li>
                    <div>
                        <?php endif; ?>
            </ul>
        </nav>
        <?php if(isset($_SESSION['token'])) : ?>
        <div class="avatar">
            <img src="../assets/images/usuario.png" alt="icone usuario">
        </div>

        <!--Parte Usuario-->

        <div class="content-usuario">
            <img src="../assets/images/usuario.png" alt="icone usuario">
            <h4>
                <?php echo $_SESSION['nome']; ?>
            </h4>
            <p class="email">
                <?php echo $_SESSION['email']; ?>
            </p>
            <!-- Meus Pedidos Em Breve -->
            <!-- <div class="align-itensUsuario">
                <img src="../assets/images/carrinho.png" alt="icone carrinho de pedidos">
                <a href="meus-pedidos.php">
                    <p>Meus Pedidos</p>
                </a>
            </div> -->
            <div class="align-itensUsuario">
                <img src="../assets/images/Database.png" alt="icone carrinho de pedidos">
                <a href="alterar-dados.php">
                    <p>Alterar dados</p>
                </a>
            </div>

            <form action="../service/AuthService.php" method="post">
                <input type="hidden" name="type" value="logout">
                <button class="align-itensUsuario" id="logout" type="submit">
                    <img src="../assets/images/Logout.png" alt="ícone de logout">
                    Sair
                </button>
            </form>
        </div>

        <?php else : ?>
        <a href="index.php" class="login-btn" id="btnIniciar">
            INICIAR SESSÃO
        </a>
        <?php endif; ?>
    </header>

    <main>
        <div id="container-editar">
            <div id="align-user">
                <img src="../assets/images/Usuario-fundobranco.png" alt="icone do usuario">
                <div id="user">
                <h2><?php echo htmlspecialchars($usuario->getNome());?></h2>
                <p>Forjado na arena desde <b><?php echo $dataCadastroFormatada; ?></b></p>
                </div>
            </div>
    <section>
            <div id="menu-pedidos">
            <h4>Meus Pedidos</h4>
            <span>01</span>
            </div>
            <div class="numero-pedido">
            <p>Pedido #13456 - 15/10/2024</p>
            </div>
            <div class="container-pedido">
            <div class="fundo-preto">
                <div class="align-info">
                    <p>Serviço : Elojob</p>
                    <p>Aguardando Pagamento</p>
                </div>
            </div>

            <div class="situacao">
                <p>Seu pedido foi recebido! Aguardando a confirmação do pagamento para gerar o código de ativação. Assim que o pagamento for concluído, seu código estará disponível aqui para iniciar o serviço.</p>
            </div>
        </div>


    </section>
    
    <a href="https://wa.me/5511991983299?text=Olá%20preciso%20de%20ajuda%20vim%20pela%20ElojobXCronos." target="_blank"><div class="whatsapp">
            <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="30">
        </div>
        </a>
    </main>

    <footer>
        <div class="container-footer">
            <div id="content-footer1">
                <img src="../assets/images/logoCronos.png" alt="logo XCrONOS" id="logo-footer">
                <div>
                    <p>Elojob XCrONOS: Sua segurança e satisfação são nossas prioridades. Com uma equipe de
                        especialistas e processos rigorosos, garantimos serviços rápidos, discretos e eficientes para
                        você alcançar o topo com total confiança.</p>
                    <div id="align-icons">
                        <a href="https://wa.me/5511991983299?text=Olá%20preciso%20de%20ajuda%20vim%20pela%20ElojobXCronos."
                            target="_blank">
                            <img src="../assets/images/Whatsapp-icon.png" class="whatsapp-icon" alt="icone Whatsapp">
                        </a>
                        <a href="https://www.instagram.com/elojobxcronos" target="_blank">
                            <img src="../assets/images/instagram-icon.png" class="instagram-icon" alt="icone Instagram">
                        </a>
                    </div>
                </div>
            </div>
            <ul>
                <li><a href="../index.php">INICIO</a></li>
                <li id="servicos"><a href="../index.php#container-jogos">SERVIÇOS</a></li>
                <li><a href="https://wa.me/5511991983299?text=Olá%20preciso%20de%20ajuda%20vim%20pela%20ElojobXCronos."
                        target="_blank">CONTATO</a></li>
                <li><a href="termos-de-uso.php">TERMOS DE USO</a></li>
                <li><a href="politica-privacidade.php">POLITICAS DE PRIVACIDADES</a></li>
            </ul>
            <div id="formaspag">
                <p>FORMAS DE PAGAMENTO</p>
                <img src="../assets/images/formas-pag.png" id="icone-forma" alt="icones de formas de pagamento">
                <a href="https://transparencyreport.google.com/safe-browsing/search?url=https:%2F%2Fwww.elojobxcronos.com.br%2F" target="_blank"><img
                        src="../assets/images/site-seguro.png" alt="icone de site seguro"></a>
            </div>
        </div>
        <div>
            <p id="direitos">© 2024 Elojob XCrONOS. Todos os direitos reservados.</p>
            <div id="particles-js"></div>
        </div>
    </footer>

    <script src="../assets/js/global.js"></script>
    <script src="../assets/js/particles.min.js"></script>
    <script src="../assets/js/alterar-dados.js"></script>

    

</body>

</html>