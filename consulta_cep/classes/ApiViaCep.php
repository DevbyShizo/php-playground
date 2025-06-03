<?php

namespace Classes;

class Api
{
    public function consultarCep($cep): array|false
    {
        try {
            $response = file_get_contents("https://viacep.com.br/ws/{$cep}/json/");

            if ($response === false) {
                return false;
            }

            $data = json_decode($response, true);

            if (isset($data['erro']) && $data['erro'] === true) {
                return false;
            }

            return $data;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function buscarPorEndereco($uf, $cidade, $logradouro): array|false
    {
        try {
            $uf = strtoupper(trim($uf));
            $cidade = rawurlencode(trim($cidade));
            $logradouro = rawurlencode(trim($logradouro));

            $url = "https://viacep.com.br/ws/{$uf}/{$cidade}/{$logradouro}/json/";

            $response = @file_get_contents($url);
            if ($response === false) {
                return false;
            }

            $data = json_decode($response, true);

            return (!empty($data) ? $data : false);
        } catch (\Exception $e) {
            return false;
        }
    }
}
