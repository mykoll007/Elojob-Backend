<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EloJob XCrONOS | Alterar Dados</title>

    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/alterar-dados.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">

        <!--Icon baixada gratuitamente pela Flaticon-->
        <link rel="icon" href="../assets/images/gladiador.png">

        <meta name="description" content="Altere suas informações de conta na EloJob XCrONOS de forma segura e rápida.">
        <meta name="author" content="EloJob XCrONOS">
        <meta name="keywords" content="alterar dados, conta EloJob, atualização de informações, serviços de LOL">
        
        <meta property="og:locale" content="pt_BR">
        <meta property="og:title" content="Alterar Dados - EloJob XCrONOS">
        <meta property="og:site_name" content="EloJob XCrONOS">
        <meta property="og:description" content="Atualize suas informações de conta na EloJob XCrONOS.">
        <meta property="og:image" content="https://www.elojobxcronos.com/assets/images/logoCronos.png">
        <meta property="og:type" content="website">
        <meta property="og:url" content="http://elojobxcronos.com/alterar-dados">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

</head>


<body>
    <header>
        <div id="align-logoHambu">
            <a href="index.html"><img src="../assets/images/logoCronos.png" alt="Logo XCrONOS" class="logo"></a>
            <span id="IconMenu" class="material-symbols-outlined">
                menu
            </span>
        </div>
        <nav id="itens">
            <ul>
                <li><a href="../index.php">INÍCIO</a></li>
                <li><a href="pages/elojob.html">ELOJOB</a></li>
                <li><a href="pages/duoboost.html">DUOBOOST</a></li>
                <li><a href="pages/md5.html">MD5</a></li>
                <li><a href="pages/coach.html">COACH</a></li>
                <li><a href="pages/eventos.html">EVENTOS</a></li>

                <?php if(isset($_SESSION['token'])) : ?>
                <div class="itens-logado">
                    <li><a href="pages/eventos.html">Meus Pedidos</a></li>
                    <li><a href="pages/alterar-dados.php">Alterar dados</a></li>
                    <li>
                        <form action="../elojob-backend/service/AuthService.php" method="post">
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
            <div class="align-itensUsuario">
                <img src="../assets/images/carrinho.png" alt="icone carrinho de pedidos">
                <a href="#">
                    <p>Meus Pedidos</p>
                </a>
            </div>
            <div class="align-itensUsuario">
                <img src="../assets/images/Database.png" alt="icone carrinho de pedidos">
                <a href="#">
                    <p>Alterar dados</p>
                </a>
            </div>

            <form action="../elojob-backend/service/AuthService.php" method="post">
                <input type="hidden" name="type" value="logout">
                <button class="align-itensUsuario" id="logout" type="submit">
                    <img src="../assets/images/Logout.png" alt="ícone de logout">
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
        <section>
            <div id="container-editar">
                <div id="align-user">
                    <img src="../assets/images/UserEditar.png" alt="icone do usuario">
                    <div id="user">
                    <h2>Mykoll Daniel</h2>
                    <p>Forjado na arena desde <b>agosto de 2024</b></p>
                    </div>
                </div>
                <div id="align-btnEditar">
                <button id="btn-editar">EDITAR <img src="../assets/images/Edit.png" alt="icone do editar"></button>
                </div>

                <form action="" method="POST">
                    <label for="usuario">Usuário</label>
                    <input type="text" id="usuario" name="usuario" value="Mykoll Daniel" readonly required>
                
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="mykoll.daniel@gmail.com" readonly required>
                
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" readonly>
                
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" readonly required>

                    <div id="align-btnSalvar">
                    <button type="" id="btn-salvar">SALVAR ALTERAÇÕES <img src="../assets/images/Salvar.png" alt="icone do salvar"></button>
                    </div>

                    <div id="align-btnExcluir">
                    <button type="" id="btn-excluir" formaction="">EXCLUIR SUA CONTA <img src="../assets/images/Lixeira.png" alt="icone de excluir conta"></button>
                    </div>
                </form>    
            </div>
        </section>
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
                        <img src="../assets/images/instagram-icon.png" class="instagram-icon" alt="icone Instagram">
                    </div>
                </div>
            </div>
            <ul>
                <li><a href="../index.html">INICIO</a></li>
                <li id="servicos"><a href="../index.html#container-jogos">SERVIÇOS</a></li>
                <li><a href="https://wa.me/5511991983299?text=Olá%20preciso%20de%20ajuda%20vim%20pela%20ElojobXCronos."
                        target="_blank">CONTATO</a></li>
                <li><a href="termos-de-uso.html">TERMOS DE USO</a></li>
                <li><a href="politica-privacidade.html">POLITICAS DE PRIVACIDADES</a></li>
            </ul>
            <div id="formaspag">
                <p>FORMAS DE PAGAMENTO</p>
                <img src="../assets/images/formas-pag.png" id="icone-forma" alt="icones de formas de pagamento">
                <a href="https://transparencyreport.google.com/safe-browsing/search?hl=pt_BR" target="_blank"><img
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