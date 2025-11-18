<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "apoiamais";

$con = new mysqli($servidor, $usuario, $senha, $banco);

if ($con->connect_error) {
    die("Erro na conexão: " . $con->connect_error);
}

$con->set_charset("utf8");
