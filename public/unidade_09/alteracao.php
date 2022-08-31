<?php require_once("../../conexao/conexao.php"); ?>
<?php 
    //inserção no banco
    if ( isset($_POST["nometransportadora"])  ) {
        $nome = $_POST["nometransportadora"];
        $endereco = $_POST["endereco"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estados"];
        $telefone = $_POST["telefone"];
        $cep = $_POST["cep"];
        $cnpj = $_POST["cnpj"];
        $tid = $_POST["transportadoraID"];

        $alterar = "UPDATE transportadoras ";
        $alterar .= "SET nometransportadora = '{$nome}', endereco = '{$endereco}', cidade = '{$cidade}', ";
        $alterar .= "estadoID = {$estado}, telefone = '{$telefone}', cep = '{$cep}', cnpj = '{$cnpj}' ";
        $alterar .= "WHERE transportadoraID = {$tid}";

        $operacaoAlterar = mysqli_query($conecta, $alterar);
        if (!$operacaoAlterar) {
            die("Falha na conexão");
        } else {
            header("location:listagem.php");
        }
    }

    $transp = "SELECT * FROM transportadoras ";
    if (isset($_GET["codigo"])) {
        $id = $_GET["codigo"];
        $transp .= "WHERE transportadoraID = {$id}";
    } else {
        $transp .= "WHERE transportadoraID = 1 ";
    }
    $consTransp = mysqli_query($conecta, $transp);
    if (!$consTransp) {
        die("Falha na conexão");
    } else {
        $infoTransp = mysqli_fetch_assoc($consTransp);
    }

    $estados = "SELECT estadoID, nome FROM estados ";
    $listaEstados = mysqli_query($conecta, $estados);
    if (!$listaEstados) {
        die("Falha na conexão com banco de dados");
    }
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Curso PHP Integração com MySQL</title>

    <!-- estilo -->
    <link href="_css/estilo.css" rel="stylesheet">
    <link href="_css/alteracao.css" rel="stylesheet">
</head>

<body>
    <?php include_once("../_incluir/topo.php"); ?>
    <?php include_once("../_incluir/funcoes.php"); ?>

    <main>
        <div id="janela_formulario">
            <form action="alteracao.php" method="POST">
                <h2>Alteração de Transportadora</h2>

                <label for="nometransportadora">Nome Transportadora</label>
                <input type="text" value="<?php echo $infoTransp["nometransportadora"]?>" name="nometransportadora"  id="nometransportadora">

                <label for="endereco">Endereço</label>
                <input type="text" value="<?php echo $infoTransp["endereco"]?>" name="endereco"  id="endereco">

                <label for="cidade">Cidade</label>
                <input type="text" value="<?php echo $infoTransp["cidade"]?>" name="cidade" id="cidade">

                <label for="estados">Estados</label>
                <select name="estados" id="estados">
                    <?php 
                        $meuestado = $infoTransp["estadoID"];
                        while($linha = mysqli_fetch_assoc($listaEstados)) {
                            $estado_momento = $linha["estadoID"];
                            if ($meuestado == $estado_momento) {
                    ?>
                        <option value="<?php echo $linha["estadoID"]; ?>" selected>
                            <?php echo $linha["nome"]; ?>
                        </option>
                    <?php 
                            } else {
                    ?>   
                        <option value="<?php echo $linha["estadoID"]; ?>">
                            <?php echo $linha["nome"]; ?>
                        </option>
                    <?php 
                            } 
                        }
                    ?>
                </select>

                <label for="telefone">Telefone</label>
                <input type="text" value="<?php echo $infoTransp["telefone"]?>" name="telefone" id="telefone">

                <label for="cep">CEP</label>
                <input type="text" value="<?php echo $infoTransp["cep"]?>" name="cep" id="cep">

                <label for="cnpj">CNPJ</label>
                <input type="text" value="<?php echo $infoTransp["cnpj"]?>" name="cnpj" id="cnpj">

                <input type="hidden" name="transportadoraID" value="<?php echo $infoTransp["transportadoraID"]?>" id="transportadoraID">

                <input type="submit" value="Confirma Alteração">
            </form>
        </div>
    </main>

    <?php include_once("../_incluir/rodape.php"); ?>
</body>

</html>

<?php
// Fechar conexao
mysqli_close($conecta);
?>