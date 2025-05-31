<?php

namespace App;

class Carrinho
{
    private array $produtos = [];

    public function adicionarProduto(Produto $produto): void
    {
        $this->produtos[] = $produto;
        echo "Produto: {$produto->nome} - {$produto->preco} adicionado com sucesso!";
    }

    public function removerProduto(Produto $produto): void
    {
        for ($i = 0; $i < count($this->produtos); $i++) {
            if ($produto === $this->produtos[$i]) {
                echo "Produto: {$this->produtos[$i]->nome}, deletado!";
                unset($this->produtos[$i]);
                $this->produtos = array_values($this->produtos);
            }
        }
    }

    public function calcularTotal()
    {
        $total = 0;

        foreach ($this->produtos as $produto) {
            $total += $produto->preco;
        }
        echo "Total: {$total}R$";
    }

    public function exibirProdutos()
    {
        foreach ($this->produtos as $produto) {
            $produto->exibir();
        }
    }
}
