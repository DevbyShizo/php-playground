<?php

namespace App;

class Produto
{
    private string $nome;
    private float $preco;
    private string $id;

    public function __construct(string $nome, float $preco)
    {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->id = uniqid(); // ID único para comparação
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function exibir(): string
    {
        return "Produto: {$this->nome} - R$ " . number_format($this->preco, 2, ',', '.');
    }
}
