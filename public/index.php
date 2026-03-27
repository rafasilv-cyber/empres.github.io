<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Direção de Eventos</title> <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
    
<h1>Bem Vindo a sua Direção de Eventos!</h1>
<p>Gerencie seus eventos e participantes de forma simples e eficiente.</p>
<nav>
    <a href="?rota=listar_eventos">Eventos</a> |
    <a href="?rota=listar_participantes">Participantes</a> |
    <a href="?rota=nova_inscricao">Inscrições</a> |
    <a href="?rota=listar_palestrantes">Palestrantes</a>
</nav>

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
require_once(__DIR__ . '/../app/mvc/Controller/PalestranteController.php');

// Instanciar os Controllers passando a conexão com o banco
$eventoController = new EventoController($pdo);
$participanteController = new ParticipanteController($pdo);
$inscricaoController = new InscricaoController($pdo);
$palestranteController = new PalestranteController($pdo);


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
    // ROTAS DE INSCRIÇÕES (Gerencia participantes dentro do evento)
    // -----------------------------------------
 case 'nova_inscricao':
        $inscricaoController->novaInscricao();
        break;

    case 'salvar_inscricao':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensagem = $inscricaoController->inscrever($_POST['participante_id'], $_POST['evento_id']);
            $evento_id = $_POST['evento_id'];
            echo "<script>alert('$mensagem'); window.location.href='?rota=participantes_evento&id=$evento_id';</script>";
        }
        break;

    case 'participantes_evento':
        if (isset($_GET['id'])) {
            $inscricaoController->participantesDoEvento($_GET['id']);
        }
        break;

    case 'deletar_inscricao':
        if (isset($_GET['participante_id']) && isset($_GET['evento_id'])) {
            $mensagem = $inscricaoController->deletar($_GET['participante_id'], $_GET['evento_id']);
            $evento_id = $_GET['evento_id'];
            echo "<script>alert('$mensagem'); window.location.href='?rota=participantes_evento&id=$evento_id';</script>";
        }
        break;

    // -----------------------------------------
    // ROTAS DE PALESTRANTES
    // -----------------------------------------
    case 'listar_palestrantes':
        $palestranteController->listar();
        break;
        
    case 'novo_palestrante':
        require_once(__DIR__ . '/../app/mvc/View/palestrantes/cadastrar.php');
        break;
        
    case 'salvar_palestrante':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensagem = $palestranteController->cadastrar($_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['especialidade']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_palestrantes';</script>";
        }
        break;
        
    case 'editar_palestrante':
        if (isset($_GET['id'])) {
            $palestranteController->buscarPalestrante($_GET['id']);
        }
        break;
        
    case 'atualizar_palestrante':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensagem = $palestranteController->editar($_POST['id'], $_POST['nome'], $_POST['email'], $_POST['telefone'], $_POST['especialidade']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_palestrantes';</script>";
        }
        break;
        
    case 'deletar_palestrante':
        if (isset($_GET['id'])) {
            $mensagem = $palestranteController->deletar($_GET['id']);
            echo "<script>alert('$mensagem'); window.location.href='?rota=listar_palestrantes';</script>";
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
    // ROTA PADRÃO (Erro 404 - Página não encontrada)
    // -----------------------------------------
    default:
        echo "<h1>Erro 404 - Página não encontrada</h1>";
        echo "<p>A rota que você tentou acessar (<strong>$rota</strong>) não existe.</p>";
        echo "<a href='?rota=listar_eventos'>Voltar ao início</a>";
        break;
}
?>
</body>
</html>