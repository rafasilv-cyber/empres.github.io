<?php
// Traz o Model do Participante
require_once(__DIR__ . '/../Model/Participante.php');

class ParticipanteController {
    private $participanteModel;

    public function __construct($pdo) {
        $this->participanteModel = new Participante($pdo);
    }

    // Lista os participantes e chama a View para exibir na tela
    public function listar() {
        $participantes = $this->participanteModel->listarTodos();
        
        // Inclui a tela de listagem de participantes
        require_once(__DIR__ . '/../View/participantes/listar.php');
    }

    // Recebe os dados do formulário e manda cadastrar
    public function cadastrar($nome, $email, $telefone) {
        $sucesso = $this->participanteModel->cadastrar($nome, $email, $telefone);
        
        if ($sucesso) {
            return "Participante cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar o participante.";
        }
    }

    // Busca os dados de um participante para carregar no formulário de edição
    public function buscarParticipante($id) {
        $participante = $this->participanteModel->buscarPorId($id);
        
        // Chama a view de edição passando os dados do participante
        require_once(__DIR__ . '/../View/participantes/editar.php');
        return $participante;
    }

    // Recebe os dados atualizados do formulário e manda salvar
    public function editar($id, $nome, $email, $telefone) {
        $sucesso = $this->participanteModel->editar($id, $nome, $email, $telefone);
        
        if ($sucesso) {
            return "Participante atualizado com sucesso!";
        } else {
            return "Erro ao atualizar o participante.";
        }
    }

    // Manda excluir um participante pelo ID
    public function deletar($id) {
        $sucesso = $this->participanteModel->excluir($id);
        
        if ($sucesso) {
            return "Participante excluído com sucesso!";
        } else {
            return "Erro ao excluir o participante.";
        }
    }
}
?>