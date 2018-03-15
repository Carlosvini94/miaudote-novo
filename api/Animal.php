<?php
require_once "../controller/Animal.php";
header("Content-type: application/json");

$Animal = new Animal();

$acao = $_GET["acao"];
if($acao == "CadastrarAnimal") {
    $p_NomeAnimal = $_POST['nome'];
    $p_DesObservacao = $_POST['observacao'];
    $p_IdadeAnimal = $_POST['idade'];
    $p_PorteAnimal = $_POST['porte'];
    $p_Sexo = $_POST['sexo'];
    $p_Instituicao = $_POST['instituicao'];
    $p_Especie = $_POST['especie'];
    $p_IndCastrado = $_POST['castrado'];
    
    // $p_NomeAnimal = "Bruce";
    // $p_DesObservacao = "tranquilo e carinhoso";
    // $p_IdadeAnimal = "5";
    // $p_PorteAnimal = "2";
    // $p_Sexo = "M";
    // $p_Instituicao = '1';
    // $p_Especie = '1';
    // $p_IndCastrado = "T";
    
    echo json_encode($Animal->cadastrarAnimal($p_NomeAnimal, $p_DesObservacao, $p_IdadeAnimal, $p_PorteAnimal, $p_Sexo, $p_Instituicao, $p_Especie, $p_IndCastrado));
}

if($acao == "ExcluirAnimal") {
    $id = "2";
    
    echo json_encode($Animal->excluirAnimal($id));
}

if($acao == "AdotarAnimal") {
    $id = "1";
    
    echo json_encode($Animal->AdotarAnimal($id));
}

if($acao == "EditarAnimal") {
    $id = "1";
    $p_NomeAnimal="Thais";
    $p_Observacao="Nova observação";
    $p_IdadeAnimal = "9";
    $p_PorteAnimal = "2";
    $p_Sexo = "F";
    $p_Instituicao = "1";
    $p_Especie = "1";
    $p_IndCastrado = "F";
    
    echo json_encode($Animal->EditarAnimal($id, $p_NomeAnimal, $p_Observacao, $p_IdadeAnimal, $p_PorteAnimal, $p_Sexo, $p_Instituicao, $p_Especie, $p_IndCastrado));
}

if($acao == "BuscarTodos") {
    echo json_encode($Animal->BuscarTodos());
}

if($acao == "BuscarPorId") {
    $id = $_GET["id"];
 
    echo json_encode($Animal->BuscarPorId($id));
}

if($acao == "BuscarAdotados") {
    
    echo json_encode($Animal->BuscarAdotados());
}

?>