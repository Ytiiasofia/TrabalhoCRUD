<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrando novo produto</title>
    <link rel="stylesheet" href="../css/edit.css">
</head>
<body>
    <div class="container">
            <div class="header-buttons">
                <a href="mostrar.php" class="back-button">Voltar</a>
            </div>
        
        <form method="POST" action="proc_form.php">
            <fieldset>
                <legend>Novo Produto</legend>
                
                <div class="form-section">                    
                    <div class="form-group">
                        <label for="nome_produto">Nome do Produto:</label>
                        <input type="text" id="nome_produto" name="nome_produto" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea id="descricao" name="descricao" rows="4" required></textarea>
                    </div>
                
                
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="">Selecione uma categoria</option>
                            <?php
                                include("../include/conecta.php");
                                
                                if ($con) {
                                    $sql = "SELECT * FROM categorias ORDER BY categoria";
                                    $categorias = mysqli_query($con, $sql);

                                    foreach ($categorias as $categoria) {
                                        echo "<option value='{$categoria['id']}'>{$categoria['categoria']}</option>";
                                    }
                                } else {
                                    echo "<option>Erro ao conectar</option>";
                                }
                            ?>
                        </select>
                    </div>
                
                
                    <div class="form-group">
                        <label for="numero_serie">Número de Série/Patrimônio:</label>
                        <input type="text" id="numero_serie" name="numero_serie" required>
                    </div>
                
                    <label for="situacao">Situação:</label>                    
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="statusAvailable" name="situacao" value="disponivel" required>
                            <label for="statusAvailable">Disponível</label>
                        </div>
                        
                        <div class="radio-option">
                            <input type="radio" id="statusBorrowed" name="situacao" value="emprestado">
                            <label for="statusBorrowed">Emprestado</label>
                        </div>
                        
                        <div class="radio-option">
                            <input type="radio" id="statusMaintenance" name="situacao" value="em_manutencao">
                            <label for="statusMaintenance">Em Manutenção</label>
                        </div>
                    </div>                
                <input type="submit" name="enviar" value="Cadastrar Empréstimos">
            </fieldset>
        </form>
    </div>
</body>
</html>