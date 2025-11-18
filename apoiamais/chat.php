<?php
session_start();
if (!isset($_SESSION['id'])) { header("Location: index.php"); exit; }
?>

<!DOCTYPE html>
<html>
<head>
<title>Chat Apoia+</title>
<link rel="stylesheet" href="style.css">
<style>
#chatBox { height:300px; overflow-y:auto; border:1px solid #ccc; padding:10px; margin-bottom:10px; }
</style>
</head>
<body>

<div class="container">
<h2>Chat de Apoio</h2>

<div id="chatBox"></div>

<input type="text" id="msg" placeholder="Digite sua mensagem...">
<button onclick="enviar()">Enviar</button>
<button onclick="window.location.href='menu.php'">Voltar</button>
</div>

<script>
function carregarChat(){
    fetch('chat_carregar.php')
    .then(res => res.text())
    .then(data => {
        document.getElementById('chatBox').innerHTML = data;
        document.getElementById('chatBox').scrollTop = document.getElementById('chatBox').scrollHeight;
    });
}

function enviar(){
    let msg = document.getElementById('msg').value;
    if(msg.trim() === '') return;
    
    fetch('chat_enviar.php', {
        method: 'POST',
        headers: {'Content-type':'application/x-www-form-urlencoded'},
        body: 'mensagem=' + encodeURIComponent(msg)
    }).then(()=> {
        document.getElementById('msg').value = '';
        carregarChat();
    });
}

// Atualiza chat a cada 2 segundos
setInterval(carregarChat, 2000);
carregarChat();
</script>

</body>
</html>
