<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Editar Evento</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Editar Evento</h1>
    <a href="?rota=listar_eventos">Voltar para a lista</a>
    <hr>

    <form action="?rota=atualizar_evento" method="POST">
        
        <input type="hidden" name="id" value="<?= $evento['id'] ?>">

        <label>Nome do Evento:</label><br>
        <input type="text" name="nome" value="<?= $evento['nome'] ?>" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" rows="4" cols="50"><?= $evento['descricao'] ?></textarea><br><br>

        <label>Data do Evento:</label><br>
        <input type="date" name="data_evento" value="<?= $evento['data_evento'] ?>" required><br><br>

        <label>Horário:</label><br>
        <input type="time" name="horario" value="<?= $evento['horario'] ?>" required><br><br>

        <label>Local:</label><br>
        <input type="text" name="local_evento" value="<?= $evento['local_evento'] ?>" required><br><br>

        <label>Máximo de Participantes:</label><br>
        <input type="number" name="max_participantes" min="1" value="<?= $evento['max_participantes'] ?>" required><br><br>

        <button type="submit">Atualizar Evento</button>
        
    </form>
</body>
</html>