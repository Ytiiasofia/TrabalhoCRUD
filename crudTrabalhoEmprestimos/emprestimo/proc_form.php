<?php

if (!isset($_POST["enviar"])) {
    header("location: create.php");
    exit;
}

$nome_produto = trim($_POST["nome_produto"]);
$descricao    = trim($_POST["descricao"]);
$categoria_id = isset($_POST["categoria"]) ? intval($_POST["categoria"]) : 0;
$numero_serie = trim($_POST["numero_serie"]);
$situacao     = trim($_POST["situacao"]);

$id_emprestimo = isset($_POST["id_emprestimo"]) ? intval($_POST["id_emprestimo"]) : 0;

$erros = [];

if (empty($nome_produto)) $erros[] = "Preencha o <b>nome do produto</b>";
if (empty($descricao))    $erros[] = "Preencha a <b>descrição</b>";
if (empty($categoria_id)) $erros[] = "Selecione uma <b>categoria</b>";
if (empty($numero_serie)) $erros[] = "Preencha o <b>número de série/patrimônio</b>";
if (empty($situacao))     $erros[] = "Selecione a <b>situação</b>";

if (count($erros) == 0) {
    include("../include/conecta.php");

    if (!$con) {
        die("Erro de conexão: " . mysqli_connect_error());
    }

    if ($id_emprestimo > 0) {
        
        $sql = "UPDATE emprestimos SET 
                    nome_produto = '$nome_produto', 
                    descricao = '$descricao', 
                    categoria_id = $categoria_id, 
                    numero_serie = '$numero_serie', 
                    situacao = '$situacao'
                WHERE id = $id_emprestimo";
        $msg = "Produto atualizado com sucesso!";
    } else {
        $sql = "INSERT INTO emprestimos (nome_produto, descricao, categoria_id, numero_serie, situacao) 
                VALUES ('$nome_produto', '$descricao', $categoria_id, '$numero_serie', '$situacao')";
        $msg = "Produto cadastrado com sucesso!";
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
