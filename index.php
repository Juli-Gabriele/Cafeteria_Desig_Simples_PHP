<?php
require 'conexao.php';
$conexao = new Conexao();
$pdo = $conexao->conectar();
$sql = "SELECT p.*, c.nome AS categoria
        FROM produtos p
        JOIN categorias c ON c.id = p.categoria_id
        WHERE p.ativo = 1";

if (isset($_GET['categoria'])) {
    $sql .= " AND p.categoria_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_GET['categoria']]);
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $produtos = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Café & Grão</title>
</head>

<body>

    <header class="header">
        <div class="topo">
            <p style="color:white; font-size: 13px;">Frete grátis para compras acima de R$ 150,00</p>
        </div>
        <section>

            <h2 class="logo">Café <span>&</span> Grão</h2>

            <nav class="navbar">
                <a href="index.php">Início</a>
                <a href="?categoria=1#produtos">Cafés</a>
                <a href="?categoria=2#produtos">Acessórios</a>
                <a href="index.php#sobre">Sobre</a>
                <a href="index.php#contato">Contato</a>
            </nav>

            <button>Carrinho (0)</button>
        </section>
    </header>

    <section id="home">
        <div class="home-container">

            <div class="home-texto">
                <p id="rotulo">Colheita 2026</p>
                <h1 style="color:#36251A;">Café fresco, torrado toda semana.</h1>
                <br>
                <p class="descricao">Grãos especiais de pequenos produtores brasileiros, direto da torra para a sua xícara.</p>

                <a href="#produtos" id="btn">Ver produtos</a>
            </div>

            <img id="coffe" src="./imagens/hero.svg" alt="Xícara de café">

        </div>
    </section>

    </div>
    <section id="produtos">
        <div class="produtos-topo">
            <h2>Nossos produtos</h2>
            <p>Selecionados por quem entende de café</p>

            <div class="filtros">
                <div class="filtros">
                    <a href="index.php#produtos" class="<?= isset($_GET['categoria']) ? '' : 'ativo' ?>">Todos</a>
                    <a href="?categoria=1#produtos" class="<?= ($_GET['categoria'] ?? '') == 1 ? 'ativo' : '' ?>">Cafés</a>
                    <a href="?categoria=2#produtos" class="<?= ($_GET['categoria'] ?? '') == 2 ? 'ativo' : '' ?>">Acessórios</a>
                    <a href="?categoria=3#produtos" class="<?= ($_GET['categoria'] ?? '') == 3 ? 'ativo' : '' ?>">Kits</a>
                </div>
            </div>
        </div>
    </section>

    <div class="grid">
        <?php foreach ($produtos as $produto) : ?>
            <div class="produto">
                <?php if ($produto['preco_promocional']): ?>
                    <span class="selo promo">Promoção</span>
                <?php elseif ($produto['novo'] == 1): ?>
                    <span class="selo">Novo</span>
                <?php endif; ?>
                <img src="imagens/<?php echo $produto['imagem']; ?>">
                <p style="color: #BE5E1B; font-size: 15px; font-family: Arial, Helvetica, sans-serif;text-transform: uppercase;"><?php echo $produto['categoria']; ?></p>
                <h3><?php echo $produto['nome']; ?></h3>
                <p><?php echo $produto['descricao']; ?></p>
                <p>Preço: R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></p>
                <button>Adicionar ao carrinho</button>
            </div>
        <?php endforeach; ?>
    </div>

        <footer class="footer">
    <div class="footer-container">
        <div id="sobre">
            <h3 class="footer-logo">Café <span>&</span> Grão</h3>
            <p>Cafés especiais e acessórios para quem leva o preparo a sério. Torrado em pequenos lotes, enviado para todo o Brasil.</p>
        </div>

        <div>
            <h3>Categorias</h3>
            <p>Cafés</p>
            <p>Acessórios</p>
            <p>Kits</p>
        </div>

        <div id="contato">
            <h3>Contato</h3>
            <p>contato@cafeegrao.com.br</p>
            <p>(34) 99999-0000</p>
            <p>Seg a Sex, 8h às 18h</p>
        </div>
    </div>

    <p class="finalzin">© 2026 Café & Grão. Projeto fictício para fins didáticos.</p>
</footer>

</body>

</html>