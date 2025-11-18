<?php
session_start();
include "conexao.php";
$usuario = $_SESSION['id'];

$sql = "SELECT * FROM chat WHERE usuario_id=? ORDER BY data ASC";
$stmt = $con->prepare($sql);
$stmt->bind_param("i",$usuario);
$stmt->execute();
$res = $stmt->get_result();

while($c = $res->fetch_assoc()){
    $nome = ($c['remetente']=='usuario') ? 'Você' : 'Bot';
    echo "<p><b>{$nome}:</b> {$c['mensagem']} <small>({$c['data']})</small></p>";
}
?>
