<?php
// Configurações do banco de dados
$db_host = "localhost"; // Host do banco de dados
$db_name = "controle_escola"; // Nome do banco de dados
$db_user = "postgres"; // Nome de usuário do banco de dados
$db_password = "postgres"; // Senha do banco de dados

try {
    // Conectar ao banco de dados
    $conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Em caso de falha na conexão, retornar uma resposta de erro
    http_response_code(500);
    echo json_encode(array("message" => "Erro de conexão com o banco de dados: " . $e->getMessage()));
    exit();
}

// Verificar o método da requisição
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Consultar os itens do almoxarifado
        try {
            $stmt = $conn->query("SELECT * FROM cadastro_itens");
            $itens_almoxarifado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($itens_almoxarifado);
        } catch (PDOException $e) {
            // Em caso de erro na consulta, retornar uma resposta de erro
            http_response_code(500);
            echo json_encode(array("message" => "Erro ao buscar itens do almoxarifado: " . $e->getMessage()));
        }
        break;
    case 'POST':
        // Adicionar um novo item ao almoxarifado
        try {
            // Verificar se os campos estão preenchidos
            if (!empty($_POST['item-name']) && !empty($_POST['item-quantity'])) {
                // Preparar a declaração SQL para inserção de um novo item
                $stmt = $conn->prepare("INSERT INTO cadastro_itens (nome, quantidade) VALUES (:nome, :quantidade)");
                $stmt->bindParam(':nome', $_POST['item-name']);
                $stmt->bindParam(':quantidade', $_POST['item-quantity']);

                // Executar a declaração SQL
                $stmt->execute();

                // Retornar uma resposta de sucesso
                http_response_code(201);
                echo json_encode(array("message" => "Item adicionado com sucesso."));
            } else {
                // Em caso de campos em branco, retornar uma resposta de erro
                http_response_code(400);
                echo json_encode(array("message" => "Por favor, preencha todos os campos."));
            }
        } catch (PDOException $e) {
            // Em caso de erro na inserção, retornar uma resposta de erro
            http_response_code(500);
            echo json_encode(array("message" => "Erro ao adicionar item ao almoxarifado: " . $e->getMessage()));
        }
        break;
    default:
        // Se o método da requisição não for suportado, retornar uma resposta de erro
        http_response_code(405);
        echo json_encode(array("message" => "Método não suportado."));
}
?>
