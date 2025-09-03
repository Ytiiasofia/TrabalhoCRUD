<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empréstimos cadastrados</title>    
    <link rel="stylesheet" href="../css/table.css">
    <link rel="stylesheet" href="../css/menu.css">
</head>
<body>
    <!-- Menu de navegação -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="../emprestimo/mostrar.php">Empréstimos</a>
            <a href="../categorias/mostrar.php">Categorias</a>
            <a href="../login/logout.php" class="logout-btn">Desconectar</a>
        </div>
    </nav>

    <div class="container">
        <h1>Empréstimos cadastrados</h1>
        
        <div class="table-container">
            <?php
            include("../include/conecta.php");

            if (!$con){
                die("Não foi possível conectar com o banco de dados");
            }

            $sql = "SELECT e.id, e.nome_produto, e.descricao, e.numero_serie, e.situacao, 
                           c.categoria 
                    FROM emprestimos e
                    JOIN categorias c ON e.categoria_id = c.id
                    ORDER BY e.nome_produto";

            $resultado = mysqli_query($con, $sql);

            if (mysqli_num_rows($resultado) > 0){
                echo ('<table>
                    <thead>
                        <tr>
                            <th>Nome do Produto</th>
                            <th>Descrição</th>
                            <th>Categoria</th>
                            <th>Número de Série</th>
                            <th>Situação</th>
                            <th class="actions-header">Ações</th>
                        </tr>
                    </thead>
                    <tbody>'
                );

                while ($linha = mysqli_fetch_assoc($resultado)) {
                    $situacao_class = "";
                    if ($linha["situacao"] == "disponivel") {
                        $situacao_class = "disponivel";
                    } elseif ($linha["situacao"] == "emprestado") {
                        $situacao_class = "emprestado";
                    } else {
                        $situacao_class = "manutencao";
                    }
                    
                    echo ("<tr>");
                    echo ("<td>" . $linha["nome_produto"] . "</td>");
                    echo ("<td>" . $linha["descricao"] . "</td>");
                    echo ("<td>" . $linha["categoria"] . "</td>");
                    echo ("<td>" . $linha["numero_serie"] . "</td>");
                    echo ("<td class='" . $situacao_class . "'>" . ucfirst($linha["situacao"]) . "</td>");
                    echo ("<td>
                            <div class='btn-container'>
                                <a href='edit.php?id=" . $linha['id'] . "' class='btn btn-edit'>Editar</a>
                                <a href='delete.php?id=" . $linha['id'] . "' class='btn btn-delete' onclick=\"return confirm('Tem certeza que deseja excluir este produto?');\">Excluir</a>
                            </div>
                        </td>");
                    echo ("</tr>");
                }
                echo ("</tbody></table>");
            } else {
                echo "<p class='empty-message'>Nenhum produto cadastrado ainda.</p>";
            }
            ?>
        </div>
        
        <!-- Botão para cadastrar novo empréstimo -->
        <div class="button-container">
            <a href="create.php" class="btn-primary">Cadastrar Empréstimo</a>
        </div>
    </div>
</body>
</html>