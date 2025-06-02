<?php

namespace Classes;

class Cep
{
    public string $cep;

    public function __construct($cep)
    {
        $this->cep = $cep;
    }

    public function validaCep(): bool
    {
        return strlen($this->cep) === 8;
    }
}
