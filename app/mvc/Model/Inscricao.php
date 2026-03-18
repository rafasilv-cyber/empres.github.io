<?php
class Inscricao {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function realizarInscricao($participante_id, $evento_id) {
        // Regra 1: Verifica se o participante já está inscrito
        $stmt = $this->pdo->prepare("SELECT id FROM inscricoes WHERE participante_id = ? AND evento_id = ?");
        $stmt->execute([$participante_id, $evento_id]);
        if ($stmt->rowCount() > 0) {
            return "Erro: O participante já está inscrito neste evento.";
        }

        // Regra 2: Verifica a capacidade máxima do evento
        $stmtEvento = $this->pdo->prepare("
            SELECT e.max_participantes, COUNT(i.id) as total_inscritos 
            FROM eventos e 
            LEFT JOIN inscricoes i ON e.id = i.evento_id 
            WHERE e.id = ? 
            GROUP BY e.id
        ");
        $stmtEvento->execute([$evento_id]);
        $dadosEvento = $stmtEvento->fetch(PDO::FETCH_ASSOC);

        if ($dadosEvento['total_inscritos'] >= $dadosEvento['max_participantes']) {
            return "Erro: As inscrições para este evento estão esgotadas.";
        }

        // Realiza a inscrição se passou pelas regras acima
        $stmtInsert = $this->pdo->prepare("INSERT INTO inscricoes (participante_id, evento_id) VALUES (?, ?)");
        if ($stmtInsert->execute([$participante_id, $evento_id])) {
            return "Sucesso: Inscrição realizada com sucesso!";
        }

        return "Erro: Falha ao realizar a inscrição no banco de dados.";
    }

    public function listarParticipantesPorEvento($evento_id) {
        $stmt = $this->pdo->prepare("
            SELECT p.nome, p.email, p.telefone 
            FROM inscricoes i
            JOIN participantes p ON i.participante_id = p.id
            WHERE i.evento_id = ?
        ");
        $stmt->execute([$evento_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>