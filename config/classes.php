<?php 



class C_agenda extends Con{

    public function listar(){
        $sql = "SELECT * FROM cad_fornecedor";

        $conn = $this->Connect();
        $stmt = $conn->prepare($sql);
        // $stmt->bindParam(":ANO", $ano, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function inserir($nome, $tipo_servico, $natureza, $vencimento,$valor,$forma_pgt, $periodicidade, $contato) {

        $sql = "INSERT INTO cad_fornecedor (nome, tipo_servico, natureza, vencimento, valor, forma_pgt, periodicidade, contato) 
        VALUES (:nome, :tipo_servico, :natureza, :vencimento, :valor, :forma_pgt, :periodicidade, :contato)" ;

        $conn = $this->Connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_servico", $tipo_servico, PDO::PARAM_STR);
        $stmt->bindParam(":natureza", $natureza, PDO::PARAM_STR);
        $stmt->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
        $stmt->bindParam(":forma_pgt", $forma_pgt, PDO::PARAM_STR);
        $stmt->bindParam(":periodicidade", $periodicidade, PDO::PARAM_STR);
        $stmt->bindParam(":contato", $contato, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }
    }   

   

    public function editar($nome, $tipo_servico, $natureza, $vencimento, $valor, $forma_pgt, $periodicidade, $contato, $id) {
        $sql = "UPDATE cad_fornecedor SET nome = :nome, tipo_servico = :tipo_servico, natureza = :natureza, vencimento = :vencimento, valor = :valor, forma_pgt = :forma_pgt, periodicidade = :periodicidade, contato = :contato WHERE id = :id";

        $conn = $this->Connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":nome", $nome, PDO::PARAM_STR);
        $stmt->bindParam(":tipo_servico", $tipo_servico, PDO::PARAM_STR);
        $stmt->bindParam(":natureza", $natureza, PDO::PARAM_STR);
        $stmt->bindParam(":vencimento", $vencimento, PDO::PARAM_STR);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
        $stmt->bindParam(":forma_pgt", $forma_pgt, PDO::PARAM_STR);
        $stmt->bindParam(":periodicidade", $periodicidade, PDO::PARAM_STR);
        $stmt->bindParam(":contato", $contato, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }

    }
}

?>