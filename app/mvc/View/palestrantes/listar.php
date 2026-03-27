<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Palestrantes</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Palestrantes Cadastrados</h1> <a href="index.php"><br> Voltar para a lista de eventos</a>
    <a href="?rota=novo_palestrante"> + Cadastrar Novo Palestrante</a>
    <hr>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Especialidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($palestrantes)): ?>
                <?php foreach ($palestrantes as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['nome'] ?></td>
                    <td><?= $p['email'] ?></td>
                    <td><?= $p['telefone'] ?></td>
                    <td><?= $p['especialidade'] ?></td>
                    
                    <td>
                        <a href="?rota=editar_palestrante&id=<?= $p['id'] ?>">Editar</a>
                        <a href="?rota=deletar_palestrante&id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum palestrante cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>