<?php
require_once 'classes/Cep.php';
require_once 'classes/ApiViaCep.php';
require_once 'classes/ExibirDados.php';

use Classes\Cep;
use Classes\Api;
use Classes\ExibirDados;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['consultar'])) {
    if (isset($_POST['cep'])) {
        $cep = preg_replace('/\D/', '', $_POST['cep']);

        $validador = new Cep($cep);
        if ($validador->validaCep()) {
            $api = new Api();
            $dados = $api->consultarCep($cep);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

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
        <div>

        </div>
        <form method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="cep" class="form-control" placeholder="Digite o CEP" required>
                <button class="btn btn-primary" type="submit" name="consultar"><i class="fas fa-search"></i> Consultar</button>
            </div>
        </form>
        <div class="resultados">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['consultar'])) {
                if (isset($dados) && is_array($dados)) {
                    $exibir = new ExibirDados();
                    $exibir->exibirDados($dados);
                } else {
                    echo "<p>Nenhum dado encontrado para o CEP informado.</p>";
                }
            }
            ?>
        </div>

    </div>


</body>

</html>