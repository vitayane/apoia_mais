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
    <link rel="stylesheet" href="style.css">
    <title>Apoia+ - Pedir Ajuda</title>
</head>
<body>
<div class="container">
    <h2>Pedir Ajuda</h2>

    <form action="salvar_pedido.php" method="POST">
        <textarea name="descricao" placeholder="Descreva sua necessidade..." rows="5" required></textarea>
        <button type="submit">Enviar</button>
    </form>
</div>
</body>
</html>
