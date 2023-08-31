<?php 

class C_agenda extends Con {
    public function inserir($nome, $tipo_servico, $natureza, $vencimento,$valor,$forma_pgt, $periodicidade, $contato ) {

        $sql = "INSERT INTO cad_fornecedor (nome, tipo_servico, natureza, vencimento, valor, forma_pgt, periodicidade, contato) 
        VALUES (:nome, :tipo_servico, :natureza, :vencimento, :valor, :forma_pgt, :periodicidade, :contato)" ;

        $conn = $this->Connect();
        $stmt = $conn->prepare($sql);
        $stmt->binParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->binParam(":tipo_servico", $tipo_servico, PDO::PARAM_STR);
        $stmt->binParam(":natureza", $natureza, PDO::PARAM_STR);
        $stmt->binParam(":vencimento", $vencimento, PDO::PARAM_STR);
        $stmt->binParam(":valor", $valor, PDO::PARAM_STR);
        $stmt->binParam(":forma_pgt", $forma_pgt, PDO::PARAM_STR);
        $stmt->binParam(":periodicidade", $periodicidade, PDO::PARAM_STR);
        $stmt->binParam(":contato", $contato, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }
    }   
}

?>