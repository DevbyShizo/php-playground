<?php

namespace Classes;


class ExibirDados
{
    function exibirDados($dados): void
    {
        if (is_array($dados) && !empty($dados)) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Dados do CEP: {$dados['cep']}</h5>";
            echo "<p class='card-text'>Logradouro: {$dados['logradouro']}</p>";
            echo "<p class='card-text'>Bairro: {$dados['bairro']}</p>";
            echo "<p class='card-text'>Cidade: {$dados['localidade']}</p>";
            echo "<p class='card-text'>Estado: {$dados['uf']}</p>";
            if (isset($dados['complemento']) && !empty($dados['complemento'])) {
                echo "<p class='card-text'>Complemento: {$dados['complemento']}</p>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>Nenhum dado encontrado para o CEP informado.</p>";
        }
    }
}
