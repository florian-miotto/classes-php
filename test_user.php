<?php

require_once 'User.php';

// Création d'un nouvel utilisateur
$user = new User();

// Enregistrement d'un nouvel utilisateur
$result = $user->register('john_doe', 'mypassword', 'john.doe@example.com', 'John', 'Doe');
if ($result) {
    echo "Utilisateur enregistré avec succès: \n";
    print_r($result);
} else {
    echo "Erreur lors de l'enregistrement de l'utilisateur.\n";
}

// Connexion de l'utilisateur
$user->connect('john_doe', 'mypassword');

// Récupération de toutes les informations de l'utilisateur
$infos = $user->getAllInfos();
if ($infos) {
    echo "Informations de l'utilisateur: \n";
    print_r($infos);
} else {
    echo "Erreur lors de la récupération des informations de l'utilisateur.\n";
}

// Déconnexion de l'utilisateur
$user->disconnect();

// Mettre à jour les informations de l'utilisateur (nécessite une connexion)
$user->connect('john_doe', 'mypassword');
$user->update('john_doe_updated', 'new_password', 'john.doe_updated@example.com', 'John', 'Doe Updated');
$user->disconnect();

// Suppression de l'utilisateur (nécessite une connexion)
$user->connect('john_doe_updated', 'new_password');
$user->delete();

?>
