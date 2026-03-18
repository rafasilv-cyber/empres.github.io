<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Participantes</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Participantes Cadastrados</h1>
    <a href="?rota=novo_participante"> + Cadastrar Novo Participante</a>
    <hr>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($participantes)): ?>
                <?php foreach ($participantes as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= $p['nome'] ?></td>
                    <td><?= $p['email'] ?></td>
                    <td><?= $p['telefone'] ?></td>
                    <td>
                        <a href="?rota=editar_participante&id=<?= $p['id'] ?>">Editar</a> | 
                        <a href="?rota=deletar_participante&id=<?= $p['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum participante cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>