<?php
/**
 * Description of CompraDAO
 *
 * @author Joanes
 */
class CompraDAO {
    
    function salvaCompra(Compra $compra)
    {
        try {
            $db = Conexao::conecta();
            $sql = "INSERT INTO compra(nome,valor,fk_login) VALUES (?,?,?)";
            $stmt = $db->prepare($sql);
            
            $nome = $compra->getNome();
            $stmt->bindParam(1,$nome);
            
            $valor = $compra->getValor();
            $stmt->bindParam(2,$valor);
            
            $idLogin = $compra->getIdlogin();
            $stmt->bindParam(3,$idLogin);
            
            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro ao salvar compra".$ex;
        }
    }
    public function listaCompras()
    {
        try {
            $db = Conexao::conecta();
            $sql = "SELECT * FROM compra";
            $rs = $db->prepare($sql); 
      
            if($rs->execute())
            {
                $dados = array();
                while($registros = $rs->fetch(PDO::FETCH_OBJ))
                {
                    $dados[] = $registros;
                }
                return $dados;
            }
        } catch (PDOException $ex) {
            echo "Erro ao listar compras".$ex;
        } 
    }
    function excluirCompra($id)
    {
        try {
            $db = Conexao::conecta();
            $sql = "DELETE FROM compra WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(1, $id);
            return $stmt->execute();
           
        } catch (PDOException $ex) {
            echo "Erro ao exlcuir".$ex;
        }
    }
    
}
