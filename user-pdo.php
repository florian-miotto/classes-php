<?php


class Userpdo {
  public $id;
  public $login;
  public $email;
  public $firstname;
  public $lastname;
  

  public function __construct() {
    $this->id = 0;
    $this->login = '';
    $this->email = '';
    $this->firstname = '';
    $this->lastname = '';
    
  }

  public function register($login, $password, $email, $firstname, $lastname) {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');

 

    // Création de l'utilisateur en base de données
    $query = "INSERT INTO utilisateurs (`login`, `password`, `email`, `firstname`, `lastname`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $password);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $firstname);
    $stmt->bindParam(5, $lastname);
    $stmt->execute();
    // Vérification si l'utilisateur existe déjà

    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
    $stmt->bindParam(1, $login);
    $stmt->execute();

    if ($stmt->rowCount()>0){

      echo "Utilisateur déjà existant";
    }
    else{
    echo "Utilisateur créé avec succès";
    //récupération de l'id de l'utilisateur créé
    $id = $pdo->lastInsertId();
    // Mise à jour des attributs de l'objet avec les valeurs de l'utilisateur créé
    $this->id = $id;
    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }
  return array(
    'id' => $this->id,
    'login' => $this->login,
    'email' => $this->email,
    'firstname' => $this->firstname,
    'lastname' => $this->lastname
  );
  }

  public function connect($login, $password) {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération de l'utilisateur en base de données
    $query = "SELECT * FROM utilisateurs WHERE login = ? AND password = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $this->id = $row['id'];
        $this->login = $row['login'];
        $this->email = $row['email'];
        $this->firstname = $row['firstname'];
        $this->lastname = $row['lastname'];
        echo "Utilisateur connecté($this->login)";
    } else {
        echo "Erreur de connexion : Identifiants incorrects";
    }
}

  public function disconnect() {
     // Réinitialisation des attributs de l'objet utilisateur
      $this->id = 0;
      $this->login = '';
      $this->email = '';
      $this->firstname = '';
      $this->lastname = '';
      echo "utilisateur déconnecté";



  }

  public function delete() {
    // Vérification si l'utilisateur est connecté
    if ($this->id > 0) {
        // Connexion à la base de données en utilisant PDO
        $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');

        // Préparation de la requête de suppression
        $stmt = $pdo->prepare("DELETE FROM utilisateurs WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        // Vérification de la suppression de l'utilisateur
        if ($stmt->rowCount() > 0) {
            echo "Utilisateur supprimé avec succès";
        } else {
            echo "Erreur lors de la suppression de l'utilisateur";
        }

        // Déconnexion de l'utilisateur
        $this->disconnect();
    } else {
        echo "Aucun utilisateur connecté, impossible de supprimer";
    }
}



function update($login, $password, $email, $firstname, $lastname) {
  // Connect to the database
  $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
  
  // Hash the password for storage in the database
  // $password = password_hash($password, PASSWORD_DEFAULT);

  // Prepare the SQL statement
  $stmt = $pdo->prepare("UPDATE utilisateurs SET login =:login, password = :password, email = :email, firstname = :firstname, lastname = :lastname WHERE id = :id");

  // Bind the parameters
  $stmt->bindParam(':id', $this->id);
  $stmt->bindParam(':login', $login);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);

  // Execute the statement
  $stmt->execute();

  // Check if the user was updated
  if ($stmt->rowCount() > 0) {
    echo "Utilisateur mis à jour avec succès";
  
  } else {
    echo "Erreur lors de la mise à jour de l'utilisateur";

  }

}


function getAllInfos() {
 
  $dbh = new PDO('mysql:host=localhost;dbname=classes', 'root', '');

  $stmt = $dbh->prepare("SELECT * FROM utilisateurs");

  $stmt->execute();

    // Fetch the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    print_r($result);
  if ($result) {
    return array(
      'id' => $result['id'],
      'login' => $result['login'],
      'email' => $result['email'],
      'firstname' => $result['firstname'],
      'lastname' => $result['lastname']
    );
    print_r($result);
  } else {
    return false;
  }
  
}



function getLogin() {


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
$user = new Userpdo();
// $user->connect('test', 'test');


    
    // $infos = $user->register('81test', '8test', '8te2st@example.com', '82Test', '82User');
    $infos = $user->connect('4test', '2test');
    // $infos = $user->disconnect('81test', '8test');
    // $infos = $user->delete('81test', '8test');
    
    $user->id = 5;
    // $user->update("Joroe", "newprord", "jofhndoe@example.com", "Jofhn", "Dfoe");
    // $user->getAllInfos();

    // Affichage des informations de l'utilisateur créé
    print_r($infos);
    


 


  ?>