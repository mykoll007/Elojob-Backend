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
    <title>EloJob XCronos | EloJob - Boosting Profissional</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/elojob-duo.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

    <!--Icon baixada gratuitamente pela Flaticon-->
    <link rel="icon" href="../assets/images/gladiador.png">

    <meta name="description"
        content="Experimente nosso serviço de EloJob e suba seu elo em League of Legends com a ajuda de jogadores experientes. Junte-se à EloJob XCrONOS e domine o jogo!">
    <meta name="author" content="EloJob XCrONOS">
    <meta name="keywords"
        content="elojob, elo boost, League of Legends, LOL, melhorar elo, coaching, serviços de LOL, boosting profissional">

    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="EloJob com EloJob XCrONOS - Aumente seu Elo em LOL">
    <meta property="og:site_name" content="EloJob XCrONOS">
    <meta property="og:description"
        content="Aumente seu elo com nosso serviço de EloJob, jogando ao lado de profissionais qualificados da EloJob XCrONOS.">
    <meta property="og:image" content="https://www.elojobxcronos.com/assets/images/logoCronos.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://elojobxcronos.com/elojob">

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
            <!-- Meus Pedidos Em breve -->
             
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
        <div id="elojob">
            <img src="../assets/images/elojob.png" alt="logo elojob">
            <h1>ELOJOB</h1>
            <h4>League of Legends</h4>
        </div>
        <div id="align-paragrafo1">
            <p>Nosso serviço de Elojob é como uma jornada épica: lutamos em sua conta até conquistar a divisão desejada.
                Você, o comandante, escolhe as lanes e campeões que levarão sua bandeira à vitória, e poderá testemunhar
                cada batalha ao vivo em nosso Discord. Se preferir lutar ao lado de seus aliados, sem entregar sua
                conta, o Duoboost é a escolha digna de um verdadeiro guerreiro.</p>
        </div>
        <div id="align-cards">
            <!--Card 1-->
            <div id="card1">
                <h4>ELO ATUAL</h4>
                <div id="content-card1">
                    <img src="../assets/images/ferro.png" alt="imagem elo atual">
                    <p>Liga Atual</p>
                    <select id="liga" name="liga">
                        <option value="ferro">Ferro</option>
                        <option value="bronze">Bronze</option>
                        <option value="prata" selected>Prata</option>
                        <option value="ouro">Ouro</option>
                        <option value="platina">Platina</option>
                        <option value="esmeralda">Esmeralda</option>
                        <option value="diamante">Diamante</option>
                    </select>
                    <p>Divisão Atual</p>
                    <select id="divisao" name="divisao">
                        <option value="1">I</option>
                        <option value="2" selected>II</option>
                        <option value="3">III</option>
                        <option value="4">IV</option>
                    </select>
                </div>
            </div>

            <!--Card 2-->
            <div id="card2">
                <h4>ELO DESEJADO</h4>
                <div id="content-card2">
                    <img src="../assets/images/prata.png" alt="imagem elo definido">
                    <p>Liga Atual</p>
                    <select id="liga-desejada" name="liga-desejada">
                        <option value="ferro">Ferro</option>
                        <option value="bronze">Bronze</option>
                        <option value="prata">Prata</option>
                        <option value="ouro" selected>Ouro</option>
                        <option value="platina">Platina</option>
                        <option value="esmeralda">Esmeralda</option>
                        <option value="diamante">Diamante</option>

                    </select>
                    <p>Divisão Atual</p>
                    <select id="divisao-desejada" name="divisao-desejada">
                        <option value="1">I</option>
                        <option value="2">II</option>
                        <option value="3">III</option>
                        <option value="4" selected>IV</option>
                    </select>
                </div>
            </div>

            <!--Card 3 - Pedido -->
            <div id="pedido">
                <h4>PEDIDO</h4>
                <div id="content-card3">
                    <div id="container-preco">
                        <div id="align-elo">
                            <p>PRATA 2</p>
                            <p>OURO 4</p>
                        </div>
                        <div id="seta-pedido">
                            <p>-></p>
                        </div>
                        <div id="align-eloimg">
                            <img src="../assets/images/ferro.png" alt="imagem elo ferro">
                            <img src="../assets/images/prata.png" alt="imagem elo prata">
                        </div>
                        <hr>
                        <div id="precos">
                            <p>DE: R$ 44,97</p>
                            <p>POR:</p>
                            <p>R$ 33,98</p>
                        </div>
                        <select id="planos" name="planos">
                            <option value="Gladiador">Plano Gladiador</option>
                            <option value="Cronos">Plano Cronos</option>
                        </select>
                        <div id="align-buttonPedido">                    
                            <button>
                                <img src="../assets/images/Whatsapp-icon.png" alt="icone whatsapp">
                                COMPRAR
                            </button>
                        </div>
                    </div>
                    <!--Card alternativo para quando o preço for R$ 0,00-->
                    <div id="card-alternativo">
                        <p>Por favor, verifique se o elo que você deseja é superior ao elo inicial que foi selecionado.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div id="align-planos">
            <div id="plano-gladiador">
                <div class="align-imgplano">
                    <img src="../assets/images/plano-gladiador.png" alt="plano gladiador">
                </div>
                <h2>PLANO GLADIADOR</h2>
                <p>Assuma o campo de batalha com a força de um verdadeiro guerreiro! Neste plano, nós tomamos as rédeas
                    da sua conta e marchamos à vitória com velocidade e precisão. Nosso foco é garantir que você retorne
                    ao confronto o quanto antes, preparado para enfrentar qualquer desafio.</p>
            </div>
            <div id="plano-cronos">
                <div class="align-imgplano">
                    <img src="../assets/images/plano-cronos.png" alt="plano cronos">
                </div>
                <h2>PLANO CRONOS</h2>
                <p>Domine o tempo e o espaço com a sabedoria dos deuses! Neste plano supremo, você pode observar cada
                    passo da jornada ao vivo no nosso Discord, enquanto conversa com o campeão que está impulsionando
                    sua ascensão. Muitos invocadores descobrem que, após vivenciar essa experiência épica, continuam
                    escalando as fileiras por conta própria, com o conhecimento adquirido.</p>
            </div>
        </div>

        <div id="infos-estat">
            <div class="estats">
                <img src="../assets/images/lança.png" alt="imagem de uma lança">
                <p>990</p>
                <p>MISSÕES CUMPRIDAS</p>
            </div>
            <div class="estats">
                <img src="../assets/images/lança.png" alt="imagem de uma lança">
                <p>4000+</p>
                <p>PARTIDAS VENCIDAS</p>
            </div>
            <div class="estats">
                <img src="../assets/images/lança.png" alt="imagem de uma lança">
                <p>80</p>
                <p>GUERREIROS BOOSTERS</p>
            </div>
        </div>

        <div id="especificacoes">
            <h2>ATENÇÃO GUERREIRO!</h2>
            <p>A Elojob XCrONOS oferece um serviço de Elojob seguro e focado no seu aprendizado. Nossos Boosters são
                verdadeiros combatentes, prontos para mostrar como dominar a SoloQ, mesmo em meio a desafios como trolls
                e afks. Sabemos que muitos guerreiros não alcançam seu verdadeiro elo por obstáculos no campo de
                batalha. Estamos aqui para elevar sua experiência de jogo, garantindo que você conquiste suas
                recompensas com tranquilidade. Oferecemos elojob para divisões, MD5, e planos personalizados que se
                adaptam às suas necessidades. Prepare-se para lutar como um verdadeiro campeão!</p>

            <h2>ESPECIFICAÇÕES DO SERVIÇO:</h2>
            <p>Durante o serviço, o cliente não deve jogar partidas ranqueadas. A conta precisa ter ao menos 20 campeões
                habilitados para que possamos executar o elojob.</p>
            <p>Se, por acaso, o booster falhar em uma MD5 ou cair de divisão, garantimos o retorno do elo e das
                classificatórias sem custo adicional.</p>
            <p>Para contas com baixo MMR (menos de 18 pontos por partida), haverá uma taxa adicional de 25% para
                neutralizar a conta.</p>
            <p>Se houver fila, o prazo do serviço pode ser indefinido. Consulte-nos antes de solicitar o serviço.</p>
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
    <script src="../assets/js/elojob.js"></script>
    <script src="../assets/js/particles.min.js"></script>

</body>

</html>