<?php

class User {
  public $id;
  public $login;
  public $email;
  public $firstname;
  public $lastname;
  public $password;
  private $isConnected;

  public function __construct() {
    $this->id = 0;
    $this->login = '';
    $this->email = '';
    $this->firstname = '';
    $this->lastname = '';
  }

  public function register($login, $password, $email, $firstname, $lastname) {
    global $mysqli;
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
    global $mysqli;
        // Connexion à la base de données
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
   

    // Code de connexion de l'utilisateur en base de données

     $this->login = $login;
    $this->password = $password;

    $this->isConnected = true;
  }

  public function disconnect() {
    // Code de déconnexion de l'utilisateur en base de 
    
  global $mysqli;

  // Fermeture de la connexion à la base de données
  if ($user->isConnected()) {
    echo "Utilisateur connecté\n";
  } else {
    $mysqli->close();
    echo "Utilisateur déconnecté\n";
  }
  

    
    $this->isConnected = false;
  }

  public function delete() {
   
        // Instanciation de l'objet mysqli avec les paramètres de connexion à la base de données
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
      
        // Suppression de l'utilisateur en base de données
        $query = "DELETE FROM utilisateurs WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
      var_dump($mysqli);
        // Fermeture de la connexion à la base de données
        $mysqli->close();
      }
    // $this->disconnect();
  



  public function update($login, $password, $email, $firstname, $lastname) {
    // Code de mise à jour de l'utilisateur en base de données
    global $mysqli;

    // Mise à jour de l'utilisateur en base de données
    $query = "UPDATE utilisateurs SET login = ?, password = ?, email = ?, firstname = ?, lastname = ? WHERE id = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('sssssi', $login, $password, $email, $firstname, $lastname, $this->id);
    $stmt->execute();


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

  // Attributs et méthodes existants...

  public function getAllInfos() {
   
        global $mysqli;
      
        // Récupération de toutes les informations de l'utilisateur en base de données
        $query = "SELECT * FROM utilisateurs WHERE id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
      
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
        //   echo "ID : " . $row['id'] . "\n";
        //   echo "Nom : " . $row['name'] . "\n";
        //   echo "Email : " . $row['email'] . "\n";


          return $row;
        } else {
          return null;
        }
      
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

// $user = new User();

// Test de la méthode register avec des données de test
// $infos = $user->register('2test', '2test', 'te2st@example.com', '2Test', '2User');

// Affichage des informations de l'utilisateur créé
// print_r($infos);

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
$mysqli = new mysqli('localhost', 'root', '', 'classes');

// Instanciation d'un objet User
$user = new User();

// Connexion de l'utilisateur
$user->connect('3333', '33333333');
var_dump($user->connect('3333', '33333333'));

// Mise à jour des informations de l'utilisateur
$user->update('nouveau_login', 'nouveau_password', 'nouvel_email', 'nouveau_firstname', 'nouveau_lastname');

// Vérification que les informations de l'utilisateur ont bien été mises à jour en base de données
$query = "SELECT * FROM utilisateurs WHERE id = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('i', $user->id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  if ($row['login'] == 'nouveau_login' && $row['password'] == 'nouveau_password' && $row['email'] == 'nouvel_email' && $row['firstname'] == 'nouveau_firstname' && $row['lastname'] == 'nouveau_lastname') {
    echo "Informations mises à jour en base de données\n";
  } else {
    echo "Erreur de mise à jour en base de données\n";
  }
} else {
  echo "Utilisateur non trouvé en base de données\n";
}

// Fermeture de la connexion à la base de données
$mysqli->close();


