<?php
session_start();
include "conexao.php";

$usuario = $_SESSION['id'] ?? 0;

if($usuario > 0){
    $sql = "INSERT INTO sos_alertas (usuario_id) VALUES (?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i",$usuario);
    $stmt->execute();
}

echo "<script>alert('🚨 SOS enviado aos voluntários!'); location.href='menu.php';</script>";
