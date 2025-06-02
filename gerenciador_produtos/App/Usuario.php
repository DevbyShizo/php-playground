<?php

namespace App;

class Usuario
{
    public string $nome;
    public string $email;

    public function __construct(string $nome, string $email)
    {
        $this->nome = $nome;
        $this->email = $email;
    }

    public function exibir(): void
    {
        echo "Nome do usuário: {$this->nome} \n<br> Email do usuário: {$this->email} \n<br>";
    }
}
