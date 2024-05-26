<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
    <link rel="stylesheet" href="css/style2.css">
</head>
<body>
    <?php if (isset($msg) && $msg != false) echo "<p>$msg</p>"; ?>
    <form action="realizar.php" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Código do evento: <input class="resp" size="60" name="id"></td>
            </tr>
            <tr>
                <td>Nome do Evento: <input class="resp" size="60" name="nome_evento"></td>
            </tr>
            <tr>
                <td>Data do evento: <input class="resp" size="60" name="data_evento" placeholder="AAAA-MM-DD"></td>
            </tr>
            <tr>
                <td>Hora de início do evento: <input class="resp" size="60" name="hora_inicio" placeholder="HH:MM:SS" ></td>
            </tr>
            <tr>
                <td>Hora de fim do evento: <input class="resp" size="60" name="hora_fim" placeholder="HH:MM:SS"></td>
            </tr>
            <tr>
                <td>Descrição do evento: <input class="resp" size="60" name="descricao" ></td>
            </tr>
            <tr>
                <td>Local do evento: <input class="resp" size="60" name="local_evento"></td>
            </tr>
            <tr>
                <td>Responsável pelo evento: <input class="resp" size="60" name="responsavel"></td>
            </tr>
            <tr>
                <td>Selecione o arquivo a ser enviado:<br>
                <input type="file" name="arquivo"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="botoes">
                        <input type="submit" name="submit" value="Cadastrar">
                        <input type="submit" name="submit" value="Excluir">
                        <input type="submit" name="submit" value="Atualizar">
                        <input type="submit" name="submit" value="Listar">
                    </div>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
