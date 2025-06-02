<?php
require __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Produto;
use App\Carrinho;
use App\ProdutoRepository;


function getCarrinho(): Carrinho
{
    if (isset($_SESSION['carrinho']) && is_string($_SESSION['carrinho'])) {
        $carrinho = unserialize($_SESSION['carrinho']);
        return $carrinho instanceof Carrinho ? $carrinho : new Carrinho();
    }
    return new Carrinho();
}

function salvarCarrinho(Carrinho $carrinho): void
{
    $_SESSION['carrinho'] = serialize($carrinho);
}

function sanitizeInput(string $input): string
{
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}


$carrinho = getCarrinho();
$listaDeProdutos = ProdutoRepository::getTodos();
$mensagem = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['adicionar_produto'])) {
        $indice = filter_input(INPUT_POST, 'produto', FILTER_VALIDATE_INT);

        if ($indice !== false && $indice !== null) {
            $produtoData = ProdutoRepository::getPorIndice($indice);

            if ($produtoData) {
                $produto = new Produto($produtoData['nome'], $produtoData['preco']);
                $mensagem = $carrinho->adicionarProduto($produto);
            } else {
                $mensagem = "Produto não encontrado.";
            }
        } else {
            $mensagem = "Seleção inválida.";
        }
    } elseif (isset($_POST['remover_produto'])) {
        $produtoId = sanitizeInput($_POST['produto_id']);
        $mensagem = $carrinho->removerProduto($produtoId);
    } elseif (isset($_POST['limpar_carrinho'])) {
        $carrinho = new Carrinho();
        $mensagem = "Carrinho limpo com sucesso!";
    }

    salvarCarrinho($carrinho);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Produtos</title>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body>
    <h1>🛒 Gerenciador de Produtos</h1>

    <?php if ($mensagem): ?>
        <div class="mensagem"><?= sanitizeInput($mensagem) ?></div>
    <?php endif; ?>

    <div class="container">
        <h2>Adicionar Produto</h2>
        <form method="post">
            <div class="form-group">
                <label for="produto">Selecione um produto:</label>
                <select name="produto" id="produto" required>
                    <option value="">-- Escolha um produto --</option>
                    <?php foreach ($listaDeProdutos as $index => $produto): ?>
                        <option value="<?= $index ?>">
                            <?= sanitizeInput($produto["nome"]) ?> -
                            R$ <?= number_format($produto["preco"], 2, ',', '.') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="adicionar_produto">Adicionar ao Carrinho</button>
        </form>
    </div>

    <div class="container">
        <h2>Carrinho de Compras (<?= $carrinho->getQuantidadeItens() ?> itens)</h2>

        <?php if ($carrinho->isEmpty()): ?>
            <p class="carrinho-vazio">Seu carrinho está vazio</p>
        <?php else: ?>
            <?php foreach ($carrinho->getProdutos() as $produto): ?>
                <div class="produto-item">
                    <span><?= $produto->exibir() ?></span>
                    <form method="post" style="display: inline;">
                        <input type="hidden" name="produto_id" value="<?= $produto->getId() ?>">
                        <button type="submit" name="remover_produto" class="btn-danger">Remover</button>
                    </form>
                </div>
            <?php endforeach; ?>

            <div class="total">
                Total: <?= $carrinho->getTotalFormatado() ?>
            </div>

            <form method="post" style="margin-top: 20px;">
                <button type="submit" name="limpar_carrinho" class="btn-warning"
                    onclick="return confirm('Tem certeza que deseja limpar o carrinho?')">
                    Limpar Carrinho
                </button>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>