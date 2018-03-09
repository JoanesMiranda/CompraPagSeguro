<!DOCTYPE html>
<?php
include_once './classes/DAO/Conexao.php';
include_once './classes/modelo/Compra.php';
include_once './classes/DAO/CompraDAO.php';
?>
<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="assets/img/favicon.png"/>
        <title>Compra PagSeguro</title>
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/styles.css">
        <script src="assets/js/compra.js" type="text/javascript"></script>
        <script src="assets/js/main.js" type="text/javascript"></script>
    </head>

    <body id="backgroud">
        <?php
        session_start();
        if (!isset($_SESSION["usuario"])) {
            echo "Usuario não logado";
            exit();
        } else {
            $compras = new Compra();
            $comprasDAO = new CompraDAO();
            $dados = new ArrayIterator($comprasDAO->listaCompras());
        }
        ?>

        <div class="row" id="linha">
            <nav class="navbar navbar-default">
                <div class="container-fluid" id="navcol-1" style="background: #00aacc;">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#elemento">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="elemento">
                        <ul class="nav navbar-nav navbar-right">
                            <li role="presentation"><a href="#" style="color: white;"><strong>Bem Vindo, <?php echo strtoupper($_SESSION["usuario"]); ?></strong></a></li>
                            <li role="presentation"><a href="#" style="color: white;"><strong>Contato</strong></a></li>
                            <li role="presentation"><a href="#" style="color: white;"><img src = "assets/img/compras.png" width="18px"/></a></li>
                            <li role="presentation"><a href="index.php?logout=true" style="color: white;"><strong>Sair</strong></a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="colunaForm">
                <form method="post" name="formCompra" action="compraPagSeguro.php?salvar=true" 
                      id="backgroudform" onsubmit="return validaCompra();">
                    <div class="form-group"><img src="assets/img/pagseguro.gif" width="100%" class="img-responsive" /></div>
                    <div class="form-group"><span class="label label-default">Nome do Produto</span>
                        <select class="form-control" name="nomeProduto" id="nomeProduto">
                            <optgroup>
                                <option selected="true" disabled="true">Selecione...</option>
                                <option value="Formatação de Computador">Formatação de Computador</option>
                                <option value="Remoção de Virus">Remoção de Virus</option>
                                <option value="Limpeza de Hardware">Limpeza de Hardware</option>
                                <option value="Instalação e configuração de rede">Instalação e configuração de rede</option>
                                <option value="Instalação e Configuração de Perifericos">Instalação e Configuração de Perifericos</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="form-group"><span class="label label-default">Valor do Produto</span>
                        <input type="text" placeholder="R$" id="myInput" readonly="disabled" class="form-control" name="valorProduto" value =""/>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default" type="submit" style="color:#FFFFFF;">Enviar </button>
                    </div>
                </form>
                <div class="table-responsive" style="background: white;" >
                    <table class="table table-striped table-hover table-condensed" id="table">
                        <thead>
                            <tr>
                                <th class="info" colspan="5">Lista dos Pagamentos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Id</td>
                                <td>Descrição</td>
                                <td>Valor</td>
                                <td align="center">Pagar</td>
                                <td>Remover</td>
                            </tr>

                            <?php while ($dados->valid()) { ?>

                                <tr>
                                    <td><?php echo $dados->current()->id; ?></td>
                                    <td><?php echo $dados->current()->nome; ?></td>
                                    <td><?php echo $dados->current()->valor; ?></td>
                                    <td>
                                        <form method="post" target="pagseguro"  
                                              action="https://sandbox.pagseguro.uol.com.br/checkout/v2/cart.html?action=add">  

                                            <!-- Campos obrigatórios -->  
                                            <input name="receiverEmail" value="joanestecnico@gmail.com" type="hidden">  
                                            <input name="currency" value="BRL" type="hidden">  

                                            <!-- Itens do pagamento (ao menos um item é obrigatório) -->  
                                            <input name="itemId" value="<?php echo $dados->current()->id; ?>" type="hidden">  
                                            <input name="itemDescription" value="<?php echo $dados->current()->nome; ?>" type="hidden">  
                                            <input name="itemAmount" value="<?php echo $dados->current()->valor; ?>" type="hidden">  
                                            <input name="itemQuantity" value="1" type="hidden">  
                                            <input name="itemWeight" value="" type="hidden">  
                                            <input type="hidden" name="encoding" value="UTF-8"> 
                                            <!-- submit do form (obrigatório) -->  
                                            <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/94x52-pagar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" /> 

                                        </form> 
                                    </td>
                                    <td align="center"><a href="?remover=<?php echo $dados->current()->id; ?>"><img src="assets/img/remover.png" width="32" height="32" alt="remover"/> </a></td>
                                </tr>
                                <?php
                                $dados->next();
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript">
                          $(document).ready(function () {
                              $("#nomeProduto").change(function () {
                                  var precoServico;
                                  if (this.value === "Formatação de Computador") {
                                      precoServico = 100.01;
                                  } else if (this.value === "Remoção de Virus") {
                                      precoServico = 50.01;
                                  } else if (this.value === "Limpeza de Hardware") {
                                      precoServico = 50.01;
                                  } else if (this.value === "Instalação e configuração de rede") {
                                      precoServico = 200.01;
                                  } else if (this.value === "Instalação e Configuração de Perifericos") {
                                      precoServico = 50.01;
                                  }
                                  $("#myInput").val(precoServico);
                              });
                          });

        </script>
    </body>

</html>
<?php
if (isset($_REQUEST["salvar"]) && $_REQUEST["salvar"] == true) {
    if (isset($_POST["nomeProduto"]) && isset($_POST["valorProduto"])) {
        $compras->setNome($_POST["nomeProduto"]);
        $compras->setValor($_POST["valorProduto"]);
        $compras->setIdlogin(1);
        if ($comprasDAO->salvaCompra($compras)) {
            echo "<script> document.location = 'compraPagSeguro.php'; </script>";
        } else {
            echo "<script> alert('erro ao salvar'); </script>";
        }
    }
}

if (isset($_REQUEST["remover"])) {
    if ($comprasDAO->excluirCompra($_REQUEST["remover"])) {
        echo "<script> document.location = 'compraPagSeguro.php'; </script>";
    } else {
        echo "<script> alert('erro ao exluir compra');</script>";
    }
}
?>