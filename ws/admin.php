<?php
require 'vendor/autoload.php';
require 'db.php';

Flight::route('POST /admin/login', function() {
    $data = Flight::request()->data;
    $nom = $data->nom;
    $mdp = $data->mdp;

    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM etablissement_financiere WHERE nom = ? AND mdp = ?");
    $stmt->execute([$nom, $mdp]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        Flight::halt(401, json_encode(['message' => 'Identifiants incorrects']));
    }

    // Réponse réussie (NE JAMAIS ENVOYER LE MDP EN RÉPONSE !)
    Flight::json([
        'message' => 'Connexion admin réussie',
        'admin' => [
            'id_etablissement' => $admin['id_etablissement'],
            'nom' => $admin['nom']
        ]
    ]);
});


Flight::start();
?>