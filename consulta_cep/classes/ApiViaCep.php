<?php

namespace Classes;

class Api
{

    public function consultarCep($cep): array|false
    {
        $response = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");
        $data = json_decode($response, true);

        if (isset($data['erro']) && $data['erro'] === true) {
            return false;
        }

        return $data;
    }
}
