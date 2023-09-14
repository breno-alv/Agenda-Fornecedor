<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once("templates/header.php");
include_once("templates/footer.php");
include_once("config/classes.php");
include_once("templates/footer.php");

$C_agenda = new C_agenda();
$agenda = $C_agenda->listar();
// $agenda = $C_agenda->editar();

############################################################################
##### ADICIONAR NOVO FORNECEDOR ####################

if (isset($_POST['Novo'])) {

    // var_dump($_POST);
    $nome = $_POST['nome'];
    $tipo_servico = $_POST['tipo_servico'];
    $natureza = $_POST['natureza'];
    $vencimento = $_POST['vencimento'];
    $valor = $_POST['valor'];
    $forma_pgt = $_POST['forma_pgt'];
    $periodicidade = $_POST['periodicidade'];
    $contato = $_POST['contato'];
    $informacao = $_POST['informacao'];

    if ($C_agenda->inserir($nome, $tipo_servico, $natureza, $vencimento, $valor, $forma_pgt, $periodicidade, $contato, $informacao)) {
        header('Location: index.php?ins=1');
        // var_dump($_POST['Novo']);
        // echo "Adicionado com sucesso";
    } else {
        header('Location: index.php?ins=0');
        echo "Não foi adicionado";
    }
}

##### EDITAR UM FORNECEDOR ###########################

if (isset($_POST['Editar'])) {

    
    $nome = $_POST['nome'];
    $tipo_servico = $_POST['tipo_servico'];
    $natureza = $_POST['natureza'];
    $vencimento = $_POST['vencimento'];
    $valor = $_POST['valor'];
    $forma_pgt = $_POST['forma_pgt'];
    $periodicidade = $_POST['periodicidade'];
    $contato = $_POST['contato'];
    $informacao = $_POST['informacao'];
    $id = $_POST['id'];

    var_dump($_POST);

    if ($C_agenda->editar($nome, $tipo_servico, $natureza, $vencimento, $valor, $forma_pgt, $periodicidade, $contato, $informacao, $id)) {

        // header('Location: index.php?msg=1');
        // var_dump($_POST);
    } else {
        echo "Erro ao editar o Fornecedor";
    }
}

###### EXCLUIR FORNECEDOR ##############################

if (isset($_POST['Excluir'])) {
    var_dump($_POST);
    $id = $_POST['id'];

    if ($C_agenda->deletar($id)) {
        header('Location: index.php?del=1');
        // echo 'Excluido com sucesso';
    } else {
        echo 'Erro ao excluido';
    }
}


?>

<div class="container">
    <!-- <?php if (isset($printMsg) && $printMsg != '') : ?>
        <p id="msg"><?= $printMsg ?></p>
    <?php endif; ?> -->
    <?php if (isset($_GET['msg']) and $_GET['msg'] == 1) { ?>
        <div class="alert alert-success alert-dismissible fade show mx-auto w-50 p-3 text-center mt-3" id="alerta" role="alert">
            ATIVIDADE REALIZADA COM SUCESSO!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

    <?php if (isset($_GET['del']) and $_GET['del'] == 1) { ?>
        <div class="alert alert-success alert-dismissible fade show mx-auto w-50 p-3 text-center mt-3" id="alerta" role="alert">
            FORNECEDOR DELETADO COM SUCESSO!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php } ?>

</div>


<h1 id="main-title" class="text-center m-3">Fornecedores</h1>
<?php if (count($agenda) > 0) : ?>
    <!-- <p>Tem Contatos</p> -->
    <div class="card card-solid m-5 ">
        <div class="card-body bg-light ">
            <table class="table table-hover table-light" id="tabela-agenda">
                <thead>
                    <tr>
                        <th>
                            <center>#<center>
                        </th>
                        <th>
                            <center>Nome<center>
                        </th>
                        <th>
                            <center>Serviço<center>
                        </th>
                        <th>
                            <center>Natureza<center>
                        </th>
                        <th>
                            <center>Vencimento</center>
                        </th>
                        <th>
                            <center>Valor</center>
                        </th>
                        <th>
                            <center>Forma Pagamento</center>
                        </th>
                        <th>
                            <center>Periodicidade</center>
                        </th>
                        <th>
                            <center>Contato</center>
                        </th>
                        <th>
                            <center>Informações</center>
                        </th>
                        <th>
                            <center>Açoes</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($agenda as $a) { ?>
                        <tr>
                            <!-- <th scope="row">1</th> -->
                            <td>
                                <center><?= $a['id']; ?></center>
                            </td>
                            <td>
                                <center><?= $a['nome']; ?></center>
                            </td>
                            <td>
                                <center><?= $a['tipo_servico']; ?></center>
                            </td>
                            <td>
                                <center><?= $a['natureza']; ?></center>
                            </td>
                            <td>
                                <center><?= $a['vencimento']; ?></center>
                            </td>
                            <!-- <td>
                                    <center><?= $a['tipo_servico']; ?></center>
                                </td> -->
                            <td>
                                <center><?= $a['valor']; ?></center>
                            </td>
                            <td>
                                <center><?= $a['forma_pgt']; ?></center>
                            </td>
                            <!-- <td>
                                    <center><?= $a['tipo_servico']; ?></center>
                                </td> -->
                            <td>
                                <center><?= $a['periodicidade']; ?></center>
                            </td>
                            <td>
                                <center><?= $a['contato']; ?></center>
                            </td>
                            <td>
                                <center><?= $a['informacao']; ?></center>
                            </td>
                            <td class="actions d-flex justify-content-around">
                                <div>
                                    <center><button title="Editar" type="button" class="btn btn-warning" data-toggle="modal" data-target="#Editar<?= $a['id']; ?>"><i class="fa fa-edit"></i></button></center>
                                </div>
                                <div>
                                    <center><button title="Deletar" type="button" class="btn btn-danger" data-toggle="modal" data-target="#Excluir<?= $a['id']; ?>"><i class="fas fa-trash"></i></button></center>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
<?php else : ?>
    <p id="empty-list-text">Ainda Não há Contatos na sua agenda, <a href="<?= $BASE_URL ?>create.php">Clique aqui para Adicionar</a>.</p>
<?php endif; ?>
</div>

<!--MODAL NOVO-->
<div class="modal fade bd-example-modal-lg" id="Novo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="index.php" method="POST">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">
                        <center>Cadastro de Fornecedor</center>
                    </h2>
                </div>
                <div class="modal-body">
                    <div class="form-group " >
                        <label for="nome" >Nome:</label>
                        <input type="text" class="form-control" name="nome" id="nome" required="">
                    </div>

                    <div class="form-group">
                        <label for="servico" >Serviço:</label>
                        <input type="text" class="form-control" name="tipo_servico" id="tipo_servico" required="">
                    </div>

                    <div class= "form-group" >
                        <label for="natureza" >Natureza:</label>
                        <input type="text" class="form-control" name="natureza" id="natureza" required="">
                        
                    </div>

                    <div class="form-group">
                        <label for="vencimento" >Vencimento:</label>
                        <input type="text" class="form-control" name="vencimento" id="vencimento" required="">
                        
                    </div>

                    <div class="form-group">
                        <label for="valor" >Valor:</label>
                        <input type="text" class="form-control" name="valor" id="valor" required="">
                        
                    </div>

                    <div class="form-group">
                        <label for="forma_pgt" >Forma Pagamento:</label>
                        <input type="text" class="form-control" name="forma_pgt" id="forma_pgt" required="">
                        
                    </div>

                    <div class="form-group">
                        <label for="periodicidade" >Periodicidade:</label>
                        <input type="text" class="form-control" name="periodicidade" id="preiodicidade" required="">
                        
                    </div>

                    <div class="form-group">
                        <label for="contato" >Contato:</label>
                        <input type="text" class="form-control" name="contato" id="contato" required="">
                        
                    </div>
                    <div class="form-group">
                        <label for="informacao" >Informações:</label>
                        <textarea type="text" class="form-control" name="informacao" rows="3" placeholder="Digite alguma informação do fornecedor..."></textarea>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Fechar</button>
                    <button type="submit" name="Novo" class="btn btn-lg btn-success" value="Enviar">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php foreach ($agenda as $a) { ?>
    <!--MODAL EDITAR-->
    <div class="modal fade bd-example-modal-lg" id="Editar<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="index.php" method="POST">
                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                    <div class="modal-header">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h2 class="modal-title" id="myModelLabel">
                            <center>EDITAR FORNECEDOR</center>
                        </h2>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Nome:</label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?= $a['nome']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="tipo_servico">Serviço:</label>
                            <input type="text" class="form-control" name="tipo_servico" id="tipo_servico" value="<?= $a['tipo_servico']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="natureza">Natureza:</label>
                            <input type="text" class="form-control" name="natureza" id="natureza" value="<?= $a['natureza']; ?>" required="">                           
                        </div>
                        <div class="form-group">
                            <label for="vencimento">Vencimento:</label>
                            <input type="text" class="form-control" name="vencimento" id="vencimento" value="<?= $a['vencimento']; ?>" required="">                            
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor:</label>
                            <input type="text" class="form-control" name="valor" id="valor" value="<?= $a['valor']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="forma_pgt">Forma Pagamento:</label>
                            <input type="text" class="form-control" name="forma_pgt" id="forma_pgt" value="<?= $a['forma_pgt']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="periodicidade">periodicidade:</label>
                            <input type="text" class="form-control" name="periodicidade" id="periodicidade" value="<?= $a['periodicidade']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="contato">Contato:</label>
                            <input type="text" class="form-control" name="contato" id="contato" value="<?= $a['contato']; ?>" required="">
                        </div>
                        <div class="form-group">
                            <label for="informacao">Informações:</label>
                            <textarea type="text" class="form-control" name="informacao" id="informacao" rows="3" value="<?= $a['informacao']; ?>"></textarea> 
                        </div>
                        <!-- <input type="hidden" name="editar" value="<?= $_POST ?>"> -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-hidden="true">Fechar</button>
                            <div style="float:right; margin-left: 10px;">
                                <input type="submit" class="btn btn-lg btn-success" name="Editar" value="Salvar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL EXCLUIR-->
    <div class="modal fade" id="Excluir<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Excluir</h3>
                </div>
                <div class="modal-body">
                    <p>Deseja realmente excluir o fornecedor <?= $a['nome']; ?>?</p>
                </div>
                <div class="modal-footer">
                    <form action="index.php" method="POST">
                        <input type="hidden" name="id" value="<?= $a['id']; ?>">
                        <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Não</button>
                        <input type="submit" class="btn btn-lg btn-success" name="Excluir" value="Sim">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php

?>