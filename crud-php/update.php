<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome_completo = $_POST['nome_completo'];
    $email = $_POST['email'];
    $senha = !empty($_POST['senha']) ? password_hash($_POST['senha'], PASSWORD_DEFAULT) : null;

    if (!empty($nome_completo) && !empty($email)) {
        $sql = "UPDATE usuarios SET nome_completo = ?, email = ? " . ($senha ? ", senha = ?" : "") . " WHERE id = ?";
        $params = $senha ? [$nome_completo, $email, $senha, $id] : [$nome_completo, $email, $id];
        $stmt = $conn->prepare($sql);
        if ($stmt->execute($params)) {
            echo "Usuário atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar usuário!";
        }
    } else {
        echo "Nome e Email são obrigatórios!";
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
    $usuario = $stmt->fetch();
}
?>

<form method="post" action="update.php">
    <input type="hidden" name="id" value="<?php echo $usuario['id']; ?>">
    <label for="nome_completo">Nome Completo:</label>
    <input type="text" id="nome_completo" name="nome_completo" value="<?php echo $usuario['nome_completo']; ?>" required><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required><br>
    <label for="senha">Senha (deixe em branco para manter a mesma):</label>
    <input type="password" id="senha" name="senha"><br>
    <input type="submit" value="Atualizar">
</form>
