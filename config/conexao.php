<?php 
 class Con{
    protected function Connect(){
    $host = "localhost";
    $dbname = "agenda";
    $user = "root";
    $senha = "";

        try {

            $conn = new PDO("mysql:host=$host; dbname=$dbname", $user, $senha);

            //Ativar o modo de errro, essa linha é para o mostra o erro na conexao com o banco
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return $conn; // Retorna a conexão PDO criada
            var_dump($conn);
        } catch (PDOException $e) { 
            //Erro na conexao
            $error = $e->getMessage();
            echo "Erro: $error";
            }
    }
}
?>