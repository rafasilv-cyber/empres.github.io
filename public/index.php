<?php
// =======================================================
// 1. CONEXÃO COM O BANCO DE DADOS
// =======================================================
$host = 'localhost';
$dbname = 'empres';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Configura para mostrar os erros do banco de dados na tela
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}

// =======================================================
// 2. IMPORTAR OS CONTROLLERS
// =======================================================
require_once(__DIR__ . '/../app/mvc/Controller/EventoController.php');
require_once(__DIR__ . '/../app/mvc/Controller/ParticipanteController.php');
require_once(__DIR__ . '/../app/mvc/Controller/InscricaoController.php');

// Instanciar os Controllers passando a conexão com o banco
$eventoController = new EventoController($pdo);
$participanteController = new ParticipanteController($pdo);
$inscricaoController = new InscricaoController($pdo);


// =======================================================
// 3. O SISTEMA DE ROTAS (O Maestro)
// =======================================================
// Pega a ação da URL. Se a pessoa apenas entrar no site, a rota padrão será 'listar_eventos'
$rota = isset($_GET['rota']) ? $_GET['rota'] : 'listar_eventos';

switch ($rota) {

    // -----------------------------------------
    // ROTAS DE EVENTOS
    // -----------------------------------------
    case 'listar_eventos':
        $eventoController->listar();
        break;
        
    case 'novo_evento':
        require_once(__DIR__ . '/../app/mvc/View/eventos/cadastrar.php');
        break;
        
    case 'salvar_evento':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensagem = $eventoController->cadastrar($_POST['nome'], $_POST['descricao'], $_POST['data_evento'], $_POST['horario'], $_POST['local_evento'], $_POST['max_participantes']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_eventos';</script>";
        }
        break;
        
    case 'editar_evento':
        if (isset($_GET['id'])) {
            $eventoController->buscarEvento($_GET['id']);
        }
        break;
        
    case 'atualizar_evento':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensagem = $eventoController->editar($_POST['id'], $_POST['nome'], $_POST['descricao'], $_POST['data_evento'], $_POST['horario'], $_POST['local_evento'], $_POST['max_participantes']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_eventos';</script>";
        }
        break;
        
    case 'deletar_evento':
        if (isset($_GET['id'])) {
            $mensagem = $eventoController->deletar($_GET['id']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_eventos';</script>";
        }
        break;

    // -----------------------------------------
    // ROTAS DE PARTICIPANTES
    // -----------------------------------------
    case 'listar_participantes':
        $participanteController->listar();
        break;
        
    case 'novo_participante':
        require_once(__DIR__ . '/../app/mvc/View/participantes/cadastrar.php');
        break;
        
    case 'salvar_participante':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensagem = $participanteController->cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_participantes';</script>";
        }
        break;
        
    case 'editar_participante':
        if (isset($_GET['id'])) {
            $participanteController->buscarParticipante($_GET['id']);
        }
        break;
        
    case 'atualizar_participante':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensagem = $participanteController->editar($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_participantes';</script>";
        }
        break;
        
    case 'deletar_participante':
        if (isset($_GET['id'])) {
            $mensagem = $participanteController->deletar($_GET['id']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_participantes';</script>";
        }
        break;

    // -----------------------------------------
    // ROTAS DE INSCRIÇÕES (Gerencia participantes dentro do evento)
    // -----------------------------------------
    case 'participantes_evento':
        if (isset($_GET['id'])) {
            $inscricaoController->participantesDoEvento($_GET['id']);
        }
        break;

    // -----------------------------------------
    // ROTA PADRÃO (Erro 404 - Página não encontrada)
    // -----------------------------------------
    default:
        echo "<h1>Erro 404 - Página não encontrada</h1>";
        echo "<p>A rota que você tentou acessar (<strong>$rota</strong>) não existe.</p>";
        echo "<a href='?rota=listar_eventos'>Voltar ao início</a>";
        break;
}
?>