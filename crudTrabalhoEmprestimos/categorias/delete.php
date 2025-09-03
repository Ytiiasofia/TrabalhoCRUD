<?php
// delete.php para categorias

// recupera o parâmetro id vindo pela URL
$id_categoria = $_GET["id"];

// conecta ao banco
include("../include/conecta.php");

// verifica se existe produto usando essa categoria
$sql_check = "SELECT COUNT(*) AS total FROM emprestimos WHERE categoria_id = $id_categoria";
$res_check = mysqli_query($con, $sql_check);
$row = mysqli_fetch_assoc($res_check);

if ($row['total'] > 0) {
    echo "<script>alert('Não é possível excluir pois existem produtos usando esta categoria'); window.location.href='mostrar.php';</script>";
} else {
    // consulta para excluir a categoria
    $sql = "DELETE FROM categorias WHERE id = $id_categoria";

    // executa e verifica
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Categoria excluída com sucesso'); window.location.href='mostrar.php';</script>";
    } else {
        echo "<script>alert('Houve um erro ao excluir a categoria'); window.location.href='mostrar.php';</script>";
    }
}

mysqli_close($con);
?>