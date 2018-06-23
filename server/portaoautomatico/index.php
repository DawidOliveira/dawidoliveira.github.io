<?php
	$mysqli = new mysqli("localhost","root","lKnqUOcS245FyOmX","dawid");
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<style>
			li{
				font-weight: 500;
			}
			table{
				border: 1px solid black;
				border-collapse: collapse;
				text-align: center;
			}
			th, td{
				border: 1px solid black;
				padding: 5px;
			}
			form{
				margin-top: 20px;
			}
			form input{
				margin: 6px;
			}
		</style>
	</head>
	<body>
		<h2>Senhas de acesso:</h2>
		<table>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Senha</th>
				<th>Posição de Memória</th>
				<th>Dias da semana (MODO)</th>
				<th>Horario (MODO)</th>
			</tr>
			<?php
				$query=$mysqli->query("select * from portaoautomatico order by id");
				$row=$query->num_rows;
				
				if($row>0){
					while($a=$query->fetch_array()){
			?>
			<tr>
				<td><?=$a['id']?></td>
				<td><?=$a['nome']?></td>
				<td><?=$a['senha']?></td>
				<td><?=$a['posicao']?></td>
				<td><?=$a['dias']?></td>
				<td><?=$a['horario']?></td>
			</tr>
			<?php
					}
				}
			?>
			
		</table>
		
		<form method="get" action="">
		<fieldset><legend>Adicionar mais dados</legend>
			<input type="text" name="id" placeholder="Digite o id aqui" required>
			<input type="text" name="nome" placeholder="Digite o nome aqui" required>
			<input type="text" name="senha" placeholder="Digite a senha aqui" required>
			<input type="text" name="posicao" placeholder="Digite a posição aqui" required>
			<input type="text" name="dias" placeholder="Digite os dias (modo) aqui" required>
			<input type="text" name="horario" placeholder="Digite o horário (modo) aqui" required>
			<input type="submit" name="enviar" value="Enviar">
		</fieldset>
		</form>
		
	</body>
</html>

<?php
	if(isset($_GET['enviar'])){
		$id = $_GET['id'];
		$nome = $_GET['nome'];
		$senha = $_GET['senha'];
		$posicao = $_GET['posicao'];
		$dias = $_GET['dias'];
		$horario = $_GET['horario'];
		
		$q1 = $mysqli->query("SELECT * from portaoautomatico where id=$id");
		$r1 = $q1->num_rows;
		$q2 = $mysqli->query("SELECT * from portaoautomatico where posicao=$posicao");
		$r2 = $q2->num_rows;
		if($r1 > 0){
			echo "<script>alert('Digite outro id por favor!')</script>";
		}else if($r2 > 0){
			echo "<script>alert('Digite outra posição por favor!')</script>";
		}else{
			$insert = $mysqli->query("insert into portaoautomatico(id,nome,senha,posicao,dias,horario) values ($id,'$nome','$senha','$posicao','$dias','$horario')");
			if($insert){
				echo "<script>alert('Cadastrado com sucesso!');location.href='index.php';</script>";
			}else{
				echo "<script>alert('Erro ao cadastrar!');location.href='index.php';</script>";
			}
		}
		
	}
?>

<?php
	$mysqli->close();
?>

