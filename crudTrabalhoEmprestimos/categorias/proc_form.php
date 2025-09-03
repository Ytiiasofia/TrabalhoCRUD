<?php

if (!isset($_POST["enviar"]) && !isset($_POST["editar"])) {
    header("location: create.php");
    exit;
}

$categoria = trim($_POST["categoria"]);

$id_categoria = isset($_POST["id_categoria"]) ? intval($_POST["id_categoria"]) : 0;

$erros = [];

if (empty($categoria)) {
    $erros[] = "Preencha o <b>nome da categoria</b>";
}

if (count($erros) == 0) {
    include("../include/conecta.php");

    if (!$con) {
        die("Erro de conexão: " . mysqli_connect_error());
    }

    if ($id_categoria > 0) {
        $sql = "UPDATE categorias 
                   SET categoria = '$categoria'
                 WHERE id = $id_categoria";
        $msg = "Categoria atualizada com sucesso!";
    } else {
        $sql = "INSERT INTO categorias (categoria) VALUES ('$categoria')";
        $msg = "Categoria cadastrada com sucesso!";
    }

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('$msg'); window.location.href='mostrar.php';</script>";
    } else {
        echo "Erro ao salvar: " . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    foreach ($erros as $erro) {
        echo "$erro <br>";
    }
}
?>