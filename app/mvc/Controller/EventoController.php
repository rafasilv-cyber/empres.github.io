<?php
// Traz o Model do Evento
require_once(__DIR__ . '/../Model/Evento.php');

class EventoController {
    private $eventoModel;

    public function __construct($pdo) {
        $this->eventoModel = new Evento($pdo);
    }

    // Lista os eventos e chama a View para mostrar na tela
    public function listar() {
        $eventos = $this->eventoModel->listarTodos();
        
        // Ajuste este caminho se o nome do seu arquivo HTML/PHP for diferente
        require_once(__DIR__ . '/../View/eventos/listar.php');
    }

    // Recebe os dados do formulário e manda cadastrar
    public function cadastrar($nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes) {
        $sucesso = $this->eventoModel->cadastrar($nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes);
        
        if ($sucesso) {
            // Se der certo, você pode redirecionar para a lista de eventos
            // header("Location: index.php?acao=listar_eventos");
            return "Evento cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar o evento.";
        }
    }

    // Busca os dados de um evento para carregar no formulário de edição
    public function buscarEvento($id) {
        $evento = $this->eventoModel->buscarPorId($id);
        
        // Chama a view de edição passando os dados do evento
        require_once(__DIR__ . '/../View/eventos/editar.php');
    }

    // Recebe os dados atualizados do formulário e manda salvar
    public function editar($id, $nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes) {
        $sucesso = $this->eventoModel->editar($id, $nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes);
        
        if ($sucesso) {
            return "Evento atualizado com sucesso!";
        } else {
            return "Erro ao atualizar o evento.";
        }
    }

    // Manda excluir um evento pelo ID
    public function deletar($id) {
        $sucesso = $this->eventoModel->excluir($id);
        
        if ($sucesso) {
            return "Evento excluído com sucesso!";
        } else {
            return "Erro ao excluir o evento.";
        }
    }
}
?>