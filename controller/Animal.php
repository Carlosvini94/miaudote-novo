<?php
require_once "../enum/EnumAnimal.php";
header("Content-type: application/json");


class Animal {

    public function cadastrarAnimal($p_NomeAnimal, $p_DesObservacao, $p_IdadeAnimal, $p_PorteAnimal, $p_Sexo, $p_Instituicao, $p_Especie, $p_IndCastrado ) {
       require_once "Conexao.php";
       
       $Animal = new Animal();
       
       $erro = false;
       $mensagem = null;
       
       if(empty($p_NomeAnimal)) {
           $erro = true;
           $mensagem = ERRO_NOME_OBRIGATORIO;
       }
       elseif(empty($p_IdadeAnimal)) {
           $erro = true;
           $mensagem = ERRO_IDADE_OBRIGATORIO;
       }
       elseif(empty($p_PorteAnimal)) {
           $erro = true;
           $mensagem = ERRO_PORTE_OBRIGATORIO;
       }
       elseif(empty($p_Sexo)) {
           $erro = true;
           $mensagem = ERRO_SEXO_OBRIGATORIO;
       }
       elseif(empty($p_Instituicao)) {
           $erro = true;
           $mensagem = ERRO_INSTITUICAO_OBRIGATORIO;
       }
       elseif(empty($p_Especie)) {
           $erro = true;
           $mensagem = ERRO_ESPECIE_OBRIGATORIO;
       }
        elseif(empty($p_IndCastrado)) {
           $erro = true;
           $mensagem = ERRO_CASTRADO_OBRIGATORIO;
        }
       if($erro){
            return array("sucesso"=>false,
            "mensagem"=>$mensagem);
        }
        
        
        try {
            $stmt = $conn->prepare("INSERT INTO ANIMAL(NOM_ANIMAL, DES_OBSERVACAO, DES_IDADE, IND_PORTE_ANIMAL, 
            IND_SEXO_ANIMAL, INSTITUICAO_COD_INSTITUICAO, ESPECIE_COD_ESPECIE, DAT_CADASTRO, IND_CASTRADO) 
            VALUES (:nom_animal, :des_observacao, :des_idade, :ind_porte_animal, :ind_sexo_animal, :cod_instituicao, :cod_especie, now(), :ind_castrado)");
        
        
        $stmt->bindParam (':nom_animal', $p_NomeAnimal);
        $stmt->bindParam (':des_observacao', $p_DesObservacao);
        $stmt->bindParam (':des_idade', $p_IdadeAnimal);
        $stmt->bindParam (':ind_porte_animal', $p_PorteAnimal);
        $stmt->bindParam (':ind_sexo_animal', $p_Sexo);
        $stmt->bindParam (':cod_instituicao', $p_Instituicao);
        $stmt->bindParam (':cod_especie', $p_Especie);
        $stmt->bindParam ('ind_castrado', $p_IndCastrado);
        
        $stmt->execute();
        
            return array("mensagem" => SUCESSO_ANIMAL_CRIADO,
                        "sucesso" => true);
        
        } catch(PDOException $e){
                        return array("mensagem" => ERRO_ANIMAL_CRIADO."Erro:".$conn->error,
                          "sucesso" => false);
        }
       
       $conn = null;
    }
    
    public function excluirAnimal($id) {
        require_once "Conexao.php";
        
        $erro = false;
        $mensagem = null;
       
        try{
        $stmt = $conn->prepare("UPDATE ANIMAL
                SET IND_EXCLUIDO = 'T'
                WHERE COD_ANIMAL = :id");
        
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        
        
            return array("mensagem" => SUCESSO_ANIMAL_EXCLUIDO,
                        "sucesso" => true);
                        
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            
             return array("mensagem" => ERRO_ANIMAL_EXCLUIDO."Erro:".$conn->error,
                          "sucesso" => false);
        }
        
        $conn = null;
    }
    
    public function adotarAnimal($id) {
        require_once "Conexao.php";
        
        $erro = false;
        $mensagem = null;
        
        try{
        $stmt = $conn->prepare("
                UPDATE ANIMAL
                SET IND_ADOTADO = 'T',
                    DAT_ADOCAO = NOW()
                WHERE COD_ANIMAL = :id
        ");
        
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        
        
            return array("mensagem" => SUCESSO_ANIMAL_ADOTADO,
                        "sucesso" => true);
                        
        } catch (PDOException $e) {
            return array("mensagem" => ERRO_ANIMAL_ADOTADO."Erro:".$conn->error,
                        "sucesso" => false);
        }
        
        $conn=null;
    }
    
    public function editarAnimal($id, $p_NomeAnimal, $p_Observacao, $p_IdadeAnimal, $p_PorteAnimal, $p_Sexo, $p_Instituicao, $p_Especie, $p_IndCastrado) {
        require_once "Conexao.php";
        
        $erro = false;
       $mensagem = null;
       
       if(empty($p_NomeAnimal)) {
           $erro = true;
           $mensagem = ERRO_NOME_OBRIGATORIO;
       }
       elseif(empty($p_IdadeAnimal)) {
           $erro = true;
           $mensagem = ERRO_IDADE_OBRIGATORIO;
       }
       elseif(empty($p_PorteAnimal)) {
           $erro = true;
           $mensagem = ERRO_PORTE_OBRIGATORIO;
       }
       elseif(empty($p_Sexo)) {
           $erro = true;
           $mensagem = ERRO_SEXO_OBRIGATORIO;
       }
       elseif(empty($p_Instituicao)) {
           $erro = true;
           $mensagem = ERRO_INSTITUICAO_OBRIGATORIO;
       }
       elseif(empty($p_Especie)) {
           $erro = true;
           $mensagem = ERRO_ESPECIE_OBRIGATORIO;
       }
        elseif(empty($p_IndCastrado)) {
           $erro = true;
           $mensagem = ERRO_CASTRADO_OBRIGATORIO;
        }
       
       if($erro){
            return array("sucesso"=>false,
            "mensagem"=>$mensagem);
        }
        try {
        $stmt = $conn->prepare( "
                UPDATE `ANIMAL` SET `NOM_ANIMAL`=:nom_animal,`DES_OBSERVACAO`=:des_observacao,`DES_IDADE`=:des_idade,`IND_PORTE_ANIMAL`=:des_porte,
                `IND_SEXO_ANIMAL`=:des_sexo,
                `INSTITUICAO_COD_INSTITUICAO`=:cod_instituicao,
                `ESPECIE_COD_ESPECIE`=:cod_especie,
                `IND_CASTRADO`=:castrado
                WHERE COD_ANIMAL = :id");
        
        $stmt->bindParam(':nom_animal', $p_NomeAnimal);
        $stmt->bindParam(':des_observacao', $p_Observacao);
        $stmt->bindParam(':des_idade', $p_IdadeAnimal);
        $stmt->bindParam(':des_porte', $p_PorteAnimal);
        $stmt->bindParam(':des_sexo', $p_Sexo);
        $stmt->bindParam(':cod_instituicao', $p_Instituicao);
        $stmt->bindParam(':cod_especie', $p_Especie);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':castrado', $p_IndCastrado);
        
        $stmt-> execute();
        

            return array("mensagem" => SUCESSO_ANIMAL_ALTERADO,
                        "sucesso" => true);
                        
        } catch (PDOException $e) {
            return array("mensagem" => ERRO_ANIMAL_ALTERADO."Erro:".$conn->error,
                        "sucesso" => false);
        }
         
        $conn=null;
    }
    
    public function BuscarTodos() {
        
    }
    
    public function BuscarPorId($id) {
        
    }
    
    public function BuscarAdotados() {
        
    }
    
    
    
}

?>