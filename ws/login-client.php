<?php

Flight::route('POST /login-client',function() {
    $data = Flight::request()->data;
    $db = getDB();
    $stmt = $db->query("SELECT * FROM client WHERE prenom = ? AND mdp = ?");

});