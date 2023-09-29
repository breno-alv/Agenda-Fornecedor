<?php

include_once("config/url.php");
// include_once("config/processo.php");
include_once("./index.php");
include_once("config/conexao.php"); // teste de Conexão com o banco
include_once("config/classes.php");


// limpar mensagem essa condição limpa a mensagem da pagina ao carregar. 
// if(isset($_SESSION['msg'])){
//    $printMsg = $_SESSION['msg'];
//    $_SESSION['msg'] = ''; 
// }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Font Awesome Fontes, icones Editar, Visualizar e Deletar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.0/css/all.min.css" integrity="sha512-UJqci0ZyYcQ0AOJkcIkUCxLS2L6eNcOr7ZiypuInvEhO9uqIDi349MEFrqBzoy1QlfcjfURHl+WTMjEdWcv67A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Css -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $BASE_URL ?>css/style.css">
    <title>Lista de Fornecedores@</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php">
                <img src="<?= $BASE_URL ?>img/agenda.PNG" alt="Agenda">
            </a>
            <div>
                <div class="navbar-nav">
                    <a class="nav-link active" id="home-link" href="index.php">Agenda</a>
                    <a title="Adicionar" class="nav-link active" data-toggle="modal" data-toggle="modal" data-target="#Novo"><i class="fas fa-user-plus"></i></a>
                </div>
            </div>
        </nav>
    </header>