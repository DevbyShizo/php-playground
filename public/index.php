<?php

require __DIR__ . '/vendor/autoload.php';

use App\Produto;
use App\Carrinho;
use App\Usuario;

$p1 = new Produto("Arroz", 7.99);
$p2 = new Produto("Feijão", 8.50);
$p3 = new Produto("Macarrão", 5.20);

$carrinho = new Carrinho();

$carrinho->adicionarProduto($p1);
$carrinho->adicionarProduto($p2);
$carrinho->adicionarProduto($p3);

$carrinho->exibirProdutos();

$carrinho->removerProduto($p2);

$carrinho->exibirProdutos();

$carrinho->calcularTotal();
