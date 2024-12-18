<?php

session_start();
require_once '../dao/UsuarioDAO.php';
require_once '../model/Usuario.php';


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EloJob XCrONOS | Política de Privacidade</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/politicas-termos.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

    <!--Icon baixada gratuitamente pela Flaticon-->
    <link rel="icon" href="../assets/images/gladiador.png">

    <meta name="description"
        content="Saiba mais sobre como a EloJob XCrONOS coleta, utiliza e protege suas informações pessoais.">
    <meta name="author" content="EloJob XCrONOS">
    <meta name="keywords"
        content="política de privacidade, EloJob, proteção de dados, informações pessoais, serviços de LOL">

    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="Política de Privacidade - EloJob XCrONOS">
    <meta property="og:site_name" content="EloJob XCrONOS">
    <meta property="og:description" content="Entenda como a EloJob XCrONOS cuida da sua privacidade e dados pessoais.">
    <meta property="og:image" content="https://www.elojobxcronos.com/assets/images/logoCronos.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://elojobxcronos.com/politica-privacidade">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

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
            <form action="../service/AuthService.php" method="post">
        <input type="hidden" name="type" value="login_index">
        <button type="submit" class="login-btn" id="btnIniciar">
            INICIAR SESSÃO
        </button>
    </form>
        <?php endif; ?>
        
    </header>
    <main>
        <div id="container-politica">
            <h1>POLÍTICA DE PRIVACIDADE - Elojob XCrONOS</h1>
            <p>Bem-vindo à Elojob XCrONOS! Sua privacidade é importante para nós. Esta Política de Privacidade descreve
                como coletamos, usamos, protegemos e compartilhamos suas informações pessoais quando você utiliza nosso
                site e nossos serviços.</p>

            <h4>1. Informações coletadas</h4>

            <p>Coletamos informações pessoais que você nos fornece diretamente ao se registrar em nosso site, fazer um
                pedido ou entrar em contato conosco. Essas informações podem incluir:</p>

            <ul>
                <li>Nome completo;</li>
                <li>Endereço de e-mail;</li>
                <li>Telefone;</li>
                <li>Nome de usuário e senha;</li>
                <li>Informações de pagamento (como dados de cartão de crédito ou conta Mercado Pago);</li>
                <li>Informações sobre o uso dos nossos serviços, incluindo informações sobre o jogo e a conta de jogo;
                </li>
                <li>Endereço IP e informações de localização;</li>
                <li>Dados de navegação e comportamento no site.</li>
            </ul>

            <h4>2. Como Usamos Suas Informações</h4>

            <p>Usamos suas informações pessoais para:</p>

            <ul>
                <li>Processar e gerenciar seus pedidos e serviços;</li>
                <li>Melhorar a experiência do usuário no site;</li>
                <li>Enviar atualizações e notificações sobre seu pedido;</li>
                <li>Responder a perguntas, dúvidas ou solicitações;</li>
                <li>Realizar análises e pesquisas para melhorar nossos serviços;</li>
                <li>Proteger contra fraudes e abusos.</li>
            </ul>

            <h4>3. Compartilhamento de Informações</h4>

            <p>Não vendemos, alugamos ou compartilhamos suas informações pessoais com terceiros, exceto nos seguintes
                casos:</p>

            <ul>
                <li>Para processar pagamentos, podemos compartilhar informações com processadores de pagamento de
                    terceiros.</li>
                <li>Para cumprir a lei, regulamentos ou ordens judiciais.</li>
                <li>Para proteger nossos direitos, propriedade e segurança e de nossos usuários.</li>
            </ul>

            <h4>4. Segurança das Informações</h4>

            <p>Adotamos medidas de segurança técnicas e organizacionais para proteger suas informações pessoais contra
                acesso não autorizado, perda, uso indevido, divulgação ou alteração. No entanto, nenhum método de
                transmissão ou armazenamento é 100% seguro, e não podemos garantir a segurança absoluta das suas
                informações.</p>

            <h4>5. Cookies e Tecnologias de Rastreamento</h4>

            <p>Utilizamos cookies e tecnologias similares para melhorar a funcionalidade do nosso site, personalizar sua
                experiência e analisar como você usa nossos serviços. Você pode ajustar as configurações do seu
                navegador para recusar cookies, mas isso pode afetar a funcionalidade do nosso site.</p>

            <h4>6. Links para Sites de Terceiros</h4>

            <p>Nosso site pode conter links para sites de terceiros. Não somos responsáveis pelas práticas de
                privacidade desses sites e recomendamos que você leia as políticas de privacidade de qualquer site de
                terceiros que visite.</p>

            <h4>7. Seus Direitos de Privacidade</h4>

            <p>Dependendo da sua localização, você pode ter direitos sobre suas informações pessoais, incluindo o
                direito de acessar, corrigir, excluir ou restringir o uso de suas informações. Para exercer esses
                direitos, entre em contato conosco através das informações fornecidas abaixo.</p>

            <h4>8. Alterações a Esta Política de Privacidade</h4>

            <p>Podemos atualizar esta Política de Privacidade periodicamente. Qualquer alteração será publicada nesta
                página, e recomendamos que você reveja esta política regularmente para se manter informado sobre como
                protegemos suas informações.</p>

            <h4>9. Contato</h4>

            <p>Se você tiver dúvidas sobre esta Política de Privacidade ou sobre nossas práticas de proteção de dados,
                entre em contato conosco:</p>

            <p>E-mail: seuemail@elojobxcronos.com</p>

            <h4>10. Conformidade com a LGPD</h4>

            <p>A Elojob XCrONOS está em conformidade com a Lei Geral de Proteção de Dados (LGPD). Respeitamos seus
                direitos de acessar, corrigir, excluir ou restringir o uso de seus dados pessoais. Para mais informações
                ou para exercer seus direitos, entre em contato conosco.</p>
        </div>



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



</body>

</html>