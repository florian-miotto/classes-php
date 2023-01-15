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
    $this->id = 0;
    $this->login = '';
    $this->email = '';
    $this->firstname = '';
    $this->lastname = '';
    // session_start();   // a tester
  }

  public function register($login, $password, $email, $firstname, $lastname) {
    global $mysqli;
        // Connexion à la base de données
        $mysqli = new mysqli('localhost', 'root', '', 'classes');
    var_dump($mysqli );
        // Préparation de la requête d'insertion
        $stmt = $mysqli->prepare("INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $login, $password, $email, $firstname, $lastname);
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
    // $_SESSION["user"] = $this; //a tester
  }

  public function disconnect() {
    // Code de déconnexion de l'utilisateur en base de 
    
  global $mysqli;
  $this->conn->close();
  // session_destroy(); // a tester

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
    // return isset($_SESSION["user"]); // a tester
  }


//   public function getAllInfos($id) {
//     $conn = new mysqli('localhost', 'root', '', 'classes');
//     $stmt = $conn->prepare("SELECT * FROM utilisateurs WHERE id = ?");
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     if ($result->num_rows > 0) {
//         $row = $result->fetch_assoc();
//         return $row;
//     } else {
//         return false;
//     }
//     $conn->close();
// }

function setUserId($id) {/*????*/ 
  global $user_id;
  $user_id = $id;
}


public function getAllInfos() {
    global $user_id;
    $conn = new mysqli('localhost', 'root', '', 'classes');
    $stmt = $conn->prepare("SELECT id, login, email, firstname, lastname FROM utilisateurs WHERE id = ?");
    $stmt->bind_param("i", $user_id);
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
    $conn->close();
}
In this example, the $user_id variable is defined outside of the getAllInfos() function, and it is referenced within the function by using the global keyword.
You can change the value of $user_id before calling the function and it will use the updated value inside the function.






  function getLogin($id) {

    $conn = new mysqli('localhost', 'root', '', 'classes');

    if ($conn->connect_errno) {
        die("Error connecting to the database: " . $mysqli->connect_error);
    }
    $stmt = $mysqli->prepare("SELECT login FROM users WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->bind_result($login);

    $stmt->fetch();

    $stmt->close();

    $mysqli->close();

    return $login;
}


  public function getEmail() {
    $mysqli = new mysqli('localhost', 'root', '', 'classes');

    if ($mysqli->connect_errno) {
        die("Error connecting to the database: " . $mysqli->connect_error);
    }
    $stmt = $mysqli->query("SELECT Email FROM users WHERE id = ?");

    // $stmt->bind_param("i", $id);

    // $stmt->execute();

    // $stmt->bind_result($Email);

    // $stmt->fetch();
    // $row = $stmt->fetch_assoc();
    // $stmt->close();
    printf($stmt);
echo $stmt;
    $mysqli->close();

    return $stmt;
  }

  public function getFirstname() {
    $mysqli = new mysqli('mysql:host=localhost;dbname=yourdbname', 'username', 'password');

    if ($mysqli->connect_errno) {
        die("Error connecting to the database: " . $mysqli->connect_error);
    }
    $stmt = $mysqli->prepare("SELECT firstname FROM users WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->bind_result($login);

    $stmt->fetch();

    $stmt->close();

    $mysqli->close();

    return $firstname;
  }

  public function getLastname() {
    $mysqli = new mysqli('mysql:host=localhost;dbname=yourdbname', 'username', 'password');

    if ($mysqli->connect_errno) {
        die("Error connecting to the database: " . $mysqli->connect_error);
    }
    $stmt = $mysqli->prepare("SELECT lastname FROM users WHERE id = ?");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->bind_result($lastname);

    $stmt->fetch();

    $stmt->close();

    $mysqli->close();

    return $lastname;
  }

}

$user = new User(); ?>
<form method="post">
    <label for="user_id">Enter User ID:</label>
    <input type="text" id="user_id" name="user_id">
    <input type="submit" value="Submit">
</form>



<?php 

//test de delete concluant
/*$user = new User();
$user->id = 3;
$user->delete();*/


// Test de la méthode register avec des données de test
/*$user = new User();
 $user->register('2test', '2test', 'te2st@example.com', '2Test', '2User');

print_r($user);*/
//update ok 
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

// Vérification que les informations de l'utilisateur ont bien été mises à jour en base de données
// $query = "SELECT * FROM utilisateurs WHERE id = ?";
// $stmt = $mysqli->prepare($query);
// $stmt->bind_param('i', $user->id);
// $stmt->execute();
// $result = $stmt->get_result();

// if ($result->num_rows > 0) {
//   $row = $result->fetch_assoc();
//   if ($row['login'] == 'nouveau_login' && $row['password'] == 'nouveau_password' && $row['email'] == 'nouvel_email' && $row['firstname'] == 'nouveau_firstname' && $row['lastname'] == 'nouveau_lastname') {
//     echo "Informations mises à jour en base de données\n";
//   } else {
//     echo "Erreur de mise à jour en base de données\n";
//   }
// } else {
//   echo "Utilisateur non trouvé en base de données\n";
// }

// Fermeture de la connexion à la base de données
// $mysqli->close();



?>