<?php
require_once(__DIR__ . '/../Model/Inscricao.php');

class InscricaoController {
    private $inscricaoModel;

    public function __construct($pdo) {
        $this->inscricaoModel = new Inscricao($pdo);
    }

    public function inscrever($participante_id, $evento_id) {
        $mensagem = $this->inscricaoModel->realizarInscricao($participante_id, $evento_id);
        
        // Retorna a mensagem para ser exibida na View
        return $mensagem;
    }

    public function participantesDoEvento($evento_id) {
        $participantes = $this->inscricaoModel->listarParticipantesPorEvento($evento_id);
        
        // Puxa a View para mostrar a lista (ajuste o caminho se necessário)
        require_once(__DIR__ . '/../View/inscricoes/listar.php');
        return $participantes;
    }
}
?>