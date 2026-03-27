<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Editar Participante</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Editar Participante</h1>
    <a href="?rota=listar_palestrante">Voltar para a lista</a>
    <hr>

    <form action="?rota=atualizar_palestrante" method="POST">
        
        <input type="hidden" name="id" value="<?= $palestrante['id'] ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= $palestrante['nome'] ?>" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" value="<?= $palestrante['email'] ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= $palestrante['telefone'] ?>" required><br><br>

        <label>Especialidade:</label><br>
        <input type="text" name="especialidade" value="<?= $palestrante['especialidade'] ?>" required><br><br>

        <button type="submit">Atualizar Palestrante</button>
        
    </form>
</body>
</html>