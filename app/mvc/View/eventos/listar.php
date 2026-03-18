<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Eventos</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Eventos Disponíveis</h1>
    <a href="?rota=novo_evento"> + Cadastrar Novo Evento</a> | 
    <a href="?rota=listar_participantes"> Ver Participantes</a>
    <hr>

    <table border="1">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Data e Hora</th>
                <th>Local</th>
                <th>Vagas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($eventos)): ?>
                <?php foreach ($eventos as $e): ?>
                <tr>
                    <td><?= $e['nome'] ?></td>
                    <td><?= date('d/m/Y', strtotime($e['data_evento'])) ?> às <?= $e['horario'] ?></td>
                    <td><?= $e['local_evento'] ?></td>
                    <td><?= $e['max_participantes'] ?></td>
                    <td>
                        <a href="?rota=participantes_evento&id=<?= $e['id'] ?>">Ver Inscritos / Inscrever</a> |
                        <a href="?rota=editar_evento&id=<?= $e['id'] ?>">Editar</a> | 
                        <a href="?rota=deletar_evento&id=<?= $e['id'] ?>" onclick="return confirm('Excluir este evento?');">Excluir</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum evento cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>