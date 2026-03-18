<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Participante</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Cadastrar Novo Participante</h1>
    <a href="?rota=listar_participantes">Voltar para a lista</a>
    <hr>

    <form action="?rota=salvar_participante" method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" required><br><br>

        <button type="submit">Salvar Participante</button>
    </form>
</body>
</html>