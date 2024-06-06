<?php
// Conectar ao banco de dados
$db_host = "localhost";
$db_name = "controle_escola";
$db_user = "postgres";
$db_password = "postgres";

try {
    $conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["patrimonio-name"];
        $descricao = $_POST["patrimonio-descricao"];
        $valor = $_POST["patrimonio-valor"];
        $data_aquisicao = $_POST["patrimonio-data-aquisicao"];
        $localizacao = $_POST["patrimonio-localizacao"];
        $estado = $_POST["patrimonio-estado"];

        $sql = "INSERT INTO patrimonio (nome, descricao, valor, data_aquisicao, localizacao, estado) 
                VALUES (:nome, :descricao, :valor, :data_aquisicao, :localizacao, :estado)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':data_aquisicao', $data_aquisicao);
        $stmt->bindParam(':localizacao', $localizacao);
        $stmt->bindParam(':estado', $estado);

        $stmt->execute();

        echo "Patrimônio cadastrado com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro ao cadastrar patrimônio: " . $e->getMessage();
}
?>
