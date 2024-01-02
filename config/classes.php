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

    public function pesquisar(){ 
        
        $sql = "SELECT * FROM cad_fornecedor WHERE nome LIKE :nome OR tipo_servico LIKE :tipo_servico";

        $conn = $this->Connect();
        $stmt = $conn->prepare($sql);
        // $stmt->bindValue(":nome", $nome, PDO::PARAM_STR);
        // $stmt->bindValue(":tipo_servico", $tipo_servico, PDO::PARAM_STR);
        
        var_dump(pesquisar);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            // Trate a exceção se necessário, por exemplo, log ou imprimir mensagem
            return false;
        }
    }


    public function inserir($nome, $tipo_servico, $natureza, $vencimento, $valor, $forma_pgt, $periodicidade, $contato, $informacao) {

        $sql = "INSERT INTO cad_fornecedor (nome, tipo_servico, natureza, vencimento, valor, forma_pgt, periodicidade, contato, informacao) 
        VALUES (:nome, :tipo_servico, :natureza, :vencimento, :valor, :forma_pgt, :periodicidade, :contato, :informacao)" ;

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
        $stmt->bindParam(":informacao", $informacao, PDO::PARAM_STR);
        
        try {
            return $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }
    }   

   

    public function editar($nome, $tipo_servico, $natureza, $vencimento, $valor, $forma_pgt, $periodicidade, $contato, $informacao, $id) {
        $sql = "UPDATE cad_fornecedor SET nome = :nome, tipo_servico = :tipo_servico, natureza = :natureza, vencimento = :vencimento, valor = :valor, forma_pgt = :forma_pgt, periodicidade = :periodicidade, contato = :contato, informacao = :informacao WHERE id = :id";

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
        $stmt->bindParam(":informacao", $informacao, PDO::PARAM_STR);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }

    }

    public function deletar($id){
        $sql = "DELETE FROM cad_fornecedor WHERE id = :id";
        
        $conn = $this->Connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        
        try {
            return $stmt->execute();
        } catch (Exception $ex) {
            return false;
        }
    }

    public function gerarrelatoriofornecedor(){
        $sql = "SELECT * FROM cad_fornecedor";
        
        $conn = $this->Connect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // var_dump($result);
        return $result;
        
    }
}

?>