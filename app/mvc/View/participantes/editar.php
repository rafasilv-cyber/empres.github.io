<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Editar Participante</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Editar Participante</h1>
    <a href="?rota=listar_participantes">Voltar para a lista</a>
    <hr>

    <form action="?rota=atualizar_participante" method="POST">
        
        <input type="hidden" name="id" value="<?= $participante['id'] ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= $participante['nome'] ?>" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" value="<?= $participante['email'] ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= $participante['telefone'] ?>" required><br><br>

        <button type="submit">Atualizar Participante</button>
        
    </form>
</body>
</html>