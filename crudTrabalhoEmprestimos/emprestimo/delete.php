<?php

$id_emprestimo = $_GET["id"];

include("../include/conecta.php");

$sql = "DELETE FROM emprestimos WHERE id = $id_emprestimo";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Produto excluído com sucesso'); window.location.href='mostrar.php';</script>";
} else {
    echo "<script>alert('Houve um erro ao excluir'); window.location.href='mostrar.php';</script>";
}

mysqli_close($con);
?>

