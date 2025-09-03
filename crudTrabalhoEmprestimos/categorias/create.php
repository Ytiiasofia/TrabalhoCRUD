<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/edit.css">
    <title>Cadastrando nova categoria</title>
</head>
<body>
    <div class="container">
            <div class="header-buttons">
                <a href="mostrar.php" class="back-button">Voltar</a>
            </div>
        <form method="POST" action="proc_form.php">
            <fieldset>
                <legend>Nova Categoria</legend>
                
                <label for="categoria">Nome da Categoria:</label>
                <input type="text" id="categoria" name="categoria" required>
                
                <input type="submit" name="enviar" value="Cadastrar Categoria">
            </fieldset>
        </form>
    </div>
</body>
</html>
