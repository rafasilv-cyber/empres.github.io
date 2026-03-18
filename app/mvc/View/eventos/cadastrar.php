<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Evento</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Cadastrar Novo Evento</h1>
    <a href="?rota=listar_eventos">Voltar para a lista</a>
    <hr>

    <form action="?rota=salvar_evento" method="POST">
        
        <label>Nome do Evento:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" rows="4" cols="50"></textarea><br><br>

        <label>Data do Evento:</label><br>
        <input type="date" name="data_evento" required><br><br>

        <label>Horário:</label><br>
        <input type="time" name="horario" required><br><br>

        <label>Local:</label><br>
        <input type="text" name="local_evento" required><br><br>

        <label>Máximo de Participantes:</label><br>
        <input type="number" name="max_participantes" min="1" required><br><br>

        <button type="submit">Salvar Evento</button>
        
    </form>
</body>
</html>