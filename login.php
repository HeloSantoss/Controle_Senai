<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <?php
            // Verifica se o formulário foi submetido
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Verifica se os campos de email e senha estão definidos
                if (isset($_POST["email"]) && isset($_POST["password"])) {
                    // Aqui você pode adicionar código para validar as credenciais do usuário
                    // Por exemplo, você pode consultar um banco de dados para verificar se o usuário existe e se a senha está correta
                    // Se as credenciais estiverem corretas, você pode redirecionar o usuário para a página de destino usando header()
                    // Por exemplo: header("Location: dashboard.php");
                    // Substitua "dashboard.php" pela página para a qual você deseja redirecionar o usuário após o login
                    // Se as credenciais estiverem incorretas, você pode exibir uma mensagem de erro
                    echo "<p class='error-message'>Credenciais inválidas. Tente novamente.</p>";
                }
            }
            ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Entrar</button>
                <p>Não tem uma conta? <a href="register.php">Registre-se</a></p>
            </form>
            <button class="btn-back" onclick="history.back()">Voltar</button>
        </div>
    </div>
</body>
</html>
