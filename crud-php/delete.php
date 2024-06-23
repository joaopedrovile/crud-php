<?php
require 'config.php';

$id = $_GET['id'];

if ($id) {
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$id])) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir usuário!";
    }
} else {
    echo "ID inválido!";
}

