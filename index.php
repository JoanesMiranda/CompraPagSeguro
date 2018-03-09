<!DOCTYPE html>
<?php
include_once './classes/DAO/Conexao.php';
include_once './classes/modelo/Usuario.php';
include_once './classes/DAO/UsuarioDAO.php';
?>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/img/favicon.png"/>
        <title>Login</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <script src="assets/js/index.js" type="text/javascript"></script>
    </head>

    <body id="bodyLogin">
        <?php
        if (isset($_REQUEST["logout"]) && $_REQUEST["logout"] == true) {
            session_start();
            unset($_SESSION["usuario"]);
        }
        ?>

        <div id="colunaForm">
            <form method="POST" name="formLogin" action="index.php?login=true"  
                  id="backgroudform" onsubmit="return validaLogin();" style="border-radius: 10px;">
                <div class="form-group">
                    <h1 class="text-center">Login </h1></div>
                <div class="form-group">
                    <input class="form-control" type="text" name="nome" placeholder="Digite seu nome">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Senha" name="senha" class="form-control" />
                </div>
                <div class="form-group">
                    <button class="btn btn-default" type="submit" style="color:#FFFFFF;">Entrar </button>
                </div>
            </form>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    </body>

</html>
<?php
if (isset($_REQUEST["login"]) && $_REQUEST["login"] == true) {
    $usuario = new Usuario();
    $usuarioDAO = new UsuarioDAO();

    $usuario->setNome($_POST["nome"]);
    $usuario->setSenha($_POST["senha"]);
    $usuarioDAO->login($usuario);
}
?>