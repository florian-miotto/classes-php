<?php

class User {
  public $id;
  public $login;
  public $email;
  public $firstname;
  public $lastname;
  public $password;
  private $isConnected;
  private $conn;

  public function __construct() {
    $this->conn = new mysqli('localhost', 'root', '', 'classes');

    // Vérifiez la connexion
    if ($this->conn->connect_error) {
        die("La connexion a échoué : " . $this->conn->connect_error);
    }

    $this->id = 0;
    $this->login = '';
    $this->email = '';
    $this->firstname = '';
    $this->lastname = '';
}

// Définir la connexion à la base de données en tant que variable globale


// Définir la méthode register
public function register($login, $password, $email, $firstname, $lastname) {
  $mysqli = new mysqli('localhost', 'root', '', 'classes');
  
  // Vérification si l'utilisateur existe déjà
  $stmt = $mysqli->prepare("SELECT * FROM utilisateurs WHERE login = ?");
  $stmt->bind_param("s", $login);
  $stmt->execute();
  $stmt->store_result();
  if ($stmt->num_rows > 0) {
      echo "Utilisateur déjà existant";
  } else {
      $stmt->close();

      // Préparation de la requête d'insertion
      $stmt = $mysqli->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param('sssss', $login, $password, $email, $firstname, $lastname);
      $stmt->execute();

      echo "Utilisateur créé avec succès";

      // Récupération de l'ID de l'utilisateur créé
      $id = $mysqli->insert_id;

      // Mise à jour des attributs de l'objet avec les valeurs de l'utilisateur créé
      $this->id = $id;
      $this->login = $login;
      $this->email = $email;
      $this->firstname = $firstname;
      $this->lastname = $lastname;
  }

  // Fermeture de la requête
  $stmt->close();

  return array(
    'id' => $this->id,
    'login' => $this->login,
    'email' => $this->email,
    'firstname' => $this->firstname,
    'lastname' => $this->lastname
  );
}


public function connect($login, $password) {
  // Requête pour vérifier les identifiants de connexion
  $stmt = $this->conn->prepare("SELECT id, email, firstname, lastname FROM utilisateurs WHERE login = ? AND password = ?");
  $stmt->bind_param("ss", $login, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  // Si les identifiants de connexion sont corrects
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();

      // Mise à jour des attributs de l'objet utilisateur
      $this->id = $row['id'];
      $this->login = $login;
      $this->email = $row['email'];
      $this->firstname = $row['firstname'];
      $this->lastname = $row['lastname'];

      $stmt->close();
      return true; // Connexion réussie
  } else {
      $stmt->close();
      return false; // Connexion échouée
  }
}

public function disconnect() {
  // Réinitialisation des attributs de l'objet utilisateur
  $this->id = 0;
  $this->login = '';
  $this->email = '';
  $this->firstname = '';
  $this->lastname = '';
}



  public function delete() {
   
        // Instanciation de l'objet mysqli avec les paramètres de connexion à la base de données
        $conn  = new mysqli('localhost', 'root', '', 'classes');
      
        // Suppression de l'utilisateur en base de données
        $stmt = $conn->prepare( "DELETE FROM utilisateurs WHERE id = ?");
       
         $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $affected_rows = $stmt->affected_rows;
        $stmt->close();
        $conn->close();
        if($affected_rows){
          echo "Utilisateur supprimé avec succès";
        }else{
          echo "Erreur lors de la suppression de l'utilisateur";
        }
      }
   
  public function update($login, $password, $email, $firstname, $lastname) {
    // Code de mise à jour de l'utilisateur en base de données
    global $mysqli;
    $conn  = new mysqli('localhost', 'root', '', 'classes');
    // Mise à jour de l'utilisateur en base de données
    $stmt = $this->conn->prepare("UPDATE utilisateurs SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $login, $password, $email, $firstname, $lastname, $this->id);
    $stmt->execute();
    $stmt->close();

    // Mettre à jour les attributs de l'objet avec les nouvelles valeurs
    $this->login = $login;
    $this->password = $password;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
  }

  public function isConnected() {
    return $this->isConnected;
  }

public function getAllInfos() {
  $stmt = $this->conn->prepare("SELECT id, login, email, firstname, lastname FROM utilisateurs WHERE id = ?");
  $stmt->bind_param("i", $this->id);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      return array(
        'id' => $row['id'],
        'login' => $row['login'],
        'email' => $row['email'],
        'firstname' => $row['firstname'],
        'lastname' => $row['lastname']
      );
  } else {
      return false;
  }
  $stmt->close();
}




  function getLogin($id) {

    return $this->login;
}


  public function getEmail() {
   

    return $this->email;
  }

  public function getFirstname() {
   

    return $this->$firstname;
  }

  public function getLastname() {
    // $mysqli = new mysqli('localhost', 'root', '', 'classes');

    return $this->lastname;

  }

}

// $user = new User(); 
// $user->getAllInfos();


//test de delete concluant---------------------------------------------
// $user = new User();
// $user->id = 7;
// $user->delete();


// Test de la méthode register avec des données de test (test ok !)-------------------
// $user = new User();
//  $user->register('6rtest', '5test', 'te2st@example.com', '4Test', '4User');

// print_r($user);
//update ok --------------------------------------------------------------------------
/*$user = new User();
$user->id = 5;
$user->update("JohnDoe", "newpassword", "johndoe@example.com", "John", "Doe");*/


// // Test de la méthode connect avec des données de test
// $user->connect('test', 'test');

// // Vérification de la connexion de l'utilisateur
// if ($user->isConnected()) {
//   echo "Utilisateur connecté\n";
// } else {
//   echo "Utilisateur non connecté\n";
// }

// // Test de la méthode disconnect
// $user->disconnect();

// // Vérification de la déconnexion de l'utilisateur
// if ($user->isConnected()) {
//   echo "Utilisateur connecté\n";
// } else {
//   echo "Utilisateur déconnecté\n";
// }


// Connexion à la base de données de développement
// $mysqli = new mysqli('localhost', 'root', '', 'classes');

// Instanciation d'un objet User
// $user = new User();
// $user->getEmail(1);



// Fermeture de la connexion à la base de données
// $mysqli->close();



?>