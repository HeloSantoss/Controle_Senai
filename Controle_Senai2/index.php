<!-- index.php -->

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
            <!-- <h3>Itens em Estoque</h3> -->
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
        <select id="transfer-item-name" name="item-name" placeholder="Nome do Item">
            <?php
            // Conectar ao banco de dados
            $db_host = "localhost"; // Host do banco de dados
            $db_name = "controle_escola"; // Nome do banco de dados
            $db_user = "postgres"; // Nome de usuário do banco de dados
            $db_password = "postgres"; // Senha do banco de dados

            try {
                $conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Consulta para selecionar os itens cadastrados na tabela cadastro_itens
                $stmt = $conn->query("SELECT nome FROM cadastro_itens");
                $itens_cadastrados = $stmt->fetchAll(PDO::FETCH_COLUMN);

                // Exibir as opções do select
                foreach ($itens_cadastrados as $item) {
                    echo "<option value='$item'>$item</option>";
                }
            } catch (PDOException $e) {
                echo "Erro de conexão: " . $e->getMessage();
            }
            ?>
        </select>
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

    
    <section class="lista-patrimonio container" id="lista-patrimonio">
        <div class="heading">
            <span>Listagem</span>
            <h2>Itens de Patrimônio</h2>
        </div>
        <div class="patrimonio-list">
            <h3>Itens Cadastrados</h3>
            <ul id="patrimonio-list">
                <?php
                // Conectar ao banco de dados
                $db_host = "localhost";
                $db_name = "controle_escola";
                $db_user = "postgres";
                $db_password = "postgres";

                try {
                    $conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Consulta para selecionar todos os itens de patrimônio com suas salas e blocos
                    $stmt = $conn->query("SELECT patrimonio.nome, patrimonio.descricao, patrimonio.valor, patrimonio.data_aquisicao, patrimonio.estado, salas.nome AS sala_nome, blocos.nome AS bloco_nome FROM patrimonio INNER JOIN salas ON patrimonio.sala_id = salas.id INNER JOIN blocos ON salas.bloco_id = blocos.id ORDER BY blocos.nome, salas.nome, patrimonio.nome");
                    while ($row = $stmt->fetch()) {
                        echo "<li>{$row['nome']} - Descrição: {$row['descricao']} - Valor: R\${$row['valor']} - Data de Aquisição: {$row['data_aquisicao']} - Localização: Bloco {$row['bloco_nome']} - Sala {$row['sala_nome']} - Estado: {$row['estado']}</li>";
                    }
                } catch (PDOException $e) {
                    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                }
                ?>
            </ul>
        </div>
    </section>
    <section class="adicionar-patrimonio container" id="adicionar-patrimonio">
        <div class="heading">
            <span>Adicionar</span>
            <h2>Novo Patrimônio</h2>
        </div>
        <form action="adicionar_patrimonio.php" method="POST" class="patrimonio-form">
            <input type="text" id="patrimonio-name" name="patrimonio-name" placeholder="Nome do Patrimônio" required>
            <textarea id="patrimonio-descricao" name="patrimonio-descricao" placeholder="Descrição" required></textarea>
            <input type="number" step="0.01" id="patrimonio-valor" name="patrimonio-valor" placeholder="Valor" required>
            <input type="date" id="patrimonio-data-aquisicao" name="patrimonio-data-aquisicao" placeholder="Data de Aquisição" required>
            <select id="sala-select" name="sala-id" required>
                <option value="" disabled selected>Selecione a Sala</option>
                <?php
                // Conectar ao banco de dados
                $db_host = "localhost";
                $db_name = "controle_escola";
                $db_user = "postgres";
                $db_password = "postgres";

                try {
                    $conn = new PDO("pgsql:host=$db_host;dbname=$db_name", $db_user, $db_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Consulta para selecionar todas as salas
                    $stmt = $conn->query("SELECT salas.id, salas.nome AS sala_nome, blocos.nome AS bloco_nome FROM salas INNER JOIN blocos ON salas.bloco_id = blocos.id ORDER BY blocos.nome, salas.nome");
                    while ($row = $stmt->fetch()) {
                        echo "<option value='{$row['id']}'>{$row['bloco_nome']} - {$row['sala_nome']}</option>";
                    }
                } catch (PDOException $e) {
                    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
                }
                ?>
            </select>
            <input type="text" id="patrimonio-estado" name="patrimonio-estado" placeholder="Estado" required>
            <button type="submit" class="btn">Adicionar Patrimônio</button>
        </form>
    </section>
    <section class="transferencia-patrimonio container" id="transferencia-patrimonio">
        <div class="heading">
            <span>Movimentação</span>
            <h2>Transferência de Patrimônio</h2>
        </div>
        <form action="transferencia_patrimonio.php" method="POST" class="transferencia-form">
            <input type="text" id="transfer-patrimonio-name" name="transfer-patrimonio-name" placeholder="Nome do Patrimônio" required>
            <input type="text" id="transfer-patrimonio-destination" name="transfer-patrimonio-destination" placeholder="Novo Local" required>
            <button type="submit" class="btn">Transferir Patrimônio</button>
        </form>
    </section>
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