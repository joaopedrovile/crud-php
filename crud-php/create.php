<?php
require 'config.php';

$message = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_completo = $_POST['nome_completo'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    if (!empty($nome_completo) && !empty($email) && !empty($senha)) {
        $sql = "INSERT INTO usuarios (nome_completo, email, senha) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute([$nome_completo, $email, $senha])) {
            $message = "Usuário cadastrado com sucesso!";
        } else {
            $error = "Erro ao cadastrar usuário!";
        }
    } else {
        $error = "Todos os campos são obrigatórios!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastrar Usuário</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Usuário</h2>
        <?php
        if ($message) {
            echo "<p class='message'>$message</p>";
        }
        if ($error) {
            echo "<p class='error'>$error</p>";
        }
        ?>
        <form method="post" action="create.php">
            <label for="nome_completo">Nome Completo:</label>
            <input type="text" id="nome_completo" name="nome_completo" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>
