<?php

// App/Carrinho.php
namespace App;

class Carrinho
{
    private array $produtos = [];

    public function adicionarProduto(Produto $produto): string
    {
        $this->produtos[] = $produto;
        return "Produto: {$produto->getNome()} - R$ " .
            number_format($produto->getPreco(), 2, ',', '.') . " adicionado com sucesso!";
    }

    public function removerProduto(string $produtoId): string
    {
        foreach ($this->produtos as $index => $produto) {
            if ($produto->getId() === $produtoId) {
                $nomeProduto = $produto->getNome();
                unset($this->produtos[$index]);
                $this->produtos = array_values($this->produtos);
                return "Produto: {$nomeProduto} removido com sucesso!";
            }
        }
        return "Produto não encontrado no carrinho.";
    }

    public function calcularTotal(): float
    {
        return array_reduce($this->produtos, function ($total, $produto) {
            return $total + $produto->getPreco();
        }, 0);
    }

    public function getProdutos(): array
    {
        return $this->produtos;
    }

    public function getTotalFormatado(): string
    {
        return "R$ " . number_format($this->calcularTotal(), 2, ',', '.');
    }

    public function isEmpty(): bool
    {
        return empty($this->produtos);
    }

    public function getQuantidadeItens(): int
    {
        return count($this->produtos);
    }
}
