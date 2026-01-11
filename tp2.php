<?php
$file = 'pers.json';

// 1. Initialisation : Charger les données existantes du fichier JSON
if (file_exists($file)) {
    $jsonContent = file_get_contents($file);
    $tablePersonne = json_decode($jsonContent, true) ?? [];
} else {
    $tablePersonne = [];
}

// 2. Traitement du formulaire : Ajouter une personne
if (isset($_POST['enreg'])) {
    $personne = [
        'prenom' => $_POST['prenom'],
        'nom'    => $_POST['nom'],
        'adr'    => $_POST['adr'],
        'tel'    => $_POST['tel']
    ];

    $tablePersonne[] = $personne; // Ajouter au tableau
    file_put_contents($file, json_encode($tablePersonne, JSON_PRETTY_PRINT)); // Sauvegarder
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TP2 Form & Table</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <h1 class="text-center text-primary mt-3">TP Form & Table</h1>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <form method="post">
                        <div class="card-header">Ajout Personne</div>
                        <div class="card-body">
                            <div class="mb-2">
                                <label>Prénom</label>
                                <input class="form-control" type="text" name="prenom" required>
                            </div>
                            <div class="mb-2">
                                <label>Nom</label>
                                <input class="form-control" type="text" name="nom" required>
                            </div>
                            <div class="mb-2">
                                <label>Adresse</label>
                                <input class="form-control" type="text" name="adr" required>
                            </div>
                            <div class="mb-2">
                                <label>Téléphone</label>
                                <input class="form-control" type="text" name="tel" required>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-primary w-100" name="enreg">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste des personnes</div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Prénom</th>
                                    <th>Nom</th>
                                    <th>Adresse</th>
                                    <th>Téléphone</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tablePersonne as $index => $p): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($p['prenom']) ?></td>
                                        <td><?= htmlspecialchars($p['nom']) ?></td>
                                        <td><?= htmlspecialchars($p['adr']) ?></td>
                                        <td><?= htmlspecialchars($p['tel']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>