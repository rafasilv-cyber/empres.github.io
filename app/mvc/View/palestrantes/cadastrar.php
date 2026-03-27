<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Palestrante</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Cadastrar Novo Palestrante</h1>
    <a href="?rota=listar_palestrantes">Voltar para a lista</a>
    <hr>

    <form action="?rota=salvar_palestrante" method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" required><br><br>

        <label>Especialidade:</label><br>
        <input type="text" name="especialidade" required><br><br>


        <button type="submit">Salvar Palestrante</button>
    </form>
</body>
</html>