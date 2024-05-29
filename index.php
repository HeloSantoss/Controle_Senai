<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header class="shadow">
        <div class="nav container">
            <h1 class="logo">Senai<span>505</span></h1>
            <nav class="navbar">
                <a href="#home" class="nav-link">Home</a>
                <a href="#estoque" class="nav-link">Estoque</a>
                <a href="#transferencia" class="nav-link">Transferência</a>
                <a href="#almoxarifado" class="nav-link">Almoxarifado</a>
                <a href="#blocos" class="nav-link">Blocos</a>
            </nav>
            <a href="login.php" class="btn btn-login">Login</a>
            <div id="menu-icon">&#9776;</div>
        </div>
    </header>
    
    <section class="home container" id="home">
        <div class="home-text">
            <h1>Bem-vindo ao Sistema Escolar</h1>
            <p>Gerencie seus recursos e espaços de forma eficiente.</p>
        </div>
    </section>
  
    <section class="estoque container" id="estoque">
        <div class="heading">
            <span>Gerenciamento</span>
            <h2>Cadastro de Itens</h2>  
        </div>
        <form action="conexao_bd.php" method="POST" class="estoque-form">
            <input type="text" id="item-name" name="item-name" placeholder="Nome do Item">
            <input type="number" id="item-quantity" name="item-quantity" placeholder="Quantidade">
            <button type="submit" class="btn">Adicionar Item</button>
        </form>

        <div class="estoque-list">
            <h3>Itens em Estoque</h3>
            <ul id="item-list"></ul>
        </div>
    </section>
    <br><br><br><br>
    <section class="transferencia container" id="transferencia">
        <div class="heading">
            <span>Movimentação</span>
            <h2>Solicitação de Itens</h2>
        </div>
        <div class="transferencia-form">
            <input type="text" id="transfer-item-name" placeholder="Nome do Item">
            <input type="number" id="transfer-quantity" placeholder="Quantidade">
            <input type="text" id="destination" placeholder="Destino">
            <button class="btn" onclick="transferirItem()">Transferir Item</button>
        </div>
    </section>
    <br><br><br><br>
    <section class="almoxarifado container" id="almoxarifado">
        <div class="heading">
            <span>Depósito</span>
            <h2>Almoxarifado</h2>
        </div>
        <div class="almoxarifado-list">
            <h3>Itens no Almoxarifado</h3>
            <ul id="almoxarifado-list">
                <?php
                // Conectar ao banco de dados
                $db_host = "localhost"; // Host do banco de dados
                $db_name = "controle_escola"; // Nome do banco de dados
                $db_user = "postgres"; // Nome de usuário do banco de dados
                $db_password = "postgres"; // Senha do banco de dados

                $conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Consulta para selecionar todos os itens do almoxarifado
                $stmt = $conn->query("SELECT nome, quantidade FROM cadastro_itens");
                while ($row = $stmt->fetch()) {
                    echo "<li>{$row['nome']} - Quantidade: {$row['quantidade']}</li>";
                }
                ?>
            </ul>
        </div>
    </section>
<br><br><br><br>
    <section class="blocos container" id="blocos">
        <div class="heading">
            <span>Estrutura</span>
            <h2>Cadastro de Blocos e Salas</h2>
        </div>
        <div class="bloco-form">
            <select id="bloco-select">
                <option value="A">Bloco A</option>
                <option value="B">Bloco B</option>
                <option value="C">Bloco C</option>
                <option value="D">Bloco D</option>
            </select>
            <input type="text" id="sala-name" placeholder="Nome da Sala">
            <button class="btn" onclick="adicionarSala()">Adicionar Sala</button>
        </div>
        <div class="bloco-list">
            <div id="blocoA">
                <h3>Bloco A</h3>
                <ul></ul>
            </div>
            <div id="blocoB">
                <h3>Bloco B</h3>
                <ul></ul>
            </div>
            <div id="blocoC">
                <h3>Bloco C</h3>
                <ul></ul>
            </div>
            <div id="blocoD">
                <h3>Bloco D</h3>
                <ul></ul>
            </div>
        </div>
    </section>
<br><br><br>
    <footer class="footer">
        <div class="footer-container container">
            <div class="footer-box">
                <h3>Contato</h3>
                <p>Email: contato@escolaadmin.com</p>
                <p>Telefone: (19) 1234-5678</p>
            </div>
        </div>
    </footer>
    
    <script src="script.js"></script>
</body>
</html>
