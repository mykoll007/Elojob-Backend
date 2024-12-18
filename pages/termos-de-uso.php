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
    <title>EloJob XCrONOS | Termos de Uso</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/politicas-termos.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

        <!--Icon baixada gratuitamente pela Flaticon-->
        <link rel="icon" href="../assets/images/gladiador.png">

    <meta name="description" content="Leia os termos de uso da EloJob XCrONOS e saiba como utilizamos nossos serviços de forma segura.">
    <meta name="author" content="EloJob XCrONOS">
    <meta name="keywords" content="termos de uso, EloJob, serviços de LOL, condições de uso, regulamentação, acordos">

    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="Termos de Uso - EloJob XCrONOS">
    <meta property="og:site_name" content="EloJob XCrONOS">
    <meta property="og:description" content="Entenda os termos e condições para utilizar os serviços da EloJob XCrONOS.">
    <meta property="og:image" content="https://www.elojobxcronos.com/assets/images/logoCronos.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://elojobxcronos.com/termos-de-uso">

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
            <h1>TERMOS DE USO - Elojob XCrONOS</h1>
            <p>Bem-vindo à Elojob XCrONOS. Ao acessar e usar nosso site, você concorda com os seguintes termos de uso:</p>

            <h4>1. Uso dos Serviços</h4>
            <ul>
                <li>
                    Ao utilizar nossos serviços, você concorda em fornecer informações precisas e completas e em não utilizar o site para fins ilegais ou não autorizados.</li>
            </ul>

            <h4>2. Direitos de Propriedade Intelectual</h4>
            <ul>
                <li>Todo o conteúdo, incluindo textos, gráficos, logotipos, e ícones no site, é de propriedade da Elojob XCrONOS ou de seus licenciadores. Você não pode copiar, modificar, distribuir ou usar qualquer parte do conteúdo sem nossa permissão explícita.</li>
            </ul>

            <h4>3. Política de Pagamento e Reembolsos</h4>
            <ul>
                <li>Todos os pagamentos são processados com segurança e devem ser concluídos antes do início dos serviços. Não oferecemos reembolsos após o serviço ter sido iniciado, exceto em casos de falha comprovada do serviço.</li>

            </ul>

            <h4>4. Conta e Segurança</h4>
            <ul>
                <li>Você é responsável por manter a confidencialidade das informações da sua conta e por todas as atividades que ocorrem sob a sua conta. Notifique-nos imediatamente em caso de uso não autorizado da sua conta.</li>
            </ul>

            <h4>5.Limitação de Responsabilidade</h4>
            <ul>
                <li>A Elojob XCrONOS não se responsabiliza por danos diretos, indiretos, incidentais ou consequenciais resultantes do uso ou da incapacidade de usar nossos serviços.</li>
            </ul>    
            <h4>6.Isenção de Responsabilidade Relacionada à Riot Games</h4>
            <ul>
                <li>A Elojob XCrONOS não é afiliada, associada, endossada ou patrocinada pela Riot Games, Inc. ou por qualquer uma de suas subsidiárias. Todos os serviços oferecidos por nós são independentes e não possuem qualquer vínculo oficial com a Riot Games ou seus produtos, incluindo League of Legends.</li>
            </ul>

            <h4>7.Modificação nos Termos</h4>
            <ul>
                <li>Reservamo-nos o direito de modificar estes termos a qualquer momento. As alterações serão notificadas por meio do nosso site e entrarão em vigor imediatamente após a publicação.</li>
            </ul>

            <h4>8.Conformidade com a LGPD</h4>
            <ul>
                <li>Estamos em conformidade com a Lei Geral de Proteção de Dados (LGPD). Para mais detalhes, consulte nossa Política de Privacidade.</li>
            </ul>

            <h4>9.Contato</h4>
            <ul>
                <li>Para dúvidas ou questões sobre estes Termos de Uso, entre em contato conosco em seuemail@elojobxcronos.com</li>
            </ul>
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