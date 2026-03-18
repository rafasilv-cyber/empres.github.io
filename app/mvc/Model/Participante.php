<?php
class Participante {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 1. Cadastrar Participante
    public function cadastrar($nome, $email, $telefone) {
        $sql = "INSERT INTO participantes (nome, email, telefone) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone]);
    }

    // 2. Listar todos os participantes (ordenados por nome)
    public function listarTodos() {
        $sql = "SELECT * FROM participantes ORDER BY nome ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Buscar um participante específico pelo ID (para a tela de edição)
    public function buscarPorId($id) {
        $sql = "SELECT * FROM participantes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Editar Participante
    public function editar($id, $nome, $email, $telefone) {
        $sql = "UPDATE participantes SET nome = ?, email = ?, telefone = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $id]);
    }

    // 5. Excluir Participante
    public function excluir($id) {
        $sql = "DELETE FROM participantes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>