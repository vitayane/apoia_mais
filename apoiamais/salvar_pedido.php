<?php
session_start();
include "conexao.php";

$descricao = $_POST['descricao'];
$usuario_id = $_SESSION['id'];

$sql = "INSERT INTO pedidos (usuario_id, descricao) VALUES (?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("is", $usuario_id, $descricao);

if ($stmt->execute()) {
    echo "<script>alert('Pedido enviado!'); location.href='menu.php';</script>";
} else {
    echo "<script>alert('Erro ao enviar pedido.'); history.back();</script>";
}
?>
