<?php

    include_once("config/conexao.php");
    include_once("templates/footer.php");
    include_once("config/classes.php");
    // include("vendor/autoload.php");
    include_once("vendor/autoload.php");

    // include_once("templates/footer.php");

    $C_agenda = new C_agenda();

    $agenda = $C_agenda->listar();
    // $buscar = $C_agenda->pesquisar();

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
            // echo "Adicionado com sucesso";
            // var_dump($_POST);
        } else {
            header('Location: index.php?ins=0');
            // echo "Não foi adicionado";
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

        // var_dump($_POST);

        if ($C_agenda->editar($nome, $tipo_servico, $natureza, $vencimento, $valor, $forma_pgt, $periodicidade, $contato, $informacao, $id)) {

            header('Location: index.php?msg=1');
            // var_dump($_POST);
        } else {
            //     echo "Erro ao editar o Fornecedor";
        }
    }

    ###### EXCLUIR FORNECEDOR ##############################

    if (isset($_POST['Excluir'])) {
        // var_dump($_POST);
        $id = $_POST['id'];

        if ($C_agenda->deletar($id)) {
            header('Location: index.php?del=1');
            // echo 'Excluido com sucesso';
        } else {
            // echo 'Erro ao excluido';
        }
    }
    ###### Logica Pesquisa js ###########################

    if(!empty($_GET['search'])){
        $dados = $_GET['search'];

       
       
        // echo "Tem Registro.";
        $resultados = $C_agenda->pesquisar();
        var_dump($dados);
        
    }else{

        $C_agenda->listar();
        // echo "Não temos nada, trazer todos os registros";
        
    }

    ###### Relatorio Excel ##############################

    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if (isset($_POST['export_dados'])) {

        $exportFornecedor = $C_agenda->gerarrelatoriofornecedor();

        $spreadsheet = new Spreadsheet();
        // var_dump($_POST['export_dados']);

        //Cabeçalho Planilha
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue("A1", "id");
        $sheet->setCellValue("B1", "nome");
        $sheet->setCellValue("C1", "tipo_servico");
        $sheet->setCellValue("D1", "natureza");
        $sheet->setCellValue("E1", "vencimento");
        $sheet->setCellValue("F1", "valor");
        $sheet->setCellValue("G1", "forma_pgt");
        $sheet->setCellValue("H1", "periodicidade");
        $sheet->setCellValue("I1", "contato");
        $sheet->setCellValue("J1", "informacao");

        // Estilize o cabeçalho, se desejar

        $headerStyle = $sheet->getStyle('A1:J1');
        $headerStyle->getFont()->setBold(true);


        //LOOP PARA COLOCAR OS DADOS NA PLANILHA
        $s = 1;
        foreach ($exportFornecedor as $i) {
            $sheet->setCellValue("A" . ($s + 1), $i["id"]);
            $sheet->setCellValue("B" . ($s + 1), $i["nome"]);
            $sheet->setCellValue("C" . ($s + 1), $i["tipo_servico"]);
            $sheet->setCellValue("D" . ($s + 1), $i["natureza"]);
            $sheet->setCellValue("E" . ($s + 1), $i["vencimento"]);
            $sheet->setCellValue("F" . ($s + 1), $i["valor"]);
            $sheet->setCellValue("G" . ($s + 1), $i["forma_pgt"]);
            $sheet->setCellValue("H" . ($s + 1), $i["periodicidade"]);
            $sheet->setCellValue("I" . ($s + 1), $i["contato"]);
            $sheet->setCellValue("J" . ($s + 1), $i["informacao"]);

            $s++;
        }


        // Salvar a planilha no formato XLSX

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);

        $writer = new Xlsx($spreadsheet);

        // Definir um nome de arquivo
        $filename = 'ListadeFornecedores9.xlsx';

        // Salvar o arquivo no sistema de arquivos
        $writer->save('C:\Users\breno.penha\Downloads\\' . $filename);


        // Abordagem 1
        // Definir cabeçalhos para download
        
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment; filename="ListadeFornecedores3.xlsx"');
        // header('Cache-Control: max-age=0');


        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Type: application/octet-stream');
        // header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        // header('Content-Length: ' . filesize($filename));
        // header('Cache-Control: max-age=0');


        // header('Content-Disposition: attachment;filename="' . $filename . '"');
        // echo "teste";
        // header('Cache-Control: max-age=0');

        //Nova abordagem
        // Definir cabeçalhos para download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Content-Length: ' . filesize($filename));

        // Lê o arquivo e o envia para a saída (navegador)
        readfile($filename);
        // // Exclua o arquivo após o download (opcional)
        unlink($filename);
        // Salvar o arquivo no sistema de arquivos

        // $writer->save($filename);

        // Abordagem 1
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        // $writer->save('php://output');
        // Abordagem 2
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        // $filename = 'C:\Users\breno.penha\Downloads\ListadeFornecedores3.xlsx';
        // $writer->save($filename);
        // Redirecionar o usuário para o arquivo salvo
        // header('Location: ' . $filename);

        // $writer->save('php://output');
        // $writer->save($filename);
    }

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome Fontes, icones Editar, Visualizar e Deletar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.0/css/all.min.css" integrity="sha512-UJqci0ZyYcQ0AOJkcIkUCxLS2L6eNcOr7ZiypuInvEhO9uqIDi349MEFrqBzoy1QlfcjfURHl+WTMjEdWcv67A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Inclua o Bootstrap JS (junto com o Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Lista de Fornecedores</title>
</head>


<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">   
                <a class="navbar-brand mr-0"  href="index.php">
                    <img src="img/agenda.PNG" style="margin-left: 20px" alt="Agenda">
                </a>
                <div class="d-flex justify-content-center mx-auto" >
                 <h3 class="text-white" style="margin-right: 80px;">Fornecedores</h3>
                </div>   
        </nav>
    </header>

    
    <div class="container col-md-12">
            <!-- <?php if (isset($printMsg) && $printMsg != '') : ?>
            <p id="msg"><?= $printMsg ?></p>
            <?php endif; ?> -->

            <!-- Chamando os alert sweetalert2 -->
            <?php 
            if (isset($_GET['msg']) and $_GET['msg'] == 1){
                
                fornecedorEditado();     
            }
            
            ?>

            <?php 
            if (isset($_GET['ins']) and $_GET['ins'] == 1) {

                fornecedorCadastrado();
            }
            ?>

            <?php 
                if (isset($_GET['del']) and $_GET['del'] == 1) {

                    fornecedorDeletado();
            }
            ?>

        

        <!-- Tabela de dados dos fornecedores vindo do banco -->
        <?php if (count($agenda) > 0) : ?>
            <!-- <p>Tem Contatos</p> -->
            <div class="card card-solid m-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <a title="Cadastrar Novo Fornecedor" type="button" class="btn btn-success text-white  ml-0 btn-lg" data-toggle="modal" data-toggle="modal" data-target="#Novo"><i class="fas fa-user-plus"></i></a> 
                        <div class="box-search d-flex justify-content-end  mr-0">
                            <input type="search" class="form-control mr-1" placeholder="Pesquisar..." id="pesquisar">
                            <button onclick="searchData()" class="btn btn-success"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="tabela-agenda">
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
                                    <!-- <th>
                                    <center>Informações</center>
                                </th> -->
                                    <th>
                                        <center>Ações</center>
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
                                        <td>
                                            <center><?= $a['valor']; ?></center>
                                        </td>
                                        <td>
                                            <center><?= $a['forma_pgt']; ?></center>
                                        </td>
                                        <td>
                                            <center><?= $a['periodicidade']; ?></center>
                                        </td>
                                        <td>
                                            <center><?= $a['contato']; ?></center>
                                        </td>
                                        <!-- <td>
                                        <center><?= $a['informacao']; ?></center>
                                    </td> -->
                                        <td class=" d-flex justify-content-around px-0">
                                            <div>
                                                <center><button title="Editar" type="button" class="btn btn-info" data-toggle="modal" data-target="#Editar<?= $a['id']; ?>"><i class="fa fa-edit"></i></button></center>
                                            </div>
                                            <div>
                                                <center><button title="Deletar" type="button" class="btn btn-danger" data-toggle="modal" data-target="#Excluir<?= $a['id']; ?>"><i class="fa fa-trash"></i></button></center>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Botão de exportação de dados para planilha -->
                    <form class="text-center mt-3" action="index.php"  method="POST">
                            <input type="hidden" name="export_dados">
                            <button title="Exportar dados" type="submit" name="export_dados" class=" btn btn-secondary"><i class="fa fa-solid fa-file-excel"></i> Exportar dados</button>
                    </form>
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
                            <div class="form-group ">
                                <label for="nome">Nome:</label>
                                <input type="text" class="form-control" name="nome" id="nome" required="">
                            </div>

                            <div class="form-group">
                                <label for="servico">Serviço:</label>
                                <input type="text" class="form-control" name="tipo_servico" id="tipo_servico" required="">
                            </div>

                            <div class="form-group">
                                <label for="natureza">Natureza:</label>
                                <input type="text" class="form-control" name="natureza" id="natureza" required="">

                            </div>

                            <div class="form-group">
                                <label for="vencimento">Vencimento:</label>
                                <input type="text" class="form-control" name="vencimento" id="vencimento" required="">

                            </div>

                            <div class="form-group">
                                <label for="valor">Valor:</label>
                                <input type="text" class="form-control" name="valor" id="valor" required="">

                            </div>

                            <div class="form-group">
                                <label for="forma_pgt">Forma Pagamento:</label>
                                <input type="text" class="form-control" name="forma_pgt" id="forma_pgt" required="">

                            </div>

                            <div class="form-group">
                                <label for="periodicidade">Periodicidade:</label>
                                <input type="text" class="form-control" name="periodicidade" id="periodicidade" required="">

                            </div>

                            <div class="form-group">
                                <label for="contato">Contato:</label>
                                <input type="text" class="form-control" name="contato" id="contato" required="">

                            </div>
                            <div class="form-group">
                                <label for="informacao">Informações:</label>
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
                                    <textarea class="form-control" name="informacao" id="informacao" rows="3" maxlength="500"><?= $a['informacao']; ?></textarea>
                                </div>
                                <!-- <input type="hidden" name="editar" value="<?= $_POST ?>"> -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal" aria-hidden="true">Fechar</button>
                                    <div style="float:right; margin-left: 10px;">
                                        <input type="submit" id="btn-salvar" class="btn btn-lg btn-success" name="Editar" value="Salvar">
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

        <!-- Alertas sweetalert2 -->
        <?php
        function fornecedorEditado() {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    Swal.fire({';
            echo '        position: "center",';
            echo '        icon: "success",';
            echo '        title: "FORNECEDOR EDITADO!",';
            echo '        showConfirmButton: false,';
            echo '        timer: 2000';
            echo '    });';
            echo '});';
            echo '</script>';
        }
        
    
        function fornecedorCadastrado() {
            echo '<script>';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    Swal.fire({';
            echo '        position: "center",';
            echo '        icon: "success",';
            echo '        title: "FORNECEDOR CADASTRADO!",';
            echo '        showConfirmButton: false,';
            echo '        timer: 2000';
            echo '    });';
            echo '});';
            echo '</script>';
        }

        
        function fornecedorDeletado() {
            echo '<script>';
            echo '  document.addEventListener("DOMContentLoaded", function() {';
            echo '    Swal.fire({';
            echo '        title: "<p>Deseja remover esse Fornecedor?</p>",';
            echo '              icon: "warning",';
            echo '              showCancelButton: true,';
            echo '              confirmButtonColor: "#3085d6",';
            echo '              cancelButtonColor: "#d33",';
            echo '              confirmButtonText: "Sim, Deletar!"';
            echo '        }).then((result) => {';
            echo '            if (result.isConfirmed) { ';
            echo '            Swal.fire({ ';
            echo '            title: "Deleted!",';
            echo '            text: "Fornecedor Deletado.",';
            echo '            icon: "success"';
            echo '            });';
            echo '        };';
            echo '   });';
            echo '</script>';
        }
        ?>

        <!-- Script js Pesquisar -->
        <script>
            var search = document.getElementById('pesquisar');

            search.addEventListener("keydown", function(event) {
                if (event.key === "Enter"){
                    searchData();
                }
            });

            function searchData() {
            window.location = 'index.php?search='+search.value;
            }
        </script>
    </div>    
</body>