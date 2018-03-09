<?php
/**
 * Description of UsuarioDAO
 *
 * @author Joanes
 */
class UsuarioDAO 
{
    
    function login(Usuario $usuario)
    {
        try
        {
            $db = Conexao::conecta();
            $sql = "SELECT nome,senha FROM login WHERE nome = ?  AND senha = ?";
            $rs = $db->prepare($sql);
            
            $nome = $usuario->getNome();
            $rs->bindParam(1, $nome);
            
            $senha = $usuario->getSenha();
            $rs->bindParam(2, $senha);
            
            if($rs->execute())
            {
                if($registro = $rs->fetch(PDO::FETCH_OBJ))
                {
                    session_start();
                    $_SESSION["usuario"] = $registro->nome; 
                    echo "<script> document.location = 'compraPagSeguro.php' </script>";
                }
                else
                {
                    echo "<script> alert('Usuario ou senha incorreta') </script>";
                }
            }
            else
            {
                "<script> alert('erro ao validar dados') </script>";
            }
        } 
        catch (PDOException $ex) 
        {
            echo "Error ".$ex;
        }
    }
}
