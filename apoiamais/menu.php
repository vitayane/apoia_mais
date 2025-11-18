<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Apoia+ - Menu</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Olá, <?php echo $_SESSION['nome']; ?>!</h2>

    <button onclick="window.location.href='pedir_ajuda.php'">Pedir Ajuda</button>
    <button onclick="window.location.href='voluntarios.php'">Oferecer Ajuda</button>

    <button onclick="window.location.href='chat.php'">Chat de Apoio</button>

    <button class="sos" onclick="window.location.href='sos.php'">🚨 SOS</button>

    <button onclick="window.location.href='logout.php'">Sair</button>
</div>

</body>
</html>
