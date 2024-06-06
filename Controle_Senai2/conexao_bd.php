<!-- conexao_bd.php -->

<!-- <?php
// Configurações do banco de dados
$db_host = "localhost"; // Host do banco de dados
$db_name = "controle_escola"; // Nome do banco de dados
$db_user = "postgres"; // Nome de usuário do banco de dados
$db_password = "postgres"; // Senha do banco de dados -->

try {
    // Conectar ao banco de dados
    $conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para buscar os itens do almoxarifado
    $stmt = $conn->query("SELECT * FROM cadastro_itens");
    $itens_almoxarifado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retornar os itens do almoxarifado
    echo json_encode($itens_almoxarifado);
} catch (PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
}
?>


<?php
// Configurações do banco de dados
$db_host = "localhost"; // Host do banco de dados
$db_name = "controle_escola"; // Nome do banco de dados
$db_user = "postgres"; // Nome de usuário do banco de dados
$db_password = "postgres"; // Senha do banco de dados

// Conectar ao banco de dados
$conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Verificar se o formulário de cadastro de itens foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos estão preenchidos
    if (!empty($_POST['item-name']) && !empty($_POST['item-quantity'])) {
        // Preparar a declaração SQL para inserção de um novo item
        $stmt = $conn->prepare("INSERT INTO cadastro_itens (nome, quantidade) VALUES (:nome, :quantidade)");
        $stmt->bindParam(':nome', $_POST['item-name']);
        $stmt->bindParam(':quantidade', $_POST['item-quantity']);

        // Executar a declaração SQL
        $stmt->execute();

        // Redirecionar de volta para a página de estoque após a inserção
        header("Location: index.php");
        exit();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
