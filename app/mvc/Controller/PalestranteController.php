<?php
// Traz o Model do Palestrante
require_once(__DIR__ . '/../Model/Palestrante.php');

class PalestranteController {
    private $palestranteModel;

    public function __construct($pdo) {
        $this->palestranteModel = new Palestrante($pdo);
    }

    // Lista os palestrantes e chama a View para exibir na tela
    public function listar() {
        $palestrantes = $this->palestranteModel->listarTodos();
        
        // Inclui a tela de listagem de palestrantes
        require_once(__DIR__ . '/../View/palestrantes/listar.php');
    }

    // Recebe os dados do formulário e manda cadastrar
    public function cadastrar($nome, $email, $telefone, $especialidade) {
        $sucesso = $this->palestranteModel->cadastrar($nome, $email, $telefone, $especialidade);
        
        if ($sucesso) {
            return "Palestrante cadastrado com sucesso!";
        } else {
            return "Erro ao cadastrar o palestrante.";
        }
    }

    // Busca os dados de um palestrante para carregar no formulário de edição
    public function buscarPalestrante($id) {
        $palestrante = $this->palestranteModel->buscarPorId($id);
        
        // Chama a view de edição passando os dados do palestrante
        require_once(__DIR__ . '/../View/palestrantes/editar.php');
        return $palestrante;
    }

    // Recebe os dados atualizados do formulário e manda salvar
    public function editar($id, $nome, $email, $telefone, $especialidade) {
        $sucesso = $this->palestranteModel->editar($id, $nome, $email, $telefone, $especialidade);
        
        if ($sucesso) {
            return "Palestrante atualizado com sucesso!";
        } else {
            return "Erro ao atualizar o palestrante.";
        }
    }

    // Manda excluir um palestrante pelo ID
    public function deletar($id) {
        $sucesso = $this->palestranteModel->excluir($id);
        
        if ($sucesso) {
            return "Palestrante excluído com sucesso!";
        } else {
            return "Erro ao excluir o palestrante.";
        }
    }
}