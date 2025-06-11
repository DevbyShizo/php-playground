<?php

$regions = ["Africa", "Americas", "Asia", "Europe", "Oceania"];

function filterByRegion($region)
{
    $url = "https://restcountries.com/v3.1/region/$region?fields=name,flags,region,capital,languages,population,coatOfArms,translations";
    $data = file_get_contents($url);
    return $data ? json_decode($data, true) : [];
}

function searchCountry($name)
{
    $url = "https://restcountries.com/v3.1/name/$name?fields=name,flags,region,capital,languages,population,coatOfArms,translations";
    $data = @file_get_contents($url);
    return $data ? json_decode($data, true) : [];
}


function showAllCountries()
{
    $url = "https://restcountries.com/v3.1/all?fields=name,flags,region,capital,languages,population,coatOfArms,translations";
    $data = file_get_contents($url);
    return $data ? json_decode($data, true) : [];
}

$results = [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['country']) && isset($_GET['submit'])) {
        $results = searchCountry($_GET['country']);
    } elseif (!empty($_GET['region'])) {
        $results = filterByRegion($_GET['region']);
    } else {
        $results = showAllCountries();
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Rest Countries API</title>
</head>

<body>
    <form class="container my-4" method="get">
        <div class="mb-3">
            <label for="country" class="form-label">Digite o nome do país</label>
            <input type="text" class="form-control" name="country">
        </div>

        <div class="mb-3">
            <label for="region" class="form-label">Filtrar por região</label>
            <select name="region" class="form-select" onchange="this.form.submit()">
                <option value="">Todas</option>
                <?php foreach ($regions as $region): ?>
                    <option value="<?= $region ?>" <?= ($_GET['region'] ?? '') === $region ? 'selected' : '' ?>>
                        <?= $region ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Buscar</button>
        <?php if (!empty($_GET['country']) || !empty($_GET['region'])): ?>
            <a href="?" class="btn btn-secondary ms-2">Voltar</a>
        <?php endif; ?>
    </form>


    <div class="showAllCountries">
        <div class="container">
            <div class="row">
                <?php foreach ($results as $country): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <?php
                                $nomePt = $country['translations']['por']['common'] ?? $country['name']['common'];
                                ?>
                                <h5 class="card-title"><?= htmlspecialchars($nomePt) ?></h5>
                                <img src="<?= htmlspecialchars($country['flags']['png']) ?>" class="img-fluid mb-2" alt="Bandeira">
                                <p><strong>Região:</strong> <?= htmlspecialchars($country['region']) ?></p>
                                <p><strong>Capital:</strong> <?= $country['capital'][0] ?></p>
                                <p><strong>Línguas:</strong> <?= htmlspecialchars(implode(", ", $country['languages'])) ?></p>
                                <p><strong>População:</strong> <?= number_format($country['population'], 2, ',', '.') ?></p>
                                <p><strong>Brasão:</strong><br>
                                    <?= !empty($country['coatOfArms']['png'])
                                        ? "<img src='" . htmlspecialchars($country['coatOfArms']['png']) . "' class='img-fluid mb-2'>"
                                        : "N/A" ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    </div>
</body>

</html>