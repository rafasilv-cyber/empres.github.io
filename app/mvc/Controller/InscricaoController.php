<?php
require_once(__DIR__ . '/../Model/Inscricao.php');
// Precisamos desses dois Models para carregar as listas suspensas (dropdowns)
require_once(__DIR__ . '/../Model/Evento.php');
require_once(__DIR__ . '/../Model/Participante.php');

class InscricaoController {
    private $inscricaoModel;
    private $pdo; // Vamos guardar o PDO aqui para passar para os outros Models

    public function __construct($pdo) {
        $this->inscricaoModel = new Inscricao($pdo);
        $this->pdo = $pdo; 
    }

    // Carrega a tela bonita de cadastrar com os dropdowns
    public function novaInscricao() {
        $eventoModel = new Evento($this->pdo);
        $participanteModel = new Participante($this->pdo);
        
        $eventos = $eventoModel->listarTodos();
        $participantes = $participanteModel->listarTodos();
        
        require_once(__DIR__ . '/../View/inscricoes/cadastrar.php');
    }

    // Salva a inscrição no banco
    public function inscrever($participante_id, $evento_id) {
        return $this->inscricaoModel->realizarInscricao($participante_id, $evento_id);
    }

    // Lista quem está no evento e permite cancelar a inscrição
    public function participantesDoEvento($evento_id) {
        $participantes = $this->inscricaoModel->listarParticipantesPorEvento($evento_id);
        require_once(__DIR__ . '/../View/inscricoes/listar.php');
    }

    // Cancela a inscrição
    public function deletar($participante_id, $evento_id) {
        return $this->inscricaoModel->deletarInscricao($participante_id, $evento_id);
    }
}
?>