<?php
session_start();
include "conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    http_response_code(401);
    echo "Usuário não logado";
    exit;
}

// Verifica se o ID foi enviado via POST
if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "UPDATE pedidos SET visualizado = 1 WHERE id = $id";
    if ($con->query($sql)) {
        echo "Pedido marcado como visualizado";
    } else {
        http_response_code(500);
        echo "Erro ao atualizar pedido: " . $con->error;
    }
} else {
    http_response_code(400);
    echo "ID não fornecido";
}
