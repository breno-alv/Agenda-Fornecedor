<?php

include_once("templates/header.php");


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
                            <th><center>#<center></th>
                            <th><center>Nome<center></th>
                            <th><center>Serviço<center></th>
                            <th><center>Natureza<center></th>
                            <th><center>Vencimento</center></th>
                            <th><center>Valor</center></th>
                            <th><center>Forma Pagamento</center></th>
                            <th><center>Periodicidade</center></th>
                            <th><center>Contato</center></th>
                            <th><center>Acoes</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($agenda as $a) { ?>
                            <tr>
                                <!-- <th scope="row">1</th> -->
                                <td>
                                    <center><?= $a['id'];?></center>
                                </td>
                                <td>
                                <center><?= $a['nome'];?></center>
                                </td>
                                <td>
                                    <center><?= $a['tipo_servico'];?></center>
                                </td>
                                <td>
                                    <center><?= $a['natureza'];?></center>
                                </td>
                                <td>
                                    <center><?= $a['vencimento'];?></center>
                                </td>
                                <!-- <td>
                                    <center><?= $a['tipo_servico'];?></center>
                                </td> -->
                                <td>
                                    <center><?= $a['valor'];?></center>
                                </td>
                                <td>
                                    <center><?= $a['forma_pgt'];?></center>
                                </td>
                                <!-- <td>
                                    <center><?= $a['tipo_servico'];?></center>
                                </td> -->
                                <td>
                                    <center><?= $a['periodicidade'];?></center>
                                </td>
                                <td>
                                    <center><?= $a['contato'];?></center>
                                </td>
                                <td class="actions d-flex justify-content-around">
                                    <center><a href="#"><i class="fas fa-pencil-alt text-primary"></i></a></center>
                                    <center><a href="#"><i class="fas fa-trash-alt text-danger"></i></a></center>
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

<?php
include_once("templates/footer.php");
?>