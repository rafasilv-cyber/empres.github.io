<?php
class Palestrante {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 1. Cadastrar Palestrante
    public function cadastrar($nome, $email, $telefone, $especialidade) {
        $sql = "INSERT INTO palestrantes (nome, email, telefone, especialidade) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $especialidade]);
    }

    // 2. Listar todos os palestrantes (ordenados por nome)
    public function listarTodos() {
        $sql = "SELECT * FROM palestrantes ORDER BY nome ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Buscar um palestrante específico pelo ID (para a tela de edição)
    public function buscarPorId($id) {
        $sql = "SELECT * FROM palestrantes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Editar Palestrante
    public function editar($id, $nome, $email, $telefone, $especialidade) {
        $sql = "UPDATE palestrantes SET nome = ?, email = ?, telefone = ?, especialidade = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $telefone, $especialidade, $id]);
    }

    // 5. Excluir Palestrante
    public function excluir($id) {
        $sql = "DELETE FROM palestrantes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>