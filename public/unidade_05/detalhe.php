<?php require_once("../../conexao/conexao.php"); ?>
<?php 
    // testa se parâmetro é recebido
    if (isset($_GET["codigo"])){
        $produtoID = $_GET["codigo"];
    } else {
        header("location: listagem.php");
    }

    //consulta ao banco de dados
    $consulta = "SELECT * ";
    $consulta .= "FROM produtos ";
    $consulta .= "WHERE produtoID = {$produtoID}";
    $detalhe = mysqli_query($conecta, $consulta);
    if(!$detalhe) {
        die("Falha na consulta ao banco");   
    } else {
        $dados_detalhes = mysqli_fetch_assoc($detalhe);

        $produtoID = $dados_detalhes["produtoID"];
        $nomeproduto = $dados_detalhes["nomeproduto"];
        $descricao = $dados_detalhes["descricao"];
        $codigobarra = $dados_detalhes["codigobarra"];
        $tempoentrega = $dados_detalhes["tempoentrega"];
        $precounitario = $dados_detalhes["precounitario"];
        $precorevenda = $dados_detalhes["precorevenda"];
        $estoque = $dados_detalhes["estoque"];
        $imagemgrande = $dados_detalhes["imagemgrande"];
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Curso PHP Integração com MySQL</title>
        
        <!-- estilo -->
        <link href="_css/estilo.css" rel="stylesheet">
        <link href="_css/produto_detalhe.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../_incluir/topo.php"); ?>
        <?php include_once("../_incluir/funcoes.php"); ?> 
        
        <main>  
            <div id="detalhe_produto">
                <ul>
                    <li class="imagem">
                        <img src="<?php echo $imagemgrande?>">
                    </li>
                    <li><h2><?php echo $nomeproduto?></h2></li>
                    <li><?php echo $descricao?></li>
                    <li>Código de Barras: <?php echo $codigobarra?></li>
                    <li>Tempo de Entrega: <?php echo $tempoentrega?> dias</li>
                    <li>Preço Unitário: <?php echo real_format($precounitario)?></li>
                    <li>Preço Revenda: <?php echo real_format($precorevenda)?></li>
                    <li>Estoque: <?php echo $estoque?></li>
                </ul>
            </div>
        </main>

        <?php include_once("../_incluir/rodape.php"); ?>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>