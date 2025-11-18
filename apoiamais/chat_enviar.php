<?php
session_start();
include "conexao.php";

$usuario = $_SESSION['id'];
$mensagem = $_POST['mensagem'] ?? '';

// Salva mensagem do usuário
$sql = "INSERT INTO chat (usuario_id, mensagem, remetente) VALUES (?, ?, 'usuario')";
$stmt = $con->prepare($sql);
$stmt->bind_param("is", $usuario, $mensagem);
$stmt->execute();

// Resposta automática do bot
$resposta = "Entendi. Pode me contar mais?";

// Palavras-chave
if(stripos($mensagem,"triste")!==false) $resposta="Sinto muito que esteja passando por isso 💛";
if(stripos($mensagem,"ansioso")!==false) $resposta="Respire fundo. Estou aqui com você 💙";
if(stripos($mensagem,"medo")!==false) $resposta="Tudo bem sentir medo. Estamos juntos!";
if(stripos($mensagem,"oi")!==false || stripos($mensagem,"olá")!==false) $resposta="Olá! Como posso te ajudar hoje?";

// Salva resposta do bot
$sql2 = "INSERT INTO chat (usuario_id, mensagem, remetente) VALUES (?, ?, 'bot')";
$stmt2 = $con->prepare($sql2);
$stmt2->bind_param("is",$usuario,$resposta);
$stmt2->execute();
?>
