<?php
session_start();

require_once 'dao/UsuarioDAO.php';
require_once 'model/Usuario.php';

$usuarioDAO = new UsuarioDAO();

// Obtenha o email armazenado na sessão
$email = $_SESSION['user_email'] ?? null;

// Verifique se o email existe na sessão antes de tentar buscar o usuário
if ($email) {
    $usuario = $usuarioDAO->getByEmail($email);
} else {
    $usuario = null; // Se não houver email na sessão, defina como nulo
}

// ----Comportamentos dos Modais---- 

// Verifica se há um erro de registro na URL  - *Modal Registrar*
if (isset($_GET['erro'])) {
    $erro = $_GET['erro'];

    // Exibe mensagens de erro personalizadas
    if ($erro == 'input_invalido') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('erroCadastrar').innerText = 'Todos os campos são obrigatórios.';
                openModalRegistrar(); // Função para abrir o modal de cadastro
            });
        </script>";
    } elseif ($erro == 'senhas_incompativeis') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('erroCadastrar').innerText = 'As senhas não coincidem.';
                openModalRegistrar(); // Função para abrir o modal de cadastro
            });
        </script>";
    } elseif ($erro == 'email_ja_registrado') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('erroCadastrar').innerText = 'O email já está registrado.';
                openModalRegistrar(); // Função para abrir o modal de cadastro
            });
        </script>";
    } elseif ($erro == 'senha_curta') {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('erroCadastrar').innerText = 'A senha deve ter pelo menos 5 caracteres.';
                openModalRegistrar(); // Função para abrir o modal de cadastro
            });
        </script>";
    }
}

// Verifica se há erro de credenciais inválidas na URL - *Modal Login*
if (isset($_GET['erroLogin']) && $_GET['erroLogin'] == 'credenciais_invalidas') {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('erroLogin').innerText = 'Email ou senha inválidos!';
            openModalIniciar(); // Função para abrir o modal de login
        });
    </script>";
}

// Exibir mensagem de erro ao não encontrar o e-mail - *Modal Recuperar*
if (isset($_GET['erroEmail'])) {
    if ($_GET['erroEmail'] === 'email_nao_encontrado') {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function(){
            document.getElementById('erroEmail').textContent = 'E-mail não encontrado!';
            openModalRecuperarSenha();
        });
        </script>";
    }
}


// Verifique se o código foi enviado e abra o modal - *Modal Abrir Código de Verificação*
if (isset($_GET['codigo_enviado']) && $_GET['codigo_enviado'] == 1) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            openModalDigiteCodigo(); // Função para abrir o modal de código
        });
    </script>";
}

// Verificar se o código de verificação foi passado na URL - *Modal Redefinir*
if (isset($_GET['codigo_verificacao'])) {
    $codigoVerificacao = htmlspecialchars($_GET['codigo_verificacao']);
    $erro = isset($_GET['erro']) ? htmlspecialchars($_GET['erro']) : '';

    echo "<script>
        function openModalRenovaSenha() {
            closeModals();
            document.getElementById('modalRenovaSenha').style.display = 'flex'; 
            document.getElementById('modalRenovaSenha').style.position = 'fixed';
            document.getElementById('codigo_verificacao').value = '$codigoVerificacao'; // Adiciona o código ao campo oculto
            // Exibir mensagem de erro, se houver
            if ('$erro' === 'senha_curta') {
                document.getElementById('erroMensagem').textContent = 'A senha deve ter pelo menos 5 caracteres.';
            } else if ('$erro' === 'senhas_nao_coincidem') {
                document.getElementById('erroMensagem').textContent = 'As senhas não coincidem. Tente novamente.';
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            openModalRenovaSenha();
        });

    </script>";
}


// Exibir mensagem de sucesso ao redefinir a senha - *Modal Mensagem Senha Redefinida*
if (isset($_GET['senha_redefinida']) && $_GET['senha_redefinida'] == 1) {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function () {
        openModalMensagem(); 
    });
</script>";
}
// Exibir mensagem de sucesso ao excluir a conta - *Modal Mensagem Conta Excluida*
if (isset($_GET['sucesso'])) {
    $sucesso = $_GET['sucesso'];

    if($sucesso == 'conta_excluida'){
    echo "<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('modalMensagemExcluido').style.display = 'flex';
        document.getElementById('modalMensagemExcluido').style.position = 'fixed';
    });
</script>";
    }
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EloJob XCrONOS | Elojob - DuoBoost - MD5 - Coach</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link rel="stylesheet" href="assets/css/keyframes.css">

    <!--Icon baixada gratuitamente pela Flaticon-->
    <link rel="icon" href="assets/images/gladiador.png">

    <meta name="description"
        content="EloJob XCrONOS oferece serviços de elo boosting, Duo Boost, MD5 e Coaching para League of Legends. Melhore seu desempenho com profissionais experientes.">
    <meta name="author" content="EloJob XCrONOS">
    <meta name="keywords"
        content="elo job, elojob, elo boost, duoboost, md5, coaching, League of Legends, LOL, subir elo, serviços de LOL, EloJob XCrONOS">

    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="EloJob XCrONOS - Elo Boosting e Coaching">
    <meta property="og:site_name" content="EloJob XCrONOS">
    <meta property="og:description"
        content="Aumente seu elo em League of Legends com os serviços de elo boosting, Duo Boost e Coaching da EloJob XCrONOS.">
    <meta property="og:image" content="https://www.elojobxcronos.com/assets/images/logoCronos.png">
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://elojobxcronos.com">


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
            <a href="index.html"><img src="assets/images/logoCronos.png" alt="Logo XCrONOS" class="logo"></a>
            <span id="IconMenu" class="material-symbols-outlined">
                menu
            </span>
        </div>
        <nav id="itens">
            <ul>
                <li><a href="#">INÍCIO</a></li>
                <li><a href="pages/elojob.html">ELOJOB</a></li>
                <li><a href="pages/duoboost.html">DUOBOOST</a></li>
                <li><a href="pages/md5.html">MD5</a></li>
                <li><a href="pages/coach.html">COACH</a></li>
                <li><a href="pages/eventos.html">EVENTOS</a></li>

                <?php if(isset($_SESSION['token'])) : ?>
                <div class="itens-logado">
                    <li><a href="pages/alterar-dados.php">Meus Pedidos</a></li>
                    <li><a href="pages/alterar-dados.php">Alterar dados</a></li>
                    <li>
                        <form action="../elojob-backend/service/AuthService.php" method="post" style="display: inline;">
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
            <img src="assets/images/usuario.png" alt="icone usuario">
        </div>

        <!--Parte Usuario-->

        <div class="content-usuario">
            <img src="assets/images/usuario.png" alt="icone usuario">
            <h4>
                <?php echo $_SESSION['nome']; ?>
            </h4>
            <p class="email">
                <?php echo $_SESSION['email']; ?>
            </p>
            <div class="align-itensUsuario">
                <img src="assets/images/carrinho.png" alt="icone carrinho de pedidos">
                <a href="pages/eventos.html">
                    <p>Meus Pedidos</p>
                </a>
            </div>
            <div class="align-itensUsuario">
                <img src="assets/images/Database.png" alt="icone carrinho de pedidos">
                <a href="pages/alterar-dados.php">
                    <p>Alterar dados</p>
                </a>
            </div>

            <form action="../elojob-backend/service/AuthService.php" method="post">
                <input type="hidden" name="type" value="logout">
                <button class="align-itensUsuario" id="logout" type="submit">
                    <img src="assets/images/Logout.png" alt="ícone de logout">
                    Sair
                </button>
            </form>
        </div>

        <?php else : ?>
        <a href="index.php" class="login-btn" id="btnIniciar" onclick="openModalIniciar()">
            INICIAR SESSÃO
        </a>
        <?php endif; ?>
    </header>
    <main>


        <!--Conteúdo-->
        <section class="hero">

            <h1>ASCENDA AO TOPO COM A ELOJOB XCrONOS!</h1>
            <div id="align-heroP">
                <p>Conquiste o topo com a Elojob XCRONOS! Nossos gladiadores estão prontos para lutar ao seu lado,
                    disponíveis 24h para ajudá-lo a superar qualquer desafio e alcançar a vitória. Enfrente a arena com
                    coragem e determinação, e deixe que a XCRONOS o guie rumo à glória.</p>
            </div>
        </section>

        <!--Opção de Jogos-->

        <section id="container-jogos">
            <h1>Escolha seu jogo:</h1>
            <div id="jogos">
                <div id="circl1" class="circle-log">
                    <img src="assets/images/logolol.png" alt="logo do lol">
                </div>
                <div id="circle2" class="circle-log">
                    <p>EM BREVE...</p>
                </div>
            </div>
        </section>


        <!--Serviços-->
        <section id="container-cards">

            <a href="pages/elojob.html">
                <div id="card-elo" class="card">
                    <img src="assets/images/elojob.png" alt="Imagem serviço elojob">
                    <h2>ElO JOB</h2>
                    <p>Preso em uma divisão? Deixe nossos profissionais subirem seu ELO por você.</p>
                    <span class="botao">CONTRATAR</span>
                </div>
            </a>

            <a href="pages/duoboost.html">
                <div id="card-duo" class="card">
                    <img src="assets/images/duoboost.png" alt="Imagem serviço duoboost">
                    <h2>DUO BOOST</h2>
                    <p>Com o DuoBoost, você aumenta suas chances de vitória e atinge o ELO desejado com mais facilidade.
                    </p>
                    <span class="botao">CONTRATAR</span>
                </div>
            </a>

            <a href="pages/md5.html">
                <div id="card-md5" class="card">
                    <img src="assets/images/md5.png" alt="Imagem serviço md5">
                    <h2>MD5</h2>
                    <p>Não perca sua série! Com nosso suporte, suas MD5 são vencidas com facilidade, garantindo sua
                        subida
                        de ELO.</p>
                    <span class="botao">CONTRATAR</span>
                </div>
            </a>

            <a href="pages/coach.html">
                <div id="card-coach" class="card">
                    <img src="assets/images/coach.png" alt="Imagem serviço coach">
                    <h2>COACH</h2>
                    <p>Aprimore suas habilidades com treinamentos intensivos ao lado de verdadeiros mestres da arena!
                    </p>
                    <span class="botao">CONTRATAR</span>
                </div>
            </a>
        </section>

        <h1>Vantagens de Escolher a ELOJOB XCrONOS</h1>

        <!--Vantagens-->
        <section class="vantagens">
            <div id="vantagens1-2">
                <div id="vantagem1">
                    <img src="assets/images/guerreiro.png" alt="logo guerreiro">
                    <h2>Guerreiros de Elite</h2>
                    <p>Nossa legião de combatentes escolhidos a dedo está pronta para levá-lo ao topo com segurança.</p>
                </div>
                <div id="vantagem2">
                    <img src="assets/images/protecao.png" alt="logo escudo">
                    <h2>Proteção Implacável</h2>
                    <p>Protegemos suas informações e mantemos o chat em silêncio para uma jornada discreta e livre de
                        riscos.</p>
                </div>
            </div>

            <div id="vantagens3-4">
                <div id="vantagem3">
                    <img src="assets/images/vigilancia.png" alt="logo olho viligante">
                    <h2>Vigilância 24/7</h2>
                    <p>Estamos sempre prontos, dia e noite, para atender às suas necessidades. Nossa dedicação é
                        constante,
                        garantindo que sua escalada na classificação seja rápida e eficiente.</p>
                </div>
                <div id="vantagem4">
                    <img src="assets/images/serviços.png" alt="logo olho viligante">
                    <h2>Serviços Sob Medida</h2>
                    <p>Oferecemos serviços personalizados para atender suas necessidades únicas, seja elojob solo, duo
                        boost
                        ou treinamento intensivo.</p>
                </div>
            </div>
        </section>

        <!--Separação Entre  Vantagens e Avaliações-->
        <div class="linha-container">
            <div class="linha"></div>
            <div class="logo">
                <img src="assets/images/logoCronos.png" alt="Logo">
            </div>
            <div class="linha"></div>
        </div>

        <!--Avaliações-->
        <section class="avaliacoes">
            <div class="estrelas">
                <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                <img src="assets/images/Star-rate.png" alt=" imagem estrela">
            </div>
            <h1>Algumas de Nossas Avaliações</h1>
            <p id="avaliado">Avaliado com distinção: 5 estrelas de 5, fundamentado em 1041 testemunhos.</p>

            <div class="container-feedback">
                <!--Card do Feedback 1-->
                <div class="feedback" id="feedback1">
                    <div class="align-nomeStars">
                        <div class="align-nome">
                            <div class="icon-feed">
                                <p>FW</p>
                            </div>
                            <div class="dois-text">
                                <p>Felipe W.</p>
                                <p>21/03/23 - Elojob</p>
                            </div>
                        </div>
                        <div class="estrelas-peq">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                        </div>
                    </div>
                    <p class="comentario">Serviço incrível! Eu estava travado no Ouro há meses, e em menos de uma semana
                        eles me ajudaram a subir para Platina. O processo foi rápido e super seguro. Recomendo demais!
                    </p>
                </div>

                <!--Card do Feedback 2-->
                <div class="feedback" id="feedback2">
                    <div class="align-nomeStars">
                        <div class="align-nome">
                            <div class="icon-feed">
                                <p>CT</p>
                            </div>
                            <div class="dois-text">
                                <p>Carlos T.</p>
                                <p>18/05/23 - DuoBoost</p>
                            </div>
                        </div>
                        <div class="estrelas-peq">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                        </div>
                    </div>
                    <p class="comentario">Jogar com um booster foi incrível! Subi de Ouro III para Platina IV
                        rapidamente e ainda aprendi muito nas partidas. Comunicação excelente, recomendo!</p>
                </div>
                <!--Card do Feedback 3-->
                <div class="feedback" id="feedback3">
                    <div class="align-nomeStars">
                        <div class="align-nome">
                            <div class="icon-feed">
                                <p>JA</p>
                            </div>
                            <div class="dois-text">
                                <p>Júlia A.</p>
                                <p>12/09/24 - MD5</p>
                            </div>
                        </div>
                        <div class="estrelas-peq">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                        </div>
                    </div>
                    <p class="comentario">Precisava garantir um bom elo nas MD5 e não me arrependi! Ganharam 5 de 5
                        partidas e comecei no Platina. Serviço excelente e rápido!</p>
                </div>
                <!--Card do Feedback 4-->
                <div class="feedback" id="feedback4">
                    <div class="align-nomeStars">
                        <div class="align-nome">
                            <div class="icon-feed">
                                <p>MR</p>
                            </div>
                            <div class="dois-text">
                                <p>Matheus R.</p>
                                <p>02/04/24 - Coach</p>
                            </div>
                        </div>
                        <div class="estrelas-peq">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                            <img src="assets/images/Star-rate.png" alt=" imagem estrela">
                        </div>
                    </div>
                    <p class="comentario">O coaching mudou meu jogo. O coach foi claro, paciente e me ajudou a melhorar
                        visão de mapa e controle de rota. Minha evolução foi nítida em poucas semanas!</p>
                </div>
            </div>
        </section>
        <!--Informações sobre os serviços completados e os boosters online-->
        <section>
            <div id="container-infos">
                <div class="missoes_boosters">
                    <img src="assets/images/trofeu.png" alt="icone trofeu">
                    <h4>+10.023</h4>
                    <p>Missões Cumpridas</p>
                </div>
                <div class="missoes_boosters">
                    <img src="assets/images/Team.png" alt="icone boosters">
                    <h4>16</h4>
                    <p>Boosters Onlines</p>
                </div>
                <a href="#container-jogos" class="button-link">Inicie sua Ascenção!</a>
            </div>
        </section>
        <!--Perguntas Frequentes-->
        <section class="perguntas">
            <h1>Perguntas Frequentes</h1>
            <div class="container-accordeon">
                <!--Acordeon 1* item-->
                <div class="accordeon-item">
                    <button class="accorder-header" id="btn-acordeon1"> A Elojob XCrONOS é confiável?
                        <img src="assets/images/seta-baixo.png" alt="seta para baixo">
                    </button>
                </div>
                <div class="resposta-acordeon" id="accordeon1">
                    <p>Sim, nossa equipe é composta por jogadores experientes e profissionais que garantem a
                        segurança e confidencialidade dos serviços prestados.</p>
                </div>
                <!--Acordeon 2* item-->
                <div class="accordeon-item">
                    <button class="accorder-header" id="btn-acordeon2"> Quais são os métodos de pagamento aceitos?
                        <img src="assets/images/seta-baixo.png" alt="seta para baixo">
                    </button>
                </div>
                <div class="resposta-acordeon" id="accordeon2">
                    <p>Aceitamos uma variedade de métodos de pagamento, incluindo Pix, PayPal e transferências
                        bancárias, para oferecer maior comodidade aos nossos clientes.</p>
                </div>
                <!--Acordeon 3* item-->
                <div class="accordeon-item">
                    <button class="accorder-header" id="btn-acordeon3"> O que são os eventos da EloJob XCrONOS?
                        <img src="assets/images/seta-baixo.png" alt="seta para baixo">
                    </button>
                </div>
                <div class="resposta-acordeon" id="accordeon3">
                    <p>Os eventos da EloJob XCrONOS incluem competições, torneios e atividades voltadas para a
                        comunidade de eSports. Eles oferecem oportunidades para interação, competição e aprimoramento de
                        habilidades. Fique de olho na nossa página para novidades!</p>
                </div>
                <!--Acordeon 4* item-->
                <div class="accordeon-item">
                    <button class="accorder-header" id="btn-acordeon4"> Quanto tempo leva para completar um Elojob?
                        <img src="assets/images/seta-baixo.png" alt="seta para baixo">
                    </button>
                </div>
                <div class="resposta-acordeon" id="accordeon4">
                    <p>O tempo varia de acordo com o elo atual e o desejado, mas geralmente concluímos o serviço em
                        poucos dias. Caso o prazo se estenda, oferecemos bônus, como vitórias extras ou descontos em
                        futuros serviços, garantindo sua satisfação.</p>
                </div>
            </div>

            <p id="converse-conosco">Não encontrou o que procura? <a
                    href="https://wa.me/5511991983299?text=Olá%20preciso%20de%20ajuda%20vim%20pela%20ElojobXCronos."
                    target="_blank">CONVERSE CONOSCO</a></p>
        </section>
        <hr>
        <!--Chamada para os Serviços-->

        <div id="chamada-serv">
            <a href="#container-jogos">
                <div id="align-chamada">
                    <div>
                        <p>Pronto para sua ascensão?</p>
                        <h2>ERGA SUA LÂMINA E DOMINE A BATALHA!</h2>
                    </div>
                    <img src="assets/images/seta-direita.png" alt="seta para direita">
                </div>
            </a>
        </div>

        <!--Modal Iniciar Sessão-->


        <div id="modalIniciar">
            <div id="modal-content1">
                <p class="close">&times;</p>
                <img src="assets/images/logoCronos.png" alt="logo Cronos">
                <h2>INICIAR SESSÃO</h2>
                <form action="../elojob-backend/service/AuthService.php" method="post">
                    <input type="hidden" name="type" value="login">

                    <label for="email">Username</label>
                    <input type="text" id="email" name="email" required>

                    <label for="login-password">Senha</label>
                    <input type="password" id="login-password" name="password" required>
                     <!-- Exibição da mensagem de erro-->
                    <p id="erroLogin" style="color: red;"></p>

                    <div class="align-btn">
                        <button type="submit">INICIAR SESSÃO</button>
                    </div>
                </form>
                <p class="register-text">Ainda não tem uma conta? <a href="#">Cadastre-se</a></p>
                <p class="register-text" id="esqueceu-senha"><a href="#">Esqueceu a senha?</a></p>
            </div>
        </div>

        <!--Modal Cadastre-se-->


        <div id="modalRegistrar">
            <div id="modal-content2">
                <p class="close">&times;</p>
                <img src="assets/images/logoCronos.png" alt="logo Cronos">
                <h2>CADASTRE-SE</h2>
                <!-- Exibição da mensagem de erro-->
                <p id="erroCadastrar" style="color: red;"></p>
                <form action="../elojob-backend/service/AuthService.php" method="post">
                    <input type="hidden" name="type" value="register">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>

                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>

                    <label for="register-password">Senha</label>
                    <input type="password" id="register-password" name="register-password" required>

                    <label for="confirm-password">Confirmar Senha</label>
                    <input type="password" id="confirm-password" name="confirm-password" required>

                    <div class="align-btn">
                        <button type="submit">CADASTRAR</button>
                    </div>
                </form>
                <p class="register-text">Cadastrar significa que você concorda com os <a href="pages/termos-de-uso.html"
                        target="_blank">Termos de Uso</a> e <a href="pages/politica-privacidade.html"
                        target="_blank">Politíca de Privacidade</a></p>
            </div>
        </div>

        <!--Modal Recuperar Senha-->

        <div id="modalRecuperarSenha">
            <div id="modal-content3">
                <p class="close">&times;</p>
                <img src="assets/images/logoCronos.png" alt="logo Cronos">
                <h2>RECUPERAR SENHA</h2>
                 <!-- Exibição da mensagem de erro-->
                 <p id="erroEmail" style="color: red;"></p>
                <input type="hidden" name="type" value="recover">
                <form action="../elojob-backend/service/AuthService.php" method="post">

                    <label for="RecuperarEmail">Email</label>
                    <input type="email" id="RecuperarEmail" name="email" required>


                    <div class="align-btn">
                        <button type="submit" id="enviarCodigo" name="action" value="recover_password">ENVIAR
                            CÓDIGO</button>
                    </div>
                </form>

            </div>
        </div>

        <!--Modal Digite o Código-->
        <div id="modalDigiteCodigo">
            <div id="modal-content4">
                <p class="close">&times;</p>
                <img src="assets/images/logoCronos.png" alt="logo Cronos">
                <h2>RECUPERAR SENHA</h2>
                <p>Digite o código de verificação:</p>
                <form action="../elojob-backend/service/AuthService.php" method="post">
                    <input type="hidden" name="type" value="codigo">
                    <div id="container-codigo">
                        <div id="align-codigo1">
                            <input type="number" class="codigo-verificacao" name="codigo1"
                                oninput="moveFocus(this, 'codigo2')" maxlength="1" required>
                            <input type="number" class="codigo-verificacao" name="codigo2"
                                oninput="moveFocus(this, 'codigo3')" maxlength="1" required>
                            <input type="number" class="codigo-verificacao" name="codigo3"
                                oninput="moveFocus(this, 'codigo4')" maxlength="1" required>
                        </div>

                        <div id="align-codigo2">
                            <input type="number" class="codigo-verificacao" name="codigo4"
                                oninput="moveFocus(this, 'codigo5')" maxlength="1" required>
                            <input type="number" class="codigo-verificacao" name="codigo5"
                                oninput="moveFocus(this, 'codigo6')" maxlength="1" required>
                            <input type="number" class="codigo-verificacao" name="codigo6" oninput="moveFocus(this)"
                                maxlength="1" required>
                        </div>
                    </div>
                    <p>Seu código de verificação foi enviado para seu email, digite o código.</p>
                    <p id="codigoMensagem"
                        style="color: red; justify-content: center; display: <?php echo (isset($_GET['codigo_enviado']) && isset($_GET['erro']) && $_GET['erro'] == 'codigo_invalido') ? 'flex' : 'none'; ?>;">
                        Código de verificação inválido!
                    </p>
                    <div class="align-btn">
                        <button type="submit">CONFIRMAR CÓDIGO</button>
                    </div>
                </form>
            </div>
        </div>

        <!--Modal Renovar a Senha-->
        <div id="modalRenovaSenha">
            <div id="modal-content5">
                <p class="close">&times;</p>
                <img src="assets/images/logoCronos.png" alt="logo Cronos">
                <h2>REDEFINIR SENHA</h2>
                <!-- Mensagem de erro aqui -->
                <p id="erroMensagem" style="color: red;"></p>
                <form action="../elojob-backend/service/AuthService.php" method="post">
                <input type="hidden" name="type" value="redefinir">
                <input type="hidden" id="codigo_verificacao" name="codigo_verificacao" value="">
                    <label for="senha_nova">Nova Senha:</label>
                    <input type="password" id="senha_nova" name="senha_nova" required>

                    <label for="senha_confirmacao">Confirme a Nova Senha:</label>
                    <input type="password" id="senha_confirmacao" name="senha_confirmacao" required>

                    <div class="align-btn">
                        <button type="submit">REDEFINIR SENHA</button>
                    </div>
                </form>     
        </div>
        </div>

        <!--Modal Mensagem-->
        <div id="modalMensagemSenha">
            <div id="mensagem-senha">
                <img src="assets/images/logoCronos.png" alt="logo Cronos">
                <h2>Senha Redefinida com Sucesso!</h2>
                <div class="align-btn">
                        <button class="close" id="fecharMensagem">FECHAR</button>
                    </div>
            </div>
        </div>

        <!--Modal Mensagem Conta Excluida-->
        <div id="modalMensagemExcluido">
            <div id="mensagem-excluido">
                <img src="assets/images/logoCronos.png" alt="logo Cronos">
                <h2>Conta Excluida com sucesso!</h2>
                <div class="align-btn">
                        <button class="close" id="exitMensagem" onclick="closeModals()">FECHAR</button>
                    </div>
            </div>
        </div>


    </main>
    <footer>
        <div class="container-footer">
            <div id="content-footer1">
                <img src="assets/images/logoCronos.png" alt="logo XCrONOS" id="logo-footer">
                <div>
                    <p>Elojob XCrONOS: Sua segurança e satisfação são nossas prioridades. Com uma equipe de
                        especialistas e processos rigorosos, garantimos serviços rápidos, discretos e eficientes para
                        você alcançar o topo com total confiança.</p>
                    <div id="align-icons">
                        <a href="https://wa.me/5511991983299?text=Olá%20preciso%20de%20ajuda%20vim%20pela%20ElojobXCronos."
                            target="_blank">
                            <img src="assets/images/Whatsapp-icon.png" class="whatsapp-icon" alt="icone Whatsapp">
                        </a>
                        <img src="assets/images/instagram-icon.png" class="instagram-icon" alt="icone Instagram">
                    </div>
                </div>
            </div>
            <ul>
                <li><a href="index.html">INICIO</a></li>
                <li id="servicos"><a href="#container-jogos">SERVIÇOS</a></li>
                <li><a href="https://wa.me/5511991983299?text=Olá%20preciso%20de%20ajuda%20vim%20pela%20ElojobXCronos."
                        target="_blank">CONTATO</a></li>
                <li><a href="pages/termos-de-uso.html">TERMOS DE USO</a></li>
                <li><a href="pages/politica-privacidade.html">POLITICAS DE PRIVACIDADES</a></li>
            </ul>
            <div id="formaspag">
                <p>FORMAS DE PAGAMENTO</p>
                <img src="assets/images/formas-pag.png" id="icone-forma" alt="icones de formas de pagamento">
                <a href="https://transparencyreport.google.com/safe-browsing/search?hl=pt_BR" target="_blank"><img
                        src="assets/images/site-seguro.png" alt="icone de site seguro"></a>
            </div>
        </div>
        <div>
            <p id="direitos">© 2024 Elojob XCrONOS. Todos os direitos reservados.</p>
            <div id="particles-js"></div>
        </div>
    </footer>

    <script src="assets/js/global.js"></script>
    <script src="assets/js/particles.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script>
        // Função para adicionar a classe #itens.active na responsive.css para cobrir os itens quando logado 
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('itens').classList.toggle('active', <? php echo isset($_SESSION['token']) ? 'true' : 'false'; ?>);});
    </script>


</body>

</html>