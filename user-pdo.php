<?php


class Userpdo {
  private $id;
  public $login;
  public $email;
  public $firstname;
  public $lastname;

  public function __construct() {
    // Initialisation des attributs de l'objet
  }

  public function register($login, $password, $email, $firstname, $lastname) {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');

    // Création de l'utilisateur en base de données
    $query = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (:login, :password, :email, :firstname, :lastname)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->execute();

    // Récupération de l'ID de l'utilisateur créé
    $this->id = $pdo->lastInsertId();

    // Récupération de toutes les informations de l'utilisateur
    $query = "SELECT * FROM utilisateurs WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fermeture de la connexion à la base de données
    $pdo = null;

    return $row;
  }

  public function connect($login, $password) {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');

    // Récupération de l'utilisateur en base de données
    $query = "SELECT * FROM utilisateurs WHERE login = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fermeture de la connexion à la base de donné
  }
}
  ?>