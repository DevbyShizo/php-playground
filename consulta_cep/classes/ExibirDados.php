<?php

namespace Classes;

class ExibirDados
{
    function exibirDados($dados): void
    {
        if (is_array($dados) && !empty($dados)) {
            echo "<div class='card'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>Dados do CEP: " . ($dados['cep'] ?? 'Não informado') . "</h5>";
            echo "<p class='card-text'>Logradouro: " . ($dados['logradouro'] ?? 'Não informado') . "</p>";
            echo "<p class='card-text'>Bairro: " . ($dados['bairro'] ?? 'Não informado') . "</p>";
            echo "<p class='card-text'>Cidade: " . ($dados['localidade'] ?? 'Não informado') . "</p>";
            echo "<p class='card-text'>Estado: " . ($dados['uf'] ?? 'Não informado') . "</p>";

            if (!empty($dados['complemento'])) {
                echo "<p class='card-text'>Complemento: {$dados['complemento']}</p>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>Nenhum dado encontrado para o CEP informado.</p>";
        }
    }
}
