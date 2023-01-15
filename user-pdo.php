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

  
  

    // // Création de l'utilisateur en base de données
    // $query = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES (:login, :password, :email, :firstname, :lastname)";
    // $stmt = $pdo->prepare($query);
    // $stmt->bindParam(':login', $login);
    // $stmt->bindParam(':password', $password);
    // $stmt->bindParam(':email', $email);
    // $stmt->bindParam(':firstname', $firstname);
    // $stmt->bindParam(':lastname', $lastname);
    // $stmt->execute();

    // // Récupération de l'ID de l'utilisateur créé
    // $this->id = $pdo->lastInsertId();

    // // Récupération de toutes les informations de l'utilisateur
    // $query = "SELECT * FROM utilisateurs WHERE id = ?";
    // $stmt = $pdo->prepare($query);
    // $stmt->bindParam(1, $this->id);
    // $stmt->execute();
    // $row = $stmt->fetch(PDO::FETCH_ASSOC);

 

    // return $row; 
    
    
    try {
      $conn = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $sql = "INSERT INTO utilisateurs (`login`, `password`, `email`, `firstname`, `lastname`) ";
        // $sql->bind_param('sssss', $login, $password, $email, $firstname, $lastname);
  
      // use exec() because no results are returned
      $conn->exec($sql);
      echo "New record created successfully";
    } catch(PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
    
    $conn = null;
  }





  public function connect($login, $password) {
    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');

    // Récupération de l'utilisateur en base de données
    $query = "SELECT * FROM utilisateurs WHERE 'login' = ? AND 'password' = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $login);
    $stmt->bindParam(2, $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fermeture de la connexion à la base de donné
    try {
      $pdo = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
      // set the PDO error mode to exception
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
   
  }

  public function disconnect() {
   
    
  global $mysqli;

  $mysqli = null;
  }

  public function delete() {
    // Connect to the database
    $dbh = new  PDO('mysql:host=localhost;dbname=classes', 'root', '');

    // Get the user ID from the global variable or the GET parameter
    $id = isset($_GET['id']) ? $_GET['id'] : $user_id;

    // Prepare the SQL statement
    $stmt = $dbh->prepare("DELETE FROM users WHERE id = :id");

    $stmt->bindParam(':id', $id);

    $stmt->execute();

    // Close the connection
    $dbh = null;
}


function update($login, $password, $email, $firstname, $lastname) {
  // Connect to the database
  $dbh = PDO('mysql:host=localhost;dbname=classes', 'root', '');
  
  // Hash the password for storage in the database
  $password = password_hash($password, PASSWORD_DEFAULT);

  // Prepare the SQL statement
  $stmt = $dbh->prepare("UPDATE users SET password = :password, email = :email, firstname = :firstname, lastname = :lastname WHERE login = :login");

  // Bind the parameters
  $stmt->bindParam(':login', $login);
  $stmt->bindParam(':password', $password);
  $stmt->bindParam(':email', $email);
  $stmt->bindParam(':firstname', $firstname);
  $stmt->bindParam(':lastname', $lastname);

  // Execute the statement
  $stmt->execute();

  // Close the connection
  $dbh = null;
}
function getAllInfos() {
 
  $dbh = new PDO('mysql:host=localhost;dbname=classes', 'root', '');

  
  $stmt = $dbh->prepare("SELECT * FROM users");

 
  $stmt->execute();

 
  $rows = $stmt->fetchAll();

 
  $dbh = null;

  
  return $rows;
}



function getLogin() {
  
  $dbh = new PDO('mysql:host=localhost;dbname=yourdbname', 'username', 'password');
  
  $id = isset($_GET['id']) ? $_GET['id'] : $user_id;


  $stmt = $dbh->prepare("SELECT login FROM users WHERE id = :id");

  $stmt->bindParam(':id', $id);

  $stmt->execute();

  $row = $stmt->fetch();

  $dbh = null;

  return $row['login'];
}

public function getEmail() {
  $dbh = new PDO('mysql:host=localhost;dbname=yourdbname', 'username', 'password');
  
  $id = isset($_GET['id']) ? $_GET['id'] : $user_id;


  $stmt = $dbh->prepare("SELECT login FROM users WHERE id = :id");

  $stmt->bindParam(':id', $id);

  $stmt->execute();

  $row = $stmt->fetch();

  $dbh = null;

  return $row['email'];
}

public function getFirstname() {
  $dbh = new PDO('mysql:host=localhost;dbname=yourdbname', 'username', 'password');
  
  $id = isset($_GET['id']) ? $_GET['id'] : $user_id;


  $stmt = $dbh->prepare("SELECT login FROM users WHERE id = :id");

  $stmt->bindParam(':id', $id);

  $stmt->execute();

  $row = $stmt->fetch();

  $dbh = null;

  return $row['firstname'];
}

public function getLastname() {
  $dbh = new PDO('mysql:host=localhost;dbname=yourdbname', 'username', 'password');
  
  $id = isset($_GET['id']) ? $_GET['id'] : $user_id;


  $stmt = $dbh->prepare("SELECT login FROM users WHERE id = :id");

  $stmt->bindParam(':id', $id);

  $stmt->execute();

  $row = $stmt->fetch();

  $dbh = null;

  return $row['lastname'];
}






}
$user = new Userpdo();
// $user->connect('test', 'test');


    
    $infos = $user->register('8test', '8test', '8te2st@example.com', '82Test', '82User');

    // Affichage des informations de l'utilisateur créé
    print_r($infos);
    


 


  ?>