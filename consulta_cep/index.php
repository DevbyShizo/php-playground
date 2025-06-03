<?php
require_once 'classes/Cep.php';
require_once 'classes/ApiViaCep.php';
require_once 'classes/ExibirDados.php';

use Classes\Cep;
use Classes\Api;
use Classes\ExibirDados;

$dados = null;
$dadosEndereco = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['consultar']) && isset($_POST['cep'])) {
        $cep = preg_replace('/\D/', '', $_POST['cep']);

        $validador = new Cep($cep);
        if ($validador->validaCep()) {
            $api = new Api();
            $dados = $api->consultarCep($cep);
        }
    }

    if (
        isset($_POST['buscarEndereco']) &&
        isset($_POST['uf']) &&
        isset($_POST['cidade']) &&
        isset($_POST['logradouro'])
    ) {
        $uf = trim($_POST['uf']);
        $cidade = trim($_POST['cidade']);
        $logradouro = trim($_POST['logradouro']);

        if (!empty($uf) && !empty($cidade) && !empty($logradouro)) {
            $api = new Api();
            $dadosEndereco = $api->buscarPorEndereco($uf, $cidade, $logradouro);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta CEP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4"> 🗺️ Consulta CEP</h1>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Buscar por CEP</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="input-group">
                        <input type="text" name="cep" class="form-control" placeholder="Digite o CEP (ex: 01234-567)" required>
                        <button class="btn btn-primary" type="submit" name="consultar">
                            <i class="fas fa-search"></i> Consultar CEP
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['consultar'])): ?>
            <div class="resultados mb-4">
                <?php
                if ($dados && is_array($dados)) {
                    $exibir = new ExibirDados();
                    $exibir->exibirDados($dados);
                } else {
                    echo "<div class='alert alert-warning'>Nenhum dado encontrado para o CEP informado.</div>";
                }
                ?>
            </div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-header">
                <h5>Buscar por Endereço</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="uf" class="form-label">Estado (UF):</label>
                            <input type="text" name="uf" id="uf" class="form-control" placeholder="Ex: SP" maxlength="2" required>
                        </div>
                        <div class="col-md-5">
                            <label for="cidade" class="form-label">Cidade:</label>
                            <input type="text" name="cidade" id="cidade" class="form-control" placeholder="Ex: São Paulo" required>
                        </div>
                        <div class="col-md-5">
                            <label for="logradouro" class="form-label">Logradouro:</label>
                            <input type="text" name="logradouro" id="logradouro" class="form-control" placeholder="Ex: Rua das Flores" required>
                        </div>
                    </div>
                    <button class="btn btn-secondary mt-3" type="submit" name="buscarEndereco">
                        <i class="fas fa-search"></i> Buscar Endereço
                    </button>
                </form>
            </div>
        </div>

        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buscarEndereco'])): ?>
            <div class="resultados">
                <?php
                if ($dadosEndereco && is_array($dadosEndereco) && count($dadosEndereco) > 0) {
                    echo "<h5>Endereços encontrados:</h5>";
                    foreach ($dadosEndereco as $endereco) {
                        $exibir = new ExibirDados();
                        $exibir->exibirDados($endereco);
                        echo "<br>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>Nenhum endereço encontrado para os dados informados.</div>";
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>