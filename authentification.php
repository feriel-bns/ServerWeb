<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../Database.php';
  


  // Instantiate DB & connect
  $database = new Database();
  $pdo = $database->connect();

$user_name =$_POST['username'] ;                                    
$user_pass = $_POST['password'];
   $req = "select username,password from heroku_abde6316f609ed5.compte where username like '$user_name' and  password like '$user_pass';";

if ($stmt = mysqli_prepare($pdo, $req)) {

    /* Exécution de la requête */
    mysqli_stmt_execute($stmt);

    /* Association des variables de résultat */
    mysqli_stmt_bind_result($stmt, $name, $code);
mysqli_stmt_fetch($stmt);
    
    if( !empty($name) and !empty($code) ){
       $result="login success";
      json_encode( $result);
    } else {
        $result="login failed";
         json_encode( $result);
    }
    /* Fermeture de la commande */
   mysqli_stmt_close($stmt);
}
  
  


  }
