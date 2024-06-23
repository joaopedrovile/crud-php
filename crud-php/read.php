<?php
require 'config.php';

$sql = "SELECT id, nome_completo, email FROM usuarios";
$stmt = $conn->query($sql);
$usuarios = $stmt->fetchAll();

if ($usuarios) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nome Completo</th><th>Email</th><th>Ações</th></tr>";
    foreach ($usuarios as $usuario) {
        echo "<tr>";
        echo "<td>{$usuario['id']}</td>";
        echo "<td>{$usuario['nome_completo']}</td>";
        echo "<td>{$usuario['email']}</td>";
        echo "<td><a href='update.php?id={$usuario['id']}'>Editar</a> | <a href='delete.php?id={$usuario['id']}'>Excluir</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum usuário encontrado!";
}

