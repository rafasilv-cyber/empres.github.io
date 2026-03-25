<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Nova Inscrição</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Realizar Nova Inscrição</h1>
    <a href="?rota=listar_eventos">Voltar para a Lista de Eventos</a>
    <hr>
    <form action="?rota=salvar_inscricao" method="POST">
        
        <label>Selecione o Participante:</label><br>
        <select name="participante_id" required>
            <option value="">-- Escolha um Participante --</option>
            <?php if (!empty($participantes)): ?>
                <?php foreach ($participantes as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nome'] ?> (<?= $p['email'] ?>)</option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select><br><br>

        <label>Selecione o Evento:</label><br>
        <select name="evento_id" required>
            <option value="">-- Escolha um Evento --</option>
            <?php if (!empty($eventos)): ?>
                <?php foreach ($eventos as $e): ?>
                    <option value="<?= $e['id'] ?>"><?= $e['nome'] ?> (Vagas totais: <?= $e['max_participantes'] ?>)</option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select><br><br>

        <button type="submit">Confirmar Inscrição</button>
        
    </form>
</body>
</html>