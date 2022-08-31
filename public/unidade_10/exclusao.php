<?php
    include_once("../../conexao/conexao.php");

    // Criar objeto de conexao
    if( isset($_POST["transportadoraID"]) ) {
        $tID = $_POST["transportadoraID"];
        
        $exclusao = "DELETE FROM transportadoras ";
        $exclusao .= "WHERE transportadoraID = {$tID}";
        $con_exclusao = mysqli_query($conecta,$exclusao);
        if($con_exclusao) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Transportadora excluida com sucesso.";
        } else {
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
        }
    }

    // converter retorno em json
    echo json_encode($retorno);

    // Fechar conexao
    mysqli_close($conecta);
?>