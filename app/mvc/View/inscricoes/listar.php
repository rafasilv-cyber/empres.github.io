<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Participantes do Evento</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Inscritos no Evento</h1>
    <a href="?rota=listar_eventos">Voltar para Eventos</a> |
    <a href="?rota=novo_participante" style="color: red;">Cadastrar Novo Participante antes de uma nova Inscrição!</a>
    <a href="?rota=nova_inscricao"> + Fazer Nova Inscrição</a>
    <hr>

    <table border="1">
        <thead>
            <tr>
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
                    <td><?= $p['nome'] ?></td>
                    <td><?= $p['email'] ?></td>
                    <td><?= $p['telefone'] ?></td>
                    <td>
                        <a href="?rota=deletar_inscricao&participante_id=<?= $p['participante_id'] ?>&evento_id=<?= $_GET['id'] ?>" onclick="return confirm('Cancelar inscrição deste participante?');">Cancelar Inscrição</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum participante inscrito neste evento ainda.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>