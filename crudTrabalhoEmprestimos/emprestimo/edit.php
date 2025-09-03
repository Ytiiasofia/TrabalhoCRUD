<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editando produto</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
<?php
$id_emprestimo = $_GET["id"];

include("../include/conecta.php");

if ($con) {
    $sql = "SELECT * FROM emprestimos WHERE id = $id_emprestimo";
    $resultado = mysqli_query($con, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $produto = mysqli_fetch_array($resultado);

        $nome = $produto["nome_produto"];
        $descricao = $produto["descricao"];
        $categoria_id = $produto["categoria_id"];
        $numero_serie = $produto["numero_serie"];
        $situacao = $produto["situacao"];
    } else {
        header("location: mostrar.php");
        exit;
    }
} else {
    die("Erro ao conectar com o banco de dados");
}

$sql_cat = "SELECT * FROM categorias ORDER BY categoria";
$categorias = mysqli_query($con, $sql_cat);
?>
<div class="container">
            <div class="header-buttons">
                <a href="mostrar.php" class="back-button">Voltar</a>
            </div>
    <form method="POST" action="proc_form.php">
        <fieldset>
            <legend>Editar Empréstimo</legend>

            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" value="<?= htmlspecialchars($nome) ?>" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" required><?= htmlspecialchars($descricao) ?></textarea>

            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <?php while ($cat = mysqli_fetch_assoc($categorias)) { ?>
                    <option value="<?= $cat['id'] ?>" <?= ($cat['id'] == $categoria_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['categoria']) ?>
                    </option>
                <?php } ?>
            </select>

            <label for="numero_serie">Número de Série / Patrimônio:</label>
            <input type="text" id="numero_serie" name="numero_serie" value="<?= htmlspecialchars($numero_serie) ?>" required>

            <label for="situacao">Situação:</label>                    
            <div class="radio-group">
                <div class="radio-option">
                    <input type="radio" id="statusAvailable" name="situacao" value="disponivel"
                        <?= ($situacao == "disponivel") ? "checked" : "" ?> required>
                    <label for="statusAvailable">Disponível</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="statusBorrowed" name="situacao" value="emprestado"
                        <?= ($situacao == "emprestado") ? "checked" : "" ?>>
                    <label for="statusBorrowed">Emprestado</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="statusMaintenance" name="situacao" value="em_manutencao"
                        <?= ($situacao == "em_manutencao") ? "checked" : "" ?>>
                    <label for="statusMaintenance">Em Manutenção</label>
                </div>
            </div>

            <input type="hidden" name="id_emprestimo" value="<?= $id_emprestimo ?>">
            <input type="submit" name="enviar" value="Salvar Alterações">
        </fieldset>
    </form>
</div>
</body>
</html>