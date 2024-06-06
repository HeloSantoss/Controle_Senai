<!-- register.php -->

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="register-container">
        <div class="register-box">
            <h2>Registrar</h2>
            <?php
            // Verifica se o formulário foi submetido
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verifica se os campos de nome, email e senha estão definidos
                if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
                    // Aqui você pode adicionar código para validar os dados do formulário
                    // Por exemplo, verificar se o email é único, se a senha tem o formato adequado, etc.
                    
                    // Após validar os dados, você pode inseri-los no banco de dados
                    // Por exemplo, usando uma consulta SQL INSERT
                    
                    // Exemplo simples de inserção usando PDO (substitua com os detalhes do seu banco de dados)
                    /*
                    try {
                        $pdo = new PDO("mysql:host=localhost;dbname=seu_banco_de_dados", "seu_usuario", "sua_senha");
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
                        $stmt = $pdo->prepare($sql);
                        
                        $stmt->bindParam(':nome', $_POST["name"]);
                        $stmt->bindParam(':email', $_POST["email"]);
                        $stmt->bindParam(':senha', $_POST["password"]);
                        
                        $stmt->execute();
                        
                        echo "<p class='success-message'>Registro bem-sucedido. Faça login <a href='login.php'>aqui</a>.</p>";
                    } catch (PDOException $e) {
                        echo "<p class='error-message'>Erro ao registrar: " . $e->getMessage() . "</p>";
                    }
                    */
                    // Lembre-se de substituir 'seu_banco_de_dados', 'seu_usuario' e 'sua_senha' com as informações reais do seu banco de dados
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="input-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Registrar</button>
                <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
            </form>
            <button class="btn-back" onclick="history.back()">Voltar</button>
        </div>
    </div>
</body>
</html>
