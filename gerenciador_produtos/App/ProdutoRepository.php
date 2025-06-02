<?php

namespace App;

class ProdutoRepository
{
    public static function getTodos(): array
    {
        return [
            ["nome" => "Arroz", "preco" => 7.99],
            ["nome" => "Feijão", "preco" => 8.50],
            ["nome" => "Macarrão", "preco" => 5.20],
            ["nome" => "Açúcar", "preco" => 4.75],
            ["nome" => "Óleo", "preco" => 6.30]
        ];
    }

    public static function getPorIndice(int $indice): ?array
    {
        $produtos = self::getTodos();
        return $produtos[$indice] ?? null;
    }
}
