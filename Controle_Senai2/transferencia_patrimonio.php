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
        $patrimonio_id = $_POST["transfer-patrimonio-id"];
        $nova_sala_id = $_POST["sala-destination-id"];

        $sql = "UPDATE patrimonio SET sala_id = :nova_sala_id WHERE id = :patrimonio_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':patrimonio_id', $patrimonio_id);
        $stmt->bindParam(':nova_sala_id', $nova_sala_id);

        $stmt->execute();

        echo "Patrimônio transferido com sucesso!";
    }
} catch (PDOException $e) {
    echo "Erro ao transferir patrimônio: " . $e->getMessage();
}
?>
