<?php 

    session_start();

    include_once("conexao.php");
    include_once("url.php");

    $agenda = [];

    $query = "SELECT * FROM cad_fornecedor";

    $stmt = $conn->prepare($query);
    
    $stmt->execute();

    $agenda = $stmt->fetchAll();

?>