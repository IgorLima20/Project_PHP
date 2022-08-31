<?php
    $servidor = "localhost";
    $usuario = "root";
    $senha = "12345678";
    $banco = "aulaphp";
    $conecta = mysqli_connect($servidor, $usuario, $senha, $banco);

    if (mysqli_connect_errno())
    {
        die("Conexão falho: ". mysqli_connect_errno());
    }
?>