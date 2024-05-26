<meta charset="utf-8"> 
<?php

    $nome = $_POST['nome'];
	$senha = $_POST['senha'];
	$host  = "localhost:3306";
	$user  = "root";
	$pass  = "";
	$base  = "compromissos";
	$con   = mysqli_connect($host, $user, $pass, $base);

	if (!$con)
	{
		die("Falha na Conexao".mysqli_connect_erro());
	}

	// Monta uma consulta SQL (query) para procurar um usuário

 $sql = "SELECT * FROM tb_dados where nome='$nome' AND senha='$senha'";
 $result= mysqli_query($con, $sql);
 //VERIFICAMOS AS LINHAS AFETADAS PELA CONSULTA

//VERIFICAMO SE RETORNOU ALGO
if(mysqli_num_rows($result) > 0) 
{
	header("Location: Principal.php");
	exit(); 

}
else 
{ 

echo "Usuários ou senhas Inválidos!";

}

	mysqli_close($con);

?>
