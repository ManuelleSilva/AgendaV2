<html>
    <body>
<link rel="stylesheet" href="css/style1.css">
    <div class="indexbtns">
    <button class="button"><a href="Principal.php">INICIO</a></button>
</div>
    </body>
    </html>
    
<?php
$host = "localhost:3306";
$user = "root";
$pass = "";
$base = "compromissos";
$con = mysqli_connect($host, $user, $pass, $base);

if (!$con) {
    die("Conexão falhou: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = isset($_POST['id']) ? $_POST['id'] : '';
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fim = $_POST['hora_fim'];
    $descricao = $_POST['descricao'];
    $local_evento = $_POST['local_evento'];
    $responsavel = $_POST['responsavel'];
    $msg = "";

    if ($_POST['submit'] == 'Cadastrar') {
        cadastrarEvento($con, $nome_evento, $data_evento, $hora_inicio, $hora_fim, $descricao, $local_evento, $responsavel, $msg);
        echo "<div class='titulo'><h1>Eventos</h1></div><div class='geral'>";
        listarEventos($con);
    } elseif ($_POST['submit'] == 'Atualizar') {
        atualizarEvento($con, $codigo, $nome_evento, $data_evento, $hora_inicio, $hora_fim, $descricao, $local_evento, $responsavel, $msg);
        echo "<div class='titulo'><h1>Eventos</h1></div><div class='geral'>";
        listarEventos($con);
    } elseif ($_POST['submit'] == 'Excluir') {
        removerEvento($con, $codigo, $msg);
        echo "<div class='titulo'><h1>Eventos</h1></div><div class='geral'>";
        listarEventos($con);
    } elseif ($_POST['submit'] == 'Listar') {
        echo "<div class='titulo'><h1>Eventos</h1></div><div class='geral'>";
        listarEventos($con);
    }

    echo $msg;
}

function cadastrarEvento($con, $nome_evento, $data_evento, $hora_inicio, $hora_fim, $descricao, $local_evento, $responsavel, &$msg) {

    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $base = "compromissos";
    $con = mysqli_connect($host, $user, $pass, $base);


    $sql = "INSERT INTO eventos (nome_evento, data_evento, hora_inicio, hora_fim, descricao, local_evento, responsavel) 
            VALUES ('$nome_evento', '$data_evento', '$hora_inicio', '$hora_fim', '$descricao', '$local_evento', '$responsavel')";

    if (mysqli_query($con, $sql)) {
        $codigo = mysqli_insert_id($con); // Obtém o ID do evento inserido
        if(isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novoNomeArquivo = md5(time()) . $extensao;
            $diretorio = "upload/";

            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novoNomeArquivo)) {
                $sqlInsertQuery = "INSERT INTO arquivo (codigo, arquivo, data_foto) VALUES ('$codigo', '$novoNomeArquivo', NOW())
                                   ON DUPLICATE KEY UPDATE arquivo='$novoNomeArquivo', data_foto=NOW()";
                if (mysqli_query($con, $sqlInsertQuery)) {
                    $msg = "";
                } else {
                    $msg = "";
                }
            } else {
                $msg = "";
            }
        } else {
            $msg = "";
        }
    } else {
        $msg = "";
    }
}

function atualizarEvento($con, $codigo, $nome_evento, $data_evento, $hora_inicio, $hora_fim, $descricao, $local_evento, $responsavel, &$msg) {

    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $base = "compromissos";
    $con = mysqli_connect($host, $user, $pass, $base);

    
    if (!$con) {
        $host = "localhost:3306";
        $user = "root";
        $pass = "";
        $base = "compromissos";
        $con = mysqli_connect($host, $user, $pass, $base);
    }


    $update_sql = "";
    if (!empty($nome_evento)) {
        $update_sql .= "nome_evento='$nome_evento', ";
    }
    if (!empty($data_evento)) {
        $update_sql .= "data_evento='$data_evento', ";
    }
    if (!empty($hora_inicio)) {
        $update_sql .= "hora_inicio='$hora_inicio', ";
    }
    if (!empty($hora_fim)) {
        $update_sql .= "hora_fim='$hora_fim', ";
    }
    if (!empty($descricao)) {
        $update_sql .= "descricao='$descricao', ";
    }
    if (!empty($local_evento)) {
        $update_sql .= "local_evento='$local_evento', ";
    }
    if (!empty($responsavel)) {
        $update_sql .= "responsavel='$responsavel', ";
    }

    $update_sql = rtrim($update_sql, ', ');

    $sql = "UPDATE eventos SET $update_sql WHERE id='$codigo'";

    if (mysqli_query($con, $sql)) {
        if(isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
            $extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
            $novoNomeArquivo = md5(time()) . $extensao;
            $diretorio = "upload/";

            if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio . $novoNomeArquivo)) {

            } else {
                $msg = "";
            }
        } else {
            $msg = "";
        }
    } else {
        $msg = "";
    }
}


function removerEvento($con, $codigo, &$msg) {

    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $base = "compromissos";
    $con = mysqli_connect($host, $user, $pass, $base);


    $sqlDeleteArquivo = "DELETE FROM arquivo WHERE codigo='$codigo'";
    $sqlDeleteEvento = "DELETE FROM eventos WHERE id='$codigo'";

    if (mysqli_query($con, $sqlDeleteArquivo) && mysqli_query($con, $sqlDeleteEvento)) {
        $msg = "";
    } else {
        $msg = "";
    }
}

function listarEventos() {
    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $base = "compromissos";
    $con = mysqli_connect($host, $user, $pass, $base);

    if (!$con) {
        die("Conexão falhou " . mysqli_connect_error());
    }
$sql = "SELECT eventos.*, arquivo.codigo AS codigo_imagem, arquivo.data_foto AS data_arquivo, arquivo.arquivo AS nome_arquivo FROM eventos LEFT JOIN arquivo ON eventos.id = arquivo.codigo";
$result = mysqli_query($con, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table><tr><td>Codigo do Evento</td><td>Nome do Evento</td><td>Data do Evento</td><td>Hora de inicio</td><td>Hora do fim</td><td>Descrição</td>
        <td>Local do evento</td><td>Responsavel do evento</td><td>Código da Imagem</td><td>Data</td><td>Imagem</td></tr>";

        while($escrever = mysqli_fetch_assoc($result)){
            echo "<tr><td>" . $escrever['id'] . "</td><td>" . $escrever['nome_evento'] . "</td><td>" . $escrever['data_evento'] . "</td><td>" . $escrever['hora_inicio'] . "</td><td>" . $escrever['hora_fim'] . "</td>
            <td>" . $escrever['descricao'] . "</td><td>" . $escrever['local_evento'] . "</td><td>" . $escrever['responsavel'] . "</td><td>" . $escrever['codigo_imagem'] . "</td><td>" . $escrever['data_arquivo'] . "</td>
            <td><img src='upload/" . $escrever['nome_arquivo'] . "' height='100'></td></tr>";
        }
        echo "</table>";
    } else {
        echo "";
    }
} else {
    echo "";
}
}
?>

