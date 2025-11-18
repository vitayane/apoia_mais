<?php
session_start();
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $r = $stmt->get_result();

    if ($r->num_rows > 0) {
        $user = $r->fetch_assoc();

        if (password_verify($senha, $user['senha'])) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];

            header("Location: menu.php");
            exit;

        } else {
            $erro = "Senha incorreta!";
        }

    } else {
        $erro = "E-mail não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Apoia+ - Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Apoia+</h1>

    <?php if(!empty($erro)) echo "<p style='color:red'>$erro</p>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>

    <button onclick="window.location.href='cadastro.php'">Criar Conta</button>
</div>

</body>
</html>
