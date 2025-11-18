<?php
session_start();
include "conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuário não logado']);
    exit;
}

// Pedidos
$sqlPedidos = "SELECT pedidos.id, pedidos.descricao, pedidos.data_pedido, pedidos.visualizado, usuarios.nome
               FROM pedidos
               JOIN usuarios ON usuarios.id = pedidos.usuario_id
               ORDER BY pedidos.id DESC";
$resultPedidos = $con->query($sqlPedidos);
$pedidos = [];
while($row = $resultPedidos->fetch_assoc()){
    $pedidos[] = $row;
}

// SOS
$sqlSOS = "SELECT sos_alertas.id, sos_alertas.data, sos_alertas.visualizado, usuarios.nome
           FROM sos_alertas
           JOIN usuarios ON usuarios.id = sos_alertas.usuario_id
           ORDER BY sos_alertas.id DESC";
$resultSOS = $con->query($sqlSOS);
$sos = [];
while($row = $resultSOS->fetch_assoc()){
    $sos[] = $row;
}

// Retorna JSON
header('Content-Type: application/json');
echo json_encode(['pedidos' => $pedidos, 'sos' => $sos]);
