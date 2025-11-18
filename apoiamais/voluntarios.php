<?php
session_start();
include "conexao.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apoia+ - Voluntários</title>
    <link rel="stylesheet" href="style.css">
    <link rel="manifest" href="manifest.json">

    <!-- Ícone para notificações -->
    <link rel="icon" href="icon-192.png">
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Solicita permissão para notificações
        if (Notification.permission !== "granted" && Notification.permission !== "denied") {
            Notification.requestPermission();
        }
        carregarPedidos(); // Carrega pedidos ao abrir a página
        setInterval(carregarPedidos, 10000); // Atualiza a cada 10 segundos
    });

    function mostrarNotificacao(titulo, mensagem) {
        if (Notification.permission === "granted") {
            new Notification(titulo, { body: mensagem, icon: 'icon-192.png' });
        }
    }

    function carregarPedidos() {
        fetch('voluntarios_check.php')
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById('pedidosContainer');
            container.innerHTML = '';

            // Pedidos de ajuda
            data.pedidos.forEach(item => {
                const p = document.createElement('p');
                p.innerHTML = `<b>${item.nome}:</b> ${item.descricao} <br><small>${item.data_pedido}</small>`;
                container.appendChild(p);

                if(item.visualizado == 0){
                    mostrarNotificacao("Novo pedido de ajuda!", item.descricao);
                    marcarVisualizado('marcar_visualizado.php', item.id);
                }
            });

            // SOS
            data.sos.forEach(item => {
                const p = document.createElement('p');
                p.classList.add('sos');
                p.innerHTML = `<b>🚨 SOS de ${item.nome}!</b> <br><small>${item.data}</small>`;
                container.appendChild(p);

                if(item.visualizado == 0){
                    mostrarNotificacao("🚨 SOS recebido!", `Usuário: ${item.nome}`);
                    marcarVisualizado('marcar_sos.php', item.id);
                }
            });
        })
        .catch(err => console.error('Erro ao carregar pedidos:', err));
    }

    function marcarVisualizado(url, id) {
        fetch(url, {
            method: 'POST',
            headers: {'Content-type':'application/x-www-form-urlencoded'},
            body: 'id=' + id
        });
    }

    if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('sw.js')
    .then(() => console.log('Service Worker registrado'))
    .catch(err => console.error('Erro ao registrar SW:', err));
    }

    </script>
</head>
<body>
<div class="container">
    <h2>Pedidos de Ajuda</h2>
    <div id="pedidosContainer">
        <!-- Pedidos e SOS serão carregados via AJAX -->
    </div>
    <button onclick="window.location.href='menu.php'">Voltar ao Menu</button>
</div>
</body>
</html>
