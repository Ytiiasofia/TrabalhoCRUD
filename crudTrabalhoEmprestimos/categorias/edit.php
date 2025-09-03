<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Editando Categoria</title>
	<link rel="stylesheet" href="../css/edit.css">
</head>
<body>
<?php
$id_categoria = $_GET["id"];

include("../include/conecta.php");

if ($con) {
	$sql = "SELECT * FROM categorias WHERE id = $id_categoria";
	$resultado = mysqli_query($con, $sql);

	if (mysqli_num_rows($resultado) == 1) {
		$categoria = mysqli_fetch_array($resultado);

		$nome_categoria = $categoria["categoria"];
	} else {
		header("location: mostrar.php");
		exit;
	}
} else {
	die("Erro ao conectar com o banco de dados");
}
?>
<div class="container">
	<form method="POST" action="proc_form.php">
		    <div class="header-buttons">
                <a href="mostrar.php" class="back-button">Voltar</a>
            </div>
		<fieldset>
			<legend>Editar Categoria</legend>

			<label>Nome da Categoria:</label>
			<input type="text" name="categoria" value="<?= $nome_categoria ?>" required> <br>

			<input type="hidden" name="id_categoria" value="<?= $id_categoria ?>">
			<input type="submit" name="editar" value="Salvar Alterações">
		</fieldset>
	</form>
</div>
</body>
</html>