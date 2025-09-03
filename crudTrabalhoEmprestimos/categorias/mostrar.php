<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Categorias cadastradas</title>
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
        <h1>Categorias cadastradas</h1>
        
        <div class="table-container">
            <?php
            include("../include/conecta.php");

            if (!$con){
                die("Não foi possível conectar com o banco de dados");
            }

            $sql = "SELECT * FROM categorias ORDER BY categoria";
            $resultado = mysqli_query($con, $sql);

            if (mysqli_num_rows($resultado) > 0){
                echo ('<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome da Categoria</th>
                            <th class="actions-header">Ações</th>
                        </tr>
                    </thead>
                    <tbody>'
                );

                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo ("<tr>");
                    echo ("<td>" . $linha["id"] . "</td>");
                    echo ("<td>" . $linha["categoria"] . "</td>");
                    echo ("<td>
                            <div class='btn-container'>
                                <a href='edit.php?id=" . $linha['id'] . "' class='btn btn-edit'>Editar</a>
                                <a href='delete.php?id=" . $linha['id'] . "' class='btn btn-delete' onclick=\"return confirm('Tem certeza que deseja excluir esta categoria?');\">Excluir</a>
                            </div>
                        </td>");
                    echo ("</tr>");
                }
                echo ("</tbody></table>");
            } else {
                echo "<p class='empty-message'>Nenhuma categoria cadastrada ainda.</p>";
            }
            ?>
        </div>
        <div class="button-container">
            <a href="../categorias/create.php" class="btn-primary"> Cadastrar Categorias</a>
         </div>
    </div>
</body>
</html>