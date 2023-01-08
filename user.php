<?php

class User {
  private $id;
  public $login;
  public $email;
  public $firstname;
  public $lastname;
  private $isConnected;

  public function __construct() {
    $this->id = 0;
    $this->login = '';
    $this->email = '';
    $this->firstname = '';
    $this->lastname = '';
  }

  public function register($login, $password, $email, $firstname, $lastname) {
   
        // Connexion à la base de données
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
    var_dump($mysqli );
        // Préparation de la requête d'insertion
        $stmt = $mysqli->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $login, $password, $email, $firstname, $lastname);
    
        // Exécution de la requête
        $stmt->execute();
    
        // Récupération de l'ID de l'utilisateur créé
        $id = $mysqli->insert_id;
    
        // Mise à jour des attributs de l'objet avec les valeurs de l'utilisateur créé
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    
        // Fermeture de la requête et de la connexion à la base de données
        $stmt->close();
        $mysqli->close();

    return array(
      'id' => $this->id,
      'login' => $this->login,
      'email' => $this->email,
      'firstname' => $this->firstname,
      'lastname' => $this->lastname
    );
  }

  public function connect($login, $password) {
    // Code de connexion de l'utilisateur en base de données

    // Mettre à jour les attributs de l'objet avec les valeurs de l'utilisateur connecté
    $this->id = $id;
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->isConnected = true;
  }

  public function disconnect() {
    // Code de déconnexion de l'utilisateur en base de données
    $this->isConnected = false;
  }

  public function delete() {
    // Code de suppression de l'utilisateur en base de données
    $this->disconnect();
  }

  public function update($login, $password, $email, $firstname, $lastname) {
    // Code de mise à jour de l'utilisateur en base de données

    // Mettre à jour les attributs de l'objet avec les nouvelles valeurs
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }

  public function isConnected() {
    return $this->isConnected;
  }

  // Attributs et méthodes existants...

  public function getAllInfos() {
    return array(
      'id' => $this->id,
      'login' => $this->login,
      'email' => $this->email,
      'firstname' => $this->firstname,
      'lastname' => $this->lastname
    );
  }

  public function getLogin() {
    return $this->login;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getFirstname() {
    return $this->firstname;
  }

  public function getLastname() {
    return $this->lastname;
  }

}

$user = new User();

// Test de la méthode register avec des données de test
$infos = $user->register('test', 'test', 'test@example.com', 'Test', 'User');

// Affichage des informations de l'utilisateur créé
print_r($infos);

?>