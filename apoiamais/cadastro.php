<?php
include "conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado!'); location.href='index.php';</script>";
    } else {
        echo "<script>alert('Erro: e-mail já cadastrado.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Apoia+ - Cadastro</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Criar Conta</h2>

    <form method="POST">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Cadastrar</button>
    </form>
</div>

</body>
</html>
