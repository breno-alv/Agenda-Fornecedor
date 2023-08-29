<?php

include_once("templates/header.php");
include_once("templates/footer.php");


?>

<div class="container">
    <?php if (isset($printMsg) && $printMsg != '') : ?>
        <p id="msg"><?= $printMsg ?></p>
    <?php endif; ?>

    <h1 id="main-title" class="text-center m-3">Fornecedores</h1>
    <?php if (count($agenda) > 0) : ?>
        <!-- <p>Tem Contatos</p> -->
        <div class="card card-solid">
            <div class="card-body">
                <table class="table table-hover" id="tabela-agenda">
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

<?php foreach ($agenda as $a) { ?>
    <!--MODAL EDITAR-->
    <div class="modal fade" id="Editar<?= $a['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="index.php" method="POST">
                    <input type="hidden" name="id" value="<?= $a['id']; ?>">
                    <div class="modal-header" style="text-align: center;">
                        <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                        <h2 class="modal-title" id="myModelLabel" >
                            <center>EDITAR FORNECEDOR</center>
                        </h2>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <label for="cargo">Nome:</label>
                            <input type="text" class="form-control" name="cargo" id="nome" value="<?= $a['nome']; ?>" required="">
                            <br>
                        </div>
                        <div class="row">
                            <label for="cargo">Serviço:</label>
                            <input type="text" class="form-control" name="cargo" id="tipo_servico" value="<?= $a['tipo_servico']; ?>" required="">
                            <br>
                        </div>
                        <div class="row">
                            <label for="cargo">Natureza:</label>
                            <input type="text" class="form-control" name="cargo" id="natureza" value="<?= $a['natureza']; ?>" required="">
                            <br>
                        </div>
                        <div class="row">
                            <label for="cargo">Vencimento:</label>
                            <input type="text" class="form-control" name="cargo" id="vencimento" value="<?= $a['vencimento']; ?>" required="">
                            <br>
                        </div>
                        <div class="row">
                            <label for="cargo">Valor:</label>
                            <input type="text" class="form-control" name="cargo" id="valor" value="<?= $a['valor']; ?>" required="">
                            <br>
                        </div>
                        <div class="row">
                            <label for="cargo">Forma Pagamento:</label>
                            <input type="text" class="form-control" name="cargo" id="forma_pgt" value="<?= $a['forma_pgt']; ?>" required="">
                            <br>
                        </div>
                        <div class="row">
                            <label for="cargo">periodicidade:</label>
                            <input type="text" class="form-control" name="cargo" id="preiodicidade" value="<?= $a['periodicidade']; ?>" required="">
                            <br>
                        </div>
                        <div class="row">
                            <label for="cargo">Contato:</label>
                            <input type="text" class="form-control" name="cargo" id="contato" value="<?= $a['contato']; ?>" required="">
                            <br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-hidden="true">Fechar</button>
                            <div style="float:right; margin-left: 10px;">
                                <input type="submit" class="btn btn-lg btn-success" name="cEditar" value="Salvar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>

<?php
include_once("templates/footer.php");
?>