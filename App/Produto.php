<?php

namespace App;

class Produto
{
    public string $nome;
    public float $preco;

    public function __construct(string $nome, float $preco)
    {
        $this->nome = $nome;
        $this->preco = $preco;
    }

    public function exibir(): void
    {
        echo "Produto: {$this->nome} - {$this->preco}R$\n <br>";
    }
}
//teste
$product = new Produto("Arroz 3 Corações", 7.99);
$product->exibir();
