<?php
class Evento {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 1. Cadastrar Evento
    public function cadastrar($nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes) {
        $sql = "INSERT INTO eventos (nome, descricao, data_evento, horario, local_evento, max_participantes) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes]);
    }

    // 2. Listar todos os eventos (ordenados pela data)
    public function listarTodos() {
        $sql = "SELECT * FROM eventos ORDER BY data_evento ASC, horario ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Buscar um evento específico pelo ID (para preencher o formulário de edição)
    public function buscarPorId($id) {
        $sql = "SELECT * FROM eventos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 4. Editar Evento
    public function editar($id, $nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes) {
        $sql = "UPDATE eventos 
                SET nome = ?, descricao = ?, data_evento = ?, horario = ?, local_evento = ?, max_participantes = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes, $id]);
    }

    // 5. Excluir Evento
    public function excluir($id) {
        $sql = "DELETE FROM eventos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
}
?>