<?php

class User {
  private $id;
  public $login;
  public $email;
  public $firstname;
  public $lastname;
  private $isConnected;

  public function __construct() {
    $this->isConnected = false;
  }

  public function register($login, $password, $email, $firstname, $lastname) {
    // Code de création de l'utilisateur en base de données

    // Mettre à jour les attributs de l'objet avec les valeurs de l'utilisateur créé
    $this->id = $id;
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;

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



?>